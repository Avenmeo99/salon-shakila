<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function show(Request $request): RedirectResponse|View
    {
        $cart = $this->resolveCart($request);

        if (! $cart || $cart->items->isEmpty()) {
            return redirect()->route('services.index')->with('error', 'Keranjang Anda kosong.');
        }

        return view('checkout.show', [
            'cart' => $cart,
        ]);
    }

    public function process(Request $request): RedirectResponse
    {
        $cart = $this->resolveCart($request);

        if (! $cart || $cart->items->isEmpty()) {
            return redirect()->route('services.index')->with('error', 'Keranjang Anda kosong.');
        }

        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:30'],
        ]);

        $order = DB::transaction(function () use ($cart, $data) {
            $order = Order::create([
                'customer_name' => $data['customer_name'],
                'customer_phone' => $data['customer_phone'],
                'subtotal' => $cart->subtotal,
                'discount' => $cart->discount,
                'total' => $cart->total,
                'payment_status' => 'pending',
            ]);

            foreach ($cart->items as $item) {
                $order->items()->create([
                    'service_id' => $item->service_id,
                    'name_cache' => $item->name_cache,
                    'unit_price' => $item->unit_price,
                    'qty' => $item->qty,
                ]);
            }

            $cart->status = 'converted';
            $cart->items()->delete();
            $cart->subtotal = 0;
            $cart->discount = 0;
            $cart->total = 0;
            $cart->save();

            return $order;
        });

        cookie()->queue(cookie()->forget(CartController::COOKIE_NAME));

        return redirect()->route('services.index')->with('status', 'Pesanan #' . $order->code . ' berhasil dibuat. Kami akan menghubungi Anda untuk pembayaran.');
    }

    protected function resolveCart(Request $request): ?Cart
    {
        $token = $request->cookie(CartController::COOKIE_NAME);

        if (! $token) {
            return null;
        }

        return Cart::with('items.service')->where('token', $token)->first();
    }
}
