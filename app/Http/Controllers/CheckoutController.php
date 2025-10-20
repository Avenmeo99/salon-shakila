<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Services\MidtransGateway;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    private function currentCart(): ?Cart
    {
        $token = request()->cookie(CartController::COOKIE_NAME);
        if (!$token) return null;

        return Cart::with(['items.service'])
            ->where('token', $token)
            ->first();
    }

    private function calcSubtotal(?Cart $cart): int
    {
        if (!$cart) return 0;
        return (int) $cart->items->sum(fn($it) => (int)$it->qty * (int)$it->unit_price);
    }

    public function index()
    {
        $cart     = $this->currentCart();
        $subtotal = $this->calcSubtotal($cart);

        $coupon   = session('coupon'); // ['percent'=>10] / ['amount'=>25000]
        $discount = $coupon ? (int)($coupon['amount'] ?? floor($subtotal * ($coupon['percent'] ?? 0) / 100)) : 0;
        $tips     = (int) session('tips', 0);
        $grand    = max(0, $subtotal - $discount + $tips);

        // 1) order_id unik
        $orderId = 'SALON-' . now()->format('YmdHis') . '-' . substr(bin2hex(random_bytes(4)), 0, 8);

        // 2) simpan order pending
        Order::create([
            'order_id'    => $orderId,
            'user_id'     => auth()->id(),
            'cart_token'  => $cart?->token,
            'subtotal'    => $subtotal,
            'discount'    => $discount,
            'tips'        => $tips,
            'grand_total' => $grand,
            'status'      => 'pending',
        ]);

        // 3) item_details (opsional)
        $itemDetails = [];
        foreach (($cart?->items ?? []) as $it) {
            $itemDetails[] = [
                'id'       => (string) $it->id,
                'price'    => (int) $it->unit_price,
                'quantity' => (int) $it->qty,
                'name'     => mb_substr($it->service->name ?? $it->name_cache ?? 'Layanan', 0, 50),
            ];
        }
        if ($discount > 0) $itemDetails[] = ['id'=>'DISCOUNT','price'=>-$discount,'quantity'=>1,'name'=>'Diskon'];
        if ($tips > 0)     $itemDetails[] = ['id'=>'TIPS','price'=>$tips,'quantity'=>1,'name'=>'Tips'];

        // 4) params Snap
        $params = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => $grand,
            ],
            'item_details'     => $itemDetails,
            'customer_details' => [
                'first_name' => auth()->user()->name ?? 'Guest',
                'email'      => auth()->user()->email ?? null,
            ],
            'callbacks' => [
                'finish' => route('payment.success'),
            ],
            'credit_card' => ['secure' => true],
        ];

        $snapToken = MidtransGateway::createSnapToken($params);

        return view('checkout.index', [
            'items'       => $cart?->items ?? collect(),
            'subtotal'    => $subtotal,
            'discount'    => $discount,
            'tips'        => $tips,
            'grand_total' => $grand,
            'snapToken'   => $snapToken,
            'orderId'     => $orderId,
        ]);
    }

    public function applyCoupon(Request $r)
    {
        $code = trim($r->input('code', ''));
        $map  = [
            'SALON10' => ['percent' => 10],
            'HEMAT25' => ['amount'  => 25000],
        ];
        if (isset($map[$code])) session(['coupon' => array_merge($map[$code], ['code' => $code])]);
        else session()->forget('coupon');

        return back()->with('status', 'Kupon diproses.');
    }

    public function applyTips(Request $r)
    {
        $rate   = (int) $r->input('rate', 0);
        $custom = (int) $r->input('custom', 0);

        $cart     = $this->currentCart();
        $subtotal = $this->calcSubtotal($cart);
        $tips     = $custom > 0 ? $custom : floor($subtotal * $rate / 100);

        session(['tips' => $tips]);
        return back()->with('status', 'Tips diperbarui.');
    }

    // dipanggil saat finish/pending → bersihkan keranjang
    public function store()
    {
        $cart = $this->currentCart();
        if ($cart) {
            $cart->items()->delete();
            if (method_exists($cart, 'recalc')) $cart->recalc();
        }
        session()->forget(['coupon', 'tips']);

        return redirect()->route('bookings.thanks')->with('status', 'Pembayaran diproses. Terima kasih!');
    }
}
