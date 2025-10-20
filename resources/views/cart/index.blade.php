{{-- resources/views/cart/index.blade.php --}}
<x-layout.base :title="'Keranjang — Shakila Salon'">
    @php
        // Controller sudah mengirimkan $cart + items.service (lihat CartController@index)
        $items = collect($cart->items ?? []);
        $totalQty   = $items->sum(fn($it) => (int) ($it->qty ?? 1));
        $grandTotal = $items->sum(fn($it) => (int) ($it->qty ?? 1) * (int) ($it->unit_price ?? 0));
    @endphp

    {{-- Hero --}}
    <section class="bg-gradient-to-b from-pink-50 to-white py-8">
        <div class="max-w-5xl mx-auto px-4">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Keranjang Pemesanan</h1>
            <p class="text-gray-600 mt-2">Tinjau layanan sebelum checkout.</p>

            @if(session('status'))
                <div class="mt-3 rounded-lg bg-emerald-50 text-emerald-700 px-4 py-2">{{ session('status') }}</div>
            @endif
        </div>
    </section>

    <section class="max-w-5xl mx-auto px-4 pb-24">
        @if($items->isEmpty())
            <div class="mt-8 rounded-xl border bg-white p-6">
                <h2 class="text-xl font-semibold mb-2">Keranjang Anda kosong</h2>
                <p class="text-gray-600 mb-4">Mulai jelajahi layanan dan paket kami.</p>
                <a href="{{ route('services.index') }}"
                   class="inline-flex items-center px-5 py-3 rounded-xl bg-pink-600 text-white font-semibold hover:bg-pink-700">
                    Jelajahi Layanan
                </a>
            </div>
        @else
            <div class="mt-6 grid md:grid-cols-3 gap-6">
                {{-- LIST ITEM --}}
                <div class="md:col-span-2 space-y-4">
                    @foreach($items as $it)
                        @php
                            $id    = $it->id;
                            $name  = $it->service->name ?? $it->name_cache ?? 'Layanan';
                            $qty   = (int) $it->qty;
                            $price = (int) ($it->unit_price ?? 0);
                            $slot  = $it->slot ?? null;
                            $subtotal = $qty * $price;
                        @endphp

                        <div class="rounded-xl border bg-white p-4">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="font-semibold">{{ $name }}</p>
                                    @if($slot)
                                        <p class="text-sm text-gray-500">Jadwal: {{ $slot }}</p>
                                    @endif
                                    <p class="text-sm text-gray-500">Harga: Rp {{ number_format($price,0,',','.') }}</p>
                                </div>

                                {{-- ACTIONS: Update qty + Hapus --}}
                                <div class="flex items-center gap-2">
                                    {{-- Update qty --}}
                                    <form method="POST" action="{{ route('cart.update', $id) }}" class="flex items-center gap-2">
                                        @csrf @method('PATCH')
                                        <input type="number" name="qty" min="1" value="{{ $qty }}"
                                               class="w-16 rounded-lg border px-2 py-1 text-center" />
                                        <button type="submit"
                                                class="rounded-lg bg-gray-900 text-white px-3 py-1.5 hover:bg-black/80">
                                            Update
                                        </button>
                                    </form>

                                    {{-- Hapus item (langsung) --}}
                                    <form method="POST" action="{{ route('cart.remove', $id) }}">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="rounded-lg border px-3 py-1.5 text-gray-600 hover:bg-gray-50">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="mt-3 text-right font-semibold">
                                Subtotal: Rp {{ number_format($subtotal, 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- SIDEBAR TOTAL --}}
                <aside class="rounded-2xl border p-5 h-fit">
                    <div class="flex justify-between text-gray-600">
                        <span>Total Item</span>
                        <span class="font-semibold">{{ $totalQty }}</span>
                    </div>
                    <div class="flex justify-between items-baseline mt-2">
                        <span class="text-gray-600">Total</span>
                        <span class="text-xl font-bold">Rp {{ number_format($grandTotal,0,',','.') }}</span>
                    </div>

                    <a href="{{ route('checkout.index') }}"
                       class="mt-4 block text-center px-6 py-3 rounded-xl bg-pink-600 text-white font-semibold hover:bg-pink-700">
                        Bayar Sekarang
                    </a>

                    <a href="{{ route('services.index') }}"
                       class="mt-2 block text-center px-6 py-3 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-50">
                        Tambah Layanan Lain
                    </a>
                </aside>
            </div>
        @endif
    </section>
</x-layout.base>
