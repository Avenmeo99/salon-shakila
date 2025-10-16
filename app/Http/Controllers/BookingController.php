<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingTimeblock;
use App\Models\Cart;
use App\Models\Service;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class BookingController extends Controller
{
    private const DEFAULT_START = '09:00';
    private const DEFAULT_END = '18:00';
    private const DEFAULT_INTERVAL = 30;
    private const CART_COOKIE_LIFETIME_MINUTES = 20160; // 14 days

    public function create(Service $service, Request $request): View
    {
        if (! $service->is_active) {
            abort(404);
        }

        $date = $this->resolveDate($request->input('date'));
        $slots = $this->availableSlots($service, $date);

        return view('bookings.create', [
            'service' => $service,
            'date' => $date,
            'slots' => $slots,
        ]);
    }

    public function store(Request $request, Service $service): RedirectResponse
    {
        if (! $service->is_active) {
            abort(404);
        }

        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:20'],
            'booking_date' => ['required', 'date', 'after_or_equal:today'],
            'booking_time' => ['required', 'date_format:H:i'],
            'notes' => ['nullable', 'string'],
            'pay_now' => ['nullable', 'boolean'],
        ]);

        try {
            $bookingDate = CarbonImmutable::createFromFormat('Y-m-d', $data['booking_date']);
        } catch (\Exception $e) {
            return back()
                ->withErrors(['booking_date' => 'Tanggal booking tidak valid.'])
                ->withInput();
        }

        $availableSlots = $this->availableSlots($service, $bookingDate);

        if (! $availableSlots->contains($data['booking_time'])) {
            return back()
                ->withErrors(['booking_time' => 'Jam booking tidak tersedia untuk tanggal yang dipilih.'])
                ->withInput();
        }

        $slotTaken = Booking::query()
            ->where('service_id', $service->id)
            ->whereDate('booking_date', $bookingDate->format('Y-m-d'))
            ->where('booking_time', $data['booking_time'])
            ->whereIn('status', [Booking::STATUS_PENDING, Booking::STATUS_CONFIRMED])
            ->exists();

        if ($slotTaken) {
            return back()
                ->withErrors(['booking_time' => 'Slot yang dipilih sudah terisi. Pilih waktu lain.'])
                ->withInput();
        }

        $booking = Booking::create([
            'service_id' => $service->id,
            'customer_name' => $data['customer_name'],
            'customer_phone' => $data['customer_phone'],
            'booking_date' => $bookingDate->format('Y-m-d'),
            'booking_time' => $data['booking_time'],
            'status' => Booking::STATUS_PENDING,
            'payment_status' => Booking::PAYMENT_UNPAID,
            'amount_paid' => 0,
            'notes' => $data['notes'] ?? null,
        ]);

        if ($request->boolean('pay_now')) {
            $this->addServiceToCart($request, $service);

            return redirect()
                ->route('checkout.show')
                ->with('status', 'Booking dibuat. Lanjutkan pembayaran melalui checkout.');
        }

        return redirect()
            ->route('bookings.thanks', ['service' => $service->slug])
            ->with('status', 'Booking berhasil dibuat. Kami akan menghubungi Anda segera.');
    }

    public function thanks(Service $service): View
    {
        if (! $service->is_active) {
            abort(404);
        }

        return view('bookings.thanks', [
            'service' => $service,
        ]);
    }

    private function resolveDate(?string $date): CarbonImmutable
    {
        if ($date) {
            try {
                return CarbonImmutable::createFromFormat('Y-m-d', $date);
            } catch (\Exception $e) {
                // fall through to today
            }
        }

        return CarbonImmutable::today();
    }

    private function availableSlots(Service $service, CarbonImmutable $date): Collection
    {
        $bookedSlots = Booking::query()
            ->where('service_id', $service->id)
            ->whereDate('booking_date', $date->format('Y-m-d'))
            ->whereIn('status', [Booking::STATUS_PENDING, Booking::STATUS_CONFIRMED])
            ->pluck('booking_time')
            ->map(function ($time) {
                if ($time instanceof CarbonInterface) {
                    return $time->format('H:i');
                }

                return substr((string) $time, 0, 5);
            })
            ->unique()
            ->values();

        $blocks = BookingTimeblock::query()
            ->where('weekday', $date->dayOfWeek)
            ->orderBy('start')
            ->get();

        if ($blocks->isEmpty()) {
            $blocks = collect([
                ['start' => self::DEFAULT_START, 'end' => self::DEFAULT_END, 'interval_minutes' => self::DEFAULT_INTERVAL],
            ]);
        }

        $slots = collect();

        foreach ($blocks as $block) {
            $startValue = $block instanceof BookingTimeblock ? $block->start : ($block['start'] ?? null);
            $endValue = $block instanceof BookingTimeblock ? $block->end : ($block['end'] ?? null);
            $intervalValue = $block instanceof BookingTimeblock ? $block->interval_minutes : ($block['interval_minutes'] ?? null);

            $start = $this->safeTime($startValue);
            $end = $this->safeTime($endValue);
            $interval = (int) ($intervalValue ?? self::DEFAULT_INTERVAL);

            if (! $start || ! $end || $interval <= 0 || $start->greaterThanOrEqualTo($end)) {
                continue;
            }

            for ($current = $start; $current->lt($end); $current = $current->addMinutes($interval)) {
                $formatted = $current->format('H:i');
                if (! $bookedSlots->contains($formatted)) {
                    $slots->push($formatted);
                }
            }
        }

        return $slots->unique()->sort()->values();
    }

    private function safeTime(?string $time): ?CarbonImmutable
    {
        if (! $time) {
            return null;
        }

        try {
            return CarbonImmutable::createFromFormat('H:i', $time);
        } catch (\Exception $e) {
            return null;
        }
    }

    private function addServiceToCart(Request $request, Service $service): void
    {
        $cart = $this->resolveCart($request);
        $item = $cart->items()->where('service_id', $service->id)->first();

        if ($item) {
            $item->qty += 1;
            $item->unit_price = $service->effectivePrice();
            $item->name_cache = $service->name;
            $item->save();
        } else {
            $cart->items()->create([
                'service_id' => $service->id,
                'name_cache' => $service->name,
                'unit_price' => $service->effectivePrice(),
                'qty' => 1,
            ]);
        }

        $cart->load('items');
        $cart->recalc();
    }

    private function resolveCart(Request $request): Cart
    {
        $token = $request->cookie(CartController::COOKIE_NAME);

        if ($token) {
            $existing = Cart::with('items')->where('token', $token)->first();
            if ($existing) {
                cookie()->queue(CartController::COOKIE_NAME, $existing->token, self::CART_COOKIE_LIFETIME_MINUTES);

                return $existing;
            }
        }

        $cart = new Cart([
            'token' => Cart::generateToken(),
            'status' => 'active',
        ]);
        $cart->save();
        $cart->load('items');

        cookie()->queue(CartController::COOKIE_NAME, $cart->token, self::CART_COOKIE_LIFETIME_MINUTES);

        return $cart;
    }
}
