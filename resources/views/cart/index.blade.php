<x-layout.base :title="'Keranjang — Shakila Salon'">
    {{-- Header / Hero --}}
    <section class="bg-gradient-to-b from-pink-50 to-white py-14">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-xs tracking-[0.3em] text-pink-600 font-semibold">SHAKILA SALON</p>
            <h1 class="mt-4 text-3xl sm:text-4xl font-extrabold text-gray-900">Keranjang Pemesanan</h1>
            <p class="mt-3 max-w-2xl mx-auto text-gray-600">
                Tinjau layanan yang telah Anda pilih sebelum melanjutkan ke proses checkout atau melakukan booking.
            </p>
        </div>
    </section>

    <section class="pb-16">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('status'))
                <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-green-800">
                    {{ session('status') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            @if($cart->items->isEmpty())
                <div class="rounded-3xl border border-dashed border-gray-300 bg-white px-10 py-14 text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-pink-100 text-pink-600">
                        <i class="fa-solid fa-cart-shopping text-2xl"></i>
                    </div>
                    <h2 class="mt-6 text-2xl font-semibold text-gray-900">Keranjang Anda kosong</h2>
                    <p class="mt-3 text-gray-600">Mulai jelajahi layanan dan paket kami untuk menambahkan pesanan.</p>
                    <div class="mt-6">
                        <a href="{{ route('services.index') }}" class="inline-flex items-center gap-2 rounded-full bg-pink-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-pink-200 transition hover:bg-pink-700">
                            <i class="fa-solid fa-spa"></i>
                            Jelajahi Layanan
                        </a>
                    </div>
                </div>
            @else
                <div class="grid gap-8 lg:grid-cols-[minmax(0,2fr)_minmax(0,1fr)]">
                    <div class="space-y-6">
                        @foreach($cart->items as $item)
                            <div class="rounded-3xl border border-pink-100 bg-white p-6 shadow-sm">
                                <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                                    <div>
                                        <p class="text-lg font-semibold text-gray-900">{{ $item->name_cache }}</p>
                                        <p class="text-sm text-gray-500">@if($item->service?->duration) {{ $item->service?->duration }} menit · @endifRp{{ number_format($item->unit_price, 0, ',', '.') }} / layanan</p>
                                    </div>
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="sm:ml-4">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center text-sm font-semibold text-gray-400 hover:text-red-500 transition" aria-label="Hapus layanan dari keranjang">
                                            <i class="fa-solid fa-xmark mr-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>

                                <div class="mt-4 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center gap-3">
                                        @csrf
                                        @method('PATCH')
                                        <label for="qty-{{ $item->id }}" class="text-sm font-medium text-gray-700">Jumlah</label>
                                        <div class="flex items-center rounded-full border border-gray-200 bg-gray-50 px-2">
                                            <input id="qty-{{ $item->id }}" name="qty" type="number" min="1" value="{{ $item->qty }}" class="w-20 border-0 bg-transparent text-center text-sm font-semibold text-gray-900 focus:ring-0" />
                                        </div>
                                        <button type="submit" class="rounded-full bg-pink-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-pink-700">
                                            Perbarui
                                        </button>
                                    </form>

                                    <p class="text-lg font-semibold text-gray-900">
                                        Rp{{ number_format($item->unit_price * $item->qty, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach

                        <form action="{{ route('cart.clear') }}" method="POST" class="text-right">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-500 hover:text-red-500 transition">
                                <i class="fa-solid fa-trash-can"></i>
                                Kosongkan Keranjang
                            </button>
                        </form>
                    </div>

                    <aside class="rounded-3xl border border-pink-100 bg-pink-50/60 p-6">
                        <h2 class="text-lg font-semibold text-gray-900">Ringkasan</h2>
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

                        <div class="mt-6 space-y-3">
                            <a href="{{ route('checkout.show') }}" class="inline-flex w-full items-center justify-center gap-2 rounded-full bg-pink-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-pink-200 transition hover:bg-pink-700">
                                Lanjutkan ke Checkout
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                            <a href="{{ route('services.index') }}" class="inline-flex w-full items-center justify-center gap-2 rounded-full border border-pink-200 px-6 py-3 text-sm font-semibold text-pink-600 transition hover:bg-white">
                                Tambah Layanan Lain
                            </a>
                        </div>
                    </aside>
                </div>
            @endif
        </div>
    </section>
</x-layout.base>
