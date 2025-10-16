<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Request $request): RedirectResponse|View
    {
        $cart = $this->resolveCart($request);

        if (! $cart || $cart->items->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Keranjang Anda kosong.');
        }

        $cart->loadMissing('items.service');

        return view('checkout.index', [
            'cart' => $cart,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $cart = $this->resolveCart($request);

        if (! $cart || $cart->items->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Keranjang Anda kosong.');
        }

        $cart->items()->delete();
        $cart->fill([
            'status' => 'completed',
            'subtotal' => 0,
            'discount' => 0,
            'total' => 0,
        ])->save();

        cookie()->queue(cookie()->forget(CartController::COOKIE_NAME));

        return redirect()
            ->route('bookings.thanks')
            ->with('status', 'Pembayaran berhasil dikonfirmasi. Terima kasih telah mempercayakan perawatan Anda kepada kami.');
    }

    private function resolveCart(Request $request): ?Cart
    {
        $token = $request->cookie(CartController::COOKIE_NAME);

        if (! $token) {
            return null;
        }

        return Cart::with('items.service')->where('token', $token)->first();
    }
}
