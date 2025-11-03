<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    /**
     * Form booking.
     */
    public function create(Service $service): View
    {
        // slot jam contoh 09:00–17:00
        $timeblocks = collect(range(9, 17))->map(fn ($h) => sprintf('%02d:00', $h));

        // NOTE: pakai view yg sudah ada: resources/views/bookings/create.blade.php
        return view('bookings.create', [
            'service'    => $service,
            'timeblocks' => $timeblocks,
        ]);
    }

    /**
     * Simpan booking -> masuk ke Keranjang (DP 50%).
     */
    public function store(Request $request, Service $service): RedirectResponse
    {
        $data = $request->validate([
            'customer_name' => 'nullable|string|max:100',
            'whatsapp'      => 'nullable|string|max:30',
            'date'          => 'required|date',
            'time'          => 'required|string|max:8',
            'note'          => 'nullable|string|max:500',
        ]);

        // hitung DP 50%
        $fullPrice = (int) ($service->effectivePrice() ?? $service->price);
        $dpPrice   = (int) floor($fullPrice * 0.5);

        // Ambil/buat keranjang dari cookie
        $cart = $this->currentCartOrCreate();

        // Label item di keranjang
        $label = $service->name . ' (Booking ' . $data['date'] . ' ' . $data['time'] . ') - DP 50%';

        // Simpan item ke keranjang
        $cart->items()->create([
            'service_id' => $service->id,
            'name_cache' => $label,
            'qty'        => 1,
            'unit_price' => $dpPrice,
            'meta'       => [
                'kind'          => 'booking',   // penanda booking
                'customer_name' => $data['customer_name'] ?? null,
                'whatsapp'      => $data['whatsapp'] ?? null,
                'date'          => $data['date'],
                'time'          => $data['time'],
                'note'          => $data['note'] ?? null,
                'full_price'    => $fullPrice,
                'dp_percent'    => 50,
            ],
        ]);

        if (method_exists($cart, 'recalc')) {
            $cart->recalc();
        }

        return redirect()
            ->route('cart.index')
            ->with('status', 'Booking dimasukkan ke keranjang (DP 50%).');
    }

    /**
     * Helper: ambil keranjang dari cookie / buat baru.
     */
    private function currentCartOrCreate(): Cart
    {
        $token = request()->cookie(\App\Http\Controllers\CartController::COOKIE_NAME);
        if ($token) {
            $found = Cart::with('items.service')->where('token', $token)->first();
            if ($found) return $found;
        }

        $cart = Cart::create(['token' => (string) Str::uuid()]);
        cookie()->queue(cookie(\App\Http\Controllers\CartController::COOKIE_NAME, $cart->token, 60 * 24 * 30)); // 30 hari
        return $cart->fresh(['items.service']);
    }
}
