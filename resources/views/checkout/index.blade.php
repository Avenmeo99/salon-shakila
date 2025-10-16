<x-layout.base :title="'Checkout — Shakila Salon'">
    <section class="bg-gradient-to-b from-pink-50 to-white py-14">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-xs tracking-[0.3em] text-pink-600 font-semibold">SHAKILA SALON</p>
            <h1 class="mt-4 text-3xl sm:text-4xl font-extrabold text-gray-900">Checkout</h1>
            <p class="mt-3 max-w-2xl mx-auto text-gray-600">
                Periksa kembali pesanan Anda sebelum melakukan konfirmasi pembayaran.
            </p>
        </div>
    </section>

    <section class="pb-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('status'))
                <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-green-800">
                    {{ session('status') }}
                </div>
            @endif

            @php
                $itemsCollection = collect($items ?? []);
            @endphp

            <div class="grid gap-8 lg:grid-cols-[minmax(0,3fr)_minmax(0,2fr)]">
                <div class="space-y-6">
                    <div class="rounded-3xl border border-pink-100 bg-white p-6 shadow-sm">
                        <h2 class="text-lg font-semibold text-gray-900">Ringkasan Pesanan</h2>

                        @if($itemsCollection->isEmpty())
                            <p class="mt-4 text-sm text-gray-500">Tidak ada item dalam keranjang Anda.</p>
                        @else
                            <ul class="mt-4 space-y-4 text-sm text-gray-700">
                                @foreach($itemsCollection as $item)
                                    @php
                                        $name = $item['name'] ?? $item['name_cache'] ?? data_get($item, 'name') ?? data_get($item, 'name_cache') ?? 'Layanan';
                                        $qty = (int) ($item['qty'] ?? data_get($item, 'qty', 1));
                                        $price = (float) ($item['price'] ?? data_get($item, 'price') ?? data_get($item, 'unit_price') ?? 0);
                                        $slot = $item['slot'] ?? data_get($item, 'slot');
                                        $subtotal = $price * $qty;
                                    @endphp
                                    <li class="rounded-2xl border border-pink-50 bg-pink-50/40 p-4">
                                        <p class="font-semibold text-gray-900">{{ $name }}</p>
                                        <p class="text-xs text-gray-500">Qty: {{ $qty }} · Rp{{ number_format($price, 0, ',', '.') }}</p>
                                        @if(! empty($slot))
                                            <p class="mt-1 text-xs text-gray-500">Jadwal: {{ $slot }}</p>
                                        @endif
                                        <p class="mt-2 text-sm font-semibold text-gray-900">Subtotal: Rp{{ number_format($subtotal, 0, ',', '.') }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <aside class="rounded-3xl border border-pink-100 bg-pink-50/60 p-6">
                    <h2 class="text-lg font-semibold text-gray-900">Total Pembayaran</h2>
                    <dl class="mt-4 space-y-3 text-sm text-gray-600">
                        <div class="flex items-center justify-between border-t border-pink-100 pt-3 text-base font-semibold text-gray-900">
                            <dt>Total</dt>
                            <dd>Rp{{ number_format($total ?? 0, 0, ',', '.') }}</dd>
                        </div>
                    </dl>

                    <form action="{{ route('checkout.store') }}" method="POST" class="mt-6 space-y-3">
                        @csrf
                        <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-full bg-pink-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-pink-200 transition hover:bg-pink-700">
                            Konfirmasi Pembayaran
                            <i class="fa-solid fa-shield-heart"></i>
                        </button>
                        <a href="{{ route('cart.index') }}" class="inline-flex w-full items-center justify-center gap-2 rounded-full border border-pink-200 px-6 py-3 text-sm font-semibold text-pink-600 transition hover:bg-white">
                            Kembali ke Keranjang
                        </a>
                    </form>
                </aside>
            </div>
        </div>
    </section>
</x-layout.base>
