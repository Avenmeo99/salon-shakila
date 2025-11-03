<<<<<<< HEAD
<x-layout.base :title="'Layanan — Shakila Salon'">
    <section class="max-w-5xl mx-auto px-4 py-10 space-y-8">
        <h1 class="text-2xl sm:text-3xl font-bold">Pesan & Bayar Langsung</h1>

        <div class="space-y-6">
            <h2 class="text-xl font-semibold">Layanan Satuan</h2>
            @if($singles->isEmpty())
                <p class="text-gray-500">Belum ada layanan yang tersedia saat ini.</p>
            @else
                <ul class="grid sm:grid-cols-2 gap-4">
                    @foreach($singles as $s)
                        <li class="rounded-xl border p-4">
                            <div class="font-semibold">{{ $s->name }}</div>
                            <div class="text-sm text-gray-500 mb-2">{{ $s->description ?? '—' }}</div>
                            <div class="font-bold">Rp {{ number_format((int)$s->price,0,',','.') }}</div>
                            <a href="{{ route('services.show', $s->slug) }}"
                               class="inline-block mt-2 px-4 py-2 rounded-lg bg-pink-600 text-white">
                                Lihat
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
=======
{{-- resources/views/services/index.blade.php --}}
<x-layout.base :title="'Layanan — Shakila Salon'">
    <section class="max-w-6xl mx-auto px-4 py-10">
        <div class="text-center mb-8">
            <div class="text-xs tracking-widest text-pink-600 font-semibold">SHAKILA SALON</div>
            <h1 class="mt-1 text-3xl sm:text-4xl font-bold text-gray-900">Pesan & Bayar Langsung</h1>
            <p class="text-gray-600 mt-2">Pilih layanan favorit, masukkan ke keranjang, atau booking dengan DP 50%.</p>
>>>>>>> 198812f (First commit - upload salon_shakila project)
        </div>

        <h2 class="text-lg font-semibold mb-4">Layanan Satuan</h2>

        @php
            $images = [
                asset('images/salon1.jpg'),
                asset('images/salon2.jpg'),
                asset('images/salon3.jpg'),
                asset('images/salon4.jpg'),
            ];
        @endphp

        @if($singles->count() === 0)
            <div class="rounded-xl border bg-white p-6 text-gray-600">Belum ada layanan yang tersedia saat ini.</div>
        @else
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($singles as $i => $svc)
                    @php
                        $img = $svc->image_url ? asset($svc->image_url) : $images[$i % 4];
                    @endphp

                    <div class="group bg-white rounded-2xl border overflow-hidden shadow-sm hover:shadow-lg transition">
                        <div class="overflow-hidden h-48">
                            <img src="{{ $img }}" alt="{{ $svc->name }}" class="w-full h-48 object-cover group-hover:scale-[1.03] transition">
                        </div>

                        <div class="p-5 space-y-2">
                            <h3 class="font-semibold text-gray-900">{{ $svc->name }}</h3>
                            <p class="text-sm text-gray-500 line-clamp-2">{{ $svc->description }}</p>
                            <div class="pt-1 font-semibold">Rp {{ number_format($svc->price,0,',','.') }}</div>

                            <div class="flex items-center gap-2 pt-2">
                                {{-- PESAN SEKARANG: add ke keranjang pemesanan (full) --}}
                                <form method="POST" action="{{ route('cart.add.slug', $svc->slug) }}">
                                    @csrf
                                    <input type="hidden" name="qty" value="1">
                                    <input type="hidden" name="go_checkout" value="0">
                                    <button class="inline-flex items-center rounded-lg bg-pink-600 text-white px-4 py-2 hover:bg-pink-700 transition">
                                        Pesan Sekarang
                                    </button>
                                </form>

                                {{-- BOOKING: ke form booking --}}
                                <a href="{{ route('bookings.create', $svc->slug) }}"
                                   class="inline-flex items-center rounded-lg border px-4 py-2 hover:bg-gray-50 transition">
                                    Booking
                                </a>
                            </div>

                            <div class="pt-2">
                                <a href="{{ route('services.show', $svc->slug) }}"
                                   class="inline-flex items-center w-full justify-center rounded-lg bg-gray-900 text-white px-4 py-2 hover:bg-black/80 transition">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Paket Promo (ambil dari services type=package) --}}
        @if(($packages ?? collect())->count())
            <h2 class="text-lg font-semibold mt-10 mb-4">Paket Spesial Minggu Ini</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($packages->take(3) as $i => $svc)
                    @php
                        $img = $svc->image_url ? asset($svc->image_url) : $images[$i % 4];
                    @endphp
                    <div class="group bg-gradient-to-br from-pink-50 to-white rounded-2xl border overflow-hidden shadow-sm hover:shadow-lg transition">
                        <div class="overflow-hidden h-44">
                            <img src="{{ $img }}" alt="{{ $svc->name }}" class="w-full h-44 object-cover group-hover:scale-[1.03] transition">
                        </div>
                        <div class="p-5 space-y-2">
                            <div class="text-xs font-semibold text-pink-700">Paket Promo</div>
                            <h3 class="font-semibold text-gray-900">{{ $svc->name }}</h3>
                            <div class="pt-1 font-semibold">Rp {{ number_format($svc->price,0,',','.') }}</div>

                            <div class="flex items-center gap-2 pt-2">
                                <form method="POST" action="{{ route('cart.add.slug', $svc->slug) }}">
                                    @csrf
                                    <input type="hidden" name="qty" value="1">
                                    <input type="hidden" name="go_checkout" value="0">
                                    <button class="inline-flex items-center rounded-lg bg-pink-600 text-white px-4 py-2 hover:bg-pink-700 transition">
                                        Pesan Sekarang
                                    </button>
                                </form>

                                <a href="{{ route('bookings.create', $svc->slug) }}"
                                   class="inline-flex items-center rounded-lg border px-4 py-2 hover:bg-gray-50 transition">
                                    Booking
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
</x-layout.base>
