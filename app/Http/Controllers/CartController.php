<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Service;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public const COOKIE_NAME = 'cart_token';
    protected const COOKIE_LIFETIME_MINUTES = 20160; // 14 days

    public function index(Request $request): View
    {
        $cart = $this->resolveCart($request, false);

        return view('cart.index', [
            'cart' => $cart,
        ]);
    }

    public function add(Request $request): RedirectResponse
    {
        $request->validate([
            'service' => ['required', 'string'],
            'qty' => ['nullable', 'integer', 'min:1'],
        ]);

        $service = Service::active()->where('slug', $request->input('service'))->firstOrFail();
        $qty = max(1, (int) $request->input('qty', 1));

        $cart = $this->resolveCart($request);

        $item = $cart->items()->where('service_id', $service->id)->first();

        if ($item) {
            $item->qty += $qty;
            $item->unit_price = $service->effectivePrice();
            $item->name_cache = $service->name;
            $item->save();
        } else {
            $cart->items()->create([
                'service_id' => $service->id,
                'name_cache' => $service->name,
                'unit_price' => $service->effectivePrice(),
                'qty' => $qty,
            ]);
        }

        $cart->load('items');
        $cart->recalc();

        return $this->redirectWithCookie(back()->with('status', 'Layanan ditambahkan ke keranjang.'), $cart, $request);
    }

    public function updateQty(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'qty' => ['required', 'integer', 'min:1'],
        ]);

        $cart = $this->resolveCart($request, false);

        if (! $cart) {
            return back()->with('error', 'Keranjang tidak ditemukan.');
        }

        $item = $cart->items()->where('id', $id)->firstOrFail();
        $item->qty = (int) $request->input('qty');
        $item->save();

        $cart->load('items');
        $cart->recalc();

        return back()->with('status', 'Jumlah diperbarui.');
    }

    public function remove(Request $request, int $id): RedirectResponse
    {
        $cart = $this->resolveCart($request, false);

        if ($cart) {
            $cart->items()->where('id', $id)->delete();
            $cart->load('items');
            $cart->recalc();
        }

        return back()->with('status', 'Item dihapus.');
    }

    public function clear(Request $request): RedirectResponse
    {
        $cart = $this->resolveCart($request, false);

        if ($cart) {
            $cart->items()->delete();
            $cart->load('items');
            $cart->recalc();
        }

        return back()->with('status', 'Keranjang dikosongkan.');
    }

    protected function resolveCart(Request $request, bool $createIfMissing = true): ?Cart
    {
        $token = $request->cookie(self::COOKIE_NAME);

        if ($token) {
            $cart = Cart::with('items.service')->where('token', $token)->first();
            if ($cart) {
                return $cart;
            }
        }

        if (! $createIfMissing) {
            return null;
        }

        $cart = new Cart([
            'token' => Cart::generateToken(),
            'status' => 'active',
        ]);
        $cart->save();
        $cart->load('items.service');

        cookie()->queue(self::COOKIE_NAME, $cart->token, self::COOKIE_LIFETIME_MINUTES);

        return $cart;
    }

    protected function redirectWithCookie(RedirectResponse $response, Cart $cart, Request $request): RedirectResponse
    {
        $token = $request->cookie(self::COOKIE_NAME);

        return $response->withCookie(cookie(self::COOKIE_NAME, $cart->token, self::COOKIE_LIFETIME_MINUTES));
    }
}
