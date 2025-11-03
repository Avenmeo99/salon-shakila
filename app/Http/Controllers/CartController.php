<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public const COOKIE_NAME = 'cart_token';

    /* ====================== helpers ====================== */

    public function currentCart(): ?Cart
    {
        $token = request()->cookie(self::COOKIE_NAME);
        if (!$token) return null;

        return Cart::with(['items.service'])->where('token', $token)->first();
    }

    public function currentCartOrCreate(): Cart
    {
        $cart = $this->currentCart();
        if ($cart) return $cart;

        $cart = Cart::create([
            'token' => (string) Str::uuid(),
        ]);

        cookie()->queue(cookie(self::COOKIE_NAME, $cart->token, 60 * 24 * 30)); // 30 hari
        return $cart->fresh(['items.service']);
    }

    private function calcSubtotal(?Cart $cart): int
    {
        if (!$cart) return 0;
        return (int) $cart->items->sum(fn ($it) => (int) $it->qty * (int) $it->unit_price);
    }

    /* ====================== routes ====================== */

    public function index()
    {
        $cart     = $this->currentCart();
        $subtotal = $this->calcSubtotal($cart);

        return view('cart.index', [
            'cart'     => $cart,
            'items'    => $cart?->items ?? collect(),
            'subtotal' => $subtotal,
            'total'    => $subtotal, // sederhana (tanpa diskon/tips)
        ]);
    }

    /**
     * Tambah item ke keranjang (pemesanan normal, bukan booking).
     * Dipakai tombol "Pesan Sekarang"
     */
    public function add(Request $request, ?Service $service = null)
    {
        $cart = $this->currentCartOrCreate();

        // Bisa add by slug path (route cart.add.slug) atau via form POST name, price, qty
        if ($service) {
            $name  = $service->name;
            $price = (int) ($service->effectivePrice() ?? $service->price);
        } else {
            $name  = $request->input('name');
            $price = (int) $request->input('price', 0);
        }

        $qty = max(1, (int) $request->input('qty', 1));

        $cart->items()->create([
            'service_id' => $service?->id,
            'name_cache' => $name,
            'qty'        => $qty,
            'unit_price' => $price,
            'meta'       => null,
        ]);

        if (method_exists($cart, 'recalc')) $cart->recalc();

        // Jika ingin langsung ke checkout
        if ($request->boolean('go_checkout')) {
            return redirect()->route('checkout.index');
        }

        return back()->with('status', "{$name} masuk ke keranjang.");
    }

    public function updateQty(Request $request, int $id)
    {
        $cart = $this->currentCart();
        if (!$cart) return back();

        $qty = max(1, (int) $request->input('qty', 1));

        $item = $cart->items()->where('id', $id)->first();
        if ($item) {
            $item->qty = $qty;
            $item->save();
            if (method_exists($cart, 'recalc')) $cart->recalc();
        }

        return back();
    }

    public function remove(int $id)
    {
        $cart = $this->currentCart();
        if ($cart) {
            $cart->items()->where('id', $id)->delete();
            if (method_exists($cart, 'recalc')) $cart->recalc();
        }
        return back();
    }

    public function clear()
    {
        $cart = $this->currentCart();
        if ($cart) {
            $cart->items()->delete();
            if (method_exists($cart, 'recalc')) $cart->recalc();
        }
        return back();
    }
}
