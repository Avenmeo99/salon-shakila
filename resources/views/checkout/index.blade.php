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

            <div class="grid gap-8 lg:grid-cols-[minmax(0,3fr)_minmax(0,2fr)]">
                <div class="space-y-6">
                    <div class="rounded-3xl border border-pink-100 bg-white p-6 shadow-sm">
                        <h2 class="text-lg font-semibold text-gray-900">Ringkasan Pesanan</h2>
                        <div class="mt-4 overflow-x-auto">
                            <table class="min-w-full divide-y divide-pink-100 text-sm">
                                <thead>
                                    <tr class="text-left text-gray-500">
                                        <th class="py-2">Layanan</th>
                                        <th class="py-2 text-center">Qty</th>
                                        <th class="py-2 text-right">Harga</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-pink-50 text-gray-700">
                                    @foreach($cart->items as $item)
                                        <tr>
                                            <td class="py-3 pr-4">
                                                <p class="font-semibold text-gray-900">{{ $item->name_cache }}</p>
                                                @if($item->service?->duration)
                                                    <p class="text-xs text-gray-500">Durasi {{ $item->service->duration }} menit</p>
                                                @endif
                                            </td>
                                            <td class="py-3 text-center font-semibold">{{ $item->qty }}</td>
                                            <td class="py-3 text-right font-semibold text-gray-900">Rp{{ number_format($item->unit_price * $item->qty, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <aside class="rounded-3xl border border-pink-100 bg-pink-50/60 p-6">
                    <h2 class="text-lg font-semibold text-gray-900">Total Pembayaran</h2>
                    <dl class="mt-4 space-y-3 text-sm text-gray-600">
                        <div class="flex items-center justify-between">
                            <dt>Subtotal</dt>
                            <dd class="font-semibold text-gray-900">Rp{{ number_format($cart->subtotal, 0, ',', '.') }}</dd>
                        </div>
                        <div class="flex items-center justify-between">
                            <dt>Diskon</dt>
                            <dd class="font-semibold text-gray-900">Rp{{ number_format($cart->discount, 0, ',', '.') }}</dd>
                        </div>
                        <div class="flex items-center justify-between border-t border-pink-100 pt-3 text-base font-semibold text-gray-900">
                            <dt>Total</dt>
                            <dd>Rp{{ number_format($cart->total, 0, ',', '.') }}</dd>
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
