<x-layout.base title="Keranjang Anda">
    <section class="bg-gray-50 py-16 min-h-[60vh]">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Keranjang Pemesanan</h1>
                <p class="mt-2 text-gray-600">Tinjau layanan pilihan Anda sebelum melanjutkan ke pembayaran.</p>
            </div>

            @if(session('status'))
                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-800">
                    {{ session('status') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            @if(!$cart || $cart->items->isEmpty())
                <div class="bg-white border border-dashed border-gray-300 rounded-3xl p-12 text-center text-gray-500">
                    Keranjang Anda masih kosong. <a href="{{ route('services.index') }}" class="text-pink-600 hover:text-pink-700 font-semibold">Lihat layanan</a> untuk mulai berbelanja.
                </div>
            @else
                <div class="bg-white shadow-xl rounded-3xl overflow-hidden">
                    <div class="divide-y divide-gray-100">
                        @foreach($cart->items as $item)
                            <div class="p-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $item->name_cache }}</h3>
                                    <p class="text-sm text-gray-500">Rp{{ number_format($item->unit_price, 0, ',', '.') }} / layanan</p>
                                </div>
                                <div class="flex items-center gap-4">
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center gap-3">
                                        @csrf
                                        @method('PATCH')
                                        <label class="text-sm text-gray-600">
                                            Jumlah
                                            <input type="number" min="1" name="qty" value="{{ $item->qty }}" class="w-20 ml-2 rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500">
                                        </label>
                                        <button type="submit" class="text-sm text-pink-600 hover:text-pink-700 font-semibold">Perbarui</button>
                                    </form>
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm text-gray-400 hover:text-red-500">Hapus</button>
                                    </form>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-gray-500">Total</p>
                                    <p class="text-xl font-bold text-gray-900">Rp{{ number_format($item->unit_price * $item->qty, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="bg-gray-50 border-t border-gray-100 p-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="text-sm text-gray-600 space-y-1">
                            <p>Subtotal: <span class="font-semibold text-gray-900">Rp{{ number_format($cart->subtotal, 0, ',', '.') }}</span></p>
                            <p>Diskon: <span class="font-semibold text-gray-900">Rp{{ number_format($cart->discount, 0, ',', '.') }}</span></p>
                            <p class="text-base font-bold text-gray-900">Total: Rp{{ number_format($cart->total, 0, ',', '.') }}</p>
                        </div>
                        <div class="flex flex-wrap gap-3">
                            <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 text-sm font-semibold text-gray-500 hover:text-red-500">Kosongkan Keranjang</button>
                            </form>
                            <a href="{{ route('checkout.show') }}" class="inline-flex items-center px-5 py-3 rounded-full bg-pink-600 text-white text-sm font-semibold hover:bg-pink-700">Lanjut Checkout</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
</x-layout.base>
