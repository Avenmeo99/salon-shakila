public function index(Request $request)
{
    $cart = $this->currentCart();
    $kind = $request->query('kind'); // null | 'order' | 'booking'

    $items = $cart?->items ?? collect();
    if ($kind === 'order' || $kind === 'booking') {
        $items = $items->where('kind', $kind)->values();
    }

    $subtotal = $items->sum(fn($it) => (int)$it->qty * (int)$it->unit_price);

    $coupon   = session('coupon');
    $discount = $coupon ? ($coupon['amount'] ?? floor($subtotal * ($coupon['percent'] ?? 0) / 100)) : 0;
    $tips     = (int) session('tips', 0);
    $grand    = max(0, $subtotal - $discount + $tips);

    // item_details untuk Midtrans
    $itemDetails = [];
    foreach ($items as $it) {
        $itemDetails[] = [
            'id'       => (string) $it->id,
            'price'    => (int) $it->unit_price,
            'quantity' => (int) $it->qty,
            'name'     => mb_substr($it->name_cache ?? $it->service->name ?? 'Layanan', 0, 50),
        ];
    }
    if ($discount > 0) $itemDetails[] = ['id'=>'DISCOUNT','price'=>-$discount,'quantity'=>1,'name'=>'Diskon'];
    if ($tips > 0)     $itemDetails[] = ['id'=>'TIPS','price'=>$tips,'quantity'=>1,'name'=>'Tips'];

    $orderId = 'SALON-'.now()->format('YmdHis').'-'.substr(bin2hex(random_bytes(4)),0,8);

    $params = [
        'transaction_details' => [
            'order_id'     => $orderId,
            'gross_amount' => $grand,
        ],
        'item_details' => $itemDetails,
        'customer_details' => [
            'first_name' => auth()->user()->name ?? 'Guest',
            'email'      => auth()->user()->email ?? null,
        ],
        'callbacks' => ['finish' => route('checkout.index', ['kind' => $kind])],
        'credit_card' => ['secure' => true],
    ];

    $snapToken = \App\Services\MidtransGateway::createSnapToken($params);

    return view('checkout.index', [
        'items'       => $items,
        'subtotal'    => $subtotal,
        'discount'    => $discount,
        'tips'        => $tips,
        'grand_total' => $grand,
        'snapToken'   => $snapToken,
        'orderId'     => $orderId,
        'kind'        => $kind,
    ]);
}
