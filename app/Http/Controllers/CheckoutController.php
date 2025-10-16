<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Request $request): View
    {
        $cart = session('cart', ['items' => []]);
        $items = $cart['items'] ?? [];

        // TODO: Jika menggunakan model Cart + cookie token, ambil item dari database.
        // Contoh:
        // $token = $request->cookie(CartController::COOKIE_NAME);
        // $items = optional(\App\Models\Cart::with('items')->where('token', $token)->first())->items->toArray() ?? $items;

        $total = collect($items)->sum(function ($item) {
            $price = $item['price'] ?? $item['unit_price'] ?? 0;
            $qty = $item['qty'] ?? 1;

            return $price * $qty;
        });

        return view('checkout.index', compact('items', 'total'));
    }

    public function store(): RedirectResponse
    {
        session()->forget('cart');

        // TODO: Jika memakai model Cart + cookie token, kosongkan keranjang di database di sini.

        return redirect()->route('bookings.thanks')->with('status', 'Pembayaran berhasil. Terima kasih!');
    }
}
