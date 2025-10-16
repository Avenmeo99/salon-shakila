<x-layout.base title="Checkout">
    <section class="bg-white py-16">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10">
                <h1 class="text-3xl font-bold text-gray-900">Checkout</h1>
                <p class="mt-2 text-gray-600">Konfirmasi data pemesan dan selesaikan pembayaran Anda.</p>
            </div>

            <div class="grid gap-10 lg:grid-cols-2">
                <div class="bg-white border border-pink-100 rounded-3xl shadow-lg p-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Ringkasan Keranjang</h2>
                    <div class="space-y-4">
                        @foreach($cart->items as $item)
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $item->name_cache }}</p>
                                    <p class="text-sm text-gray-500">{{ $item->qty }} &times; Rp{{ number_format($item->unit_price, 0, ',', '.') }}</p>
                                </div>
                                <p class="font-semibold text-gray-900">Rp{{ number_format($item->unit_price * $item->qty, 0, ',', '.') }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-6 border-t border-gray-100 pt-6 space-y-2 text-sm text-gray-600">
                        <p>Subtotal <span class="float-right font-semibold text-gray-900">Rp{{ number_format($cart->subtotal, 0, ',', '.') }}</span></p>
                        <p>Diskon <span class="float-right font-semibold text-gray-900">Rp{{ number_format($cart->discount, 0, ',', '.') }}</span></p>
                        <p class="text-base font-bold text-gray-900">Total <span class="float-right">Rp{{ number_format($cart->total, 0, ',', '.') }}</span></p>
                    </div>
                </div>

                <div class="bg-gray-50 border border-gray-200 rounded-3xl p-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Data Pemesan</h2>
                    <form action="{{ route('checkout.process') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label for="customer_name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}" required class="mt-2 w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500">
                            @error('customer_name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="customer_phone" class="block text-sm font-medium text-gray-700">Nomor WhatsApp</label>
                            <input type="tel" name="customer_phone" id="customer_phone" value="{{ old('customer_phone') }}" required class="mt-2 w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500">
                            @error('customer_phone')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="bg-white border border-pink-100 rounded-2xl p-4 text-sm text-gray-600">
                            <p class="font-semibold text-gray-900 mb-2">Catatan Pembayaran</p>
                            <p>Setelah menekan tombol bayar, tim kami akan menghubungi Anda melalui WhatsApp untuk menyelesaikan pembayaran via Midtrans. Pesanan baru aktif setelah pembayaran terkonfirmasi.</p>
                        </div>
                        <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-3 rounded-full bg-pink-600 text-white text-sm font-semibold shadow-lg shadow-pink-200 transition hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                            Bayar Sekarang
                        </button>
                    </form>
                </div>
            </div>

            <div class="mt-10 text-sm text-gray-600">
                <a href="{{ route('cart.index') }}" class="text-pink-600 hover:text-pink-700 font-semibold">Kembali ke Keranjang</a>
            </div>
        </div>
    </section>
</x-layout.base>
