<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class CartController extends Controller
{
    /** Nama cookie yang menyimpan token keranjang (harus sama di BookingController) */
    public const COOKIE_NAME = 'cart_token';

    /** Lama cookie (menit) = 14 hari */
    private const COOKIE_MINUTES = 60 * 24 * 14;

    /** Tampilkan isi keranjang */
    public function index(Request $request): View
    {
        $cart = $this->resolveCart($request);
        $cart->load('items.service');

        return view('cart.index', [
            'cart' => $cart,
        ]);
    }

    /**
     * Tambah layanan ke keranjang.
     * Bisa dipanggil via:
     * - POST /cart               (body: service=slug, qty=1)
     * - POST /cart/add/{service} (route param: {service:slug}, body: qty=1)
     */
    public function add(Request $request, ?Service $service = null): RedirectResponse
    {
        // Ambil service dari route param kalau ada, jika tidak ambil dari hidden input "service"
        if (!$service) {
            $slug = (string) $request->input('service', '');
            $service = Service::where('slug', $slug)->firstOrFail();
        }

        $qty = max(1, (int) $request->input('qty', 1));

        // Dapatkan / buat keranjang aktif dari cookie
        $cart = $this->resolveCart($request);

        // Cek apakah item layanan sudah ada → tambah qty
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
                'qty'        => $qty,
            ]);
        }

        // Recalculate total (pastikan Cart model punya method recalc())
        $cart->load('items');
        if (method_exists($cart, 'recalc')) {
            $cart->recalc();
        }

        return redirect()
            ->route('cart.index')
            ->with('status', "{$service->name} telah ditambahkan ke keranjang.");
    }

    /** Ubah kuantitas item */
    public function updateQty(Request $request, int $id): RedirectResponse
    {
        $qty = max(1, (int) $request->input('qty', 1));
        $cart = $this->resolveCart($request);
        $item = $cart->items()->where('id', $id)->firstOrFail();

        $item->qty = $qty;
        $item->save();

        $cart->load('items');
        if (method_exists($cart, 'recalc')) {
            $cart->recalc();
        }

        return back()->with('status', 'Jumlah item diperbarui.');
    }

    /** Hapus satu item */
    public function remove(Request $request, int $id): RedirectResponse
    {
        $cart = $this->resolveCart($request);
        $item = $cart->items()->where('id', $id)->first();

        if ($item) {
            $item->delete();
            $cart->load('items');
            if (method_exists($cart, 'recalc')) {
                $cart->recalc();
            }
        }

        return back()->with('status', 'Item dihapus dari keranjang.');
    }

    /** Kosongkan keranjang */
    public function clear(Request $request): RedirectResponse
    {
        $cart = $this->resolveCart($request);
        $cart->items()->delete();

        $cart->load('items');
        if (method_exists($cart, 'recalc')) {
            $cart->recalc();
        }

        return back()->with('status', 'Keranjang dikosongkan.');
    }

    /**
     * Dapatkan keranjang aktif dari cookie; buat baru jika tidak ada.
     * Cookie dipanjangkan tiap request.
     */
    private function resolveCart(Request $request): Cart
    {
        $token = $request->cookie(self::COOKIE_NAME);

        if ($token) {
            $existing = Cart::with('items')->where('token', $token)->first();
            if ($existing) {
                // Panjangkan cookie 14 hari lagi
                cookie()->queue(self::COOKIE_NAME, $existing->token, self::COOKIE_MINUTES);
                return $existing;
            }
        }

        // Buat keranjang baru
        $cart = new Cart([
            'token'  => Cart::generateToken(),
            'status' => 'active',
        ]);
        $cart->save();
        $cart->load('items');

        cookie()->queue(self::COOKIE_NAME, $cart->token, self::COOKIE_MINUTES);

        return $cart;
    }
}
