<x-layout.base title="Layanan & Paket">
    <section class="bg-gradient-to-br from-pink-50 via-white to-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="text-sm font-semibold tracking-wide text-pink-500 uppercase">Shakila Salon</span>
                <h1 class="mt-3 text-4xl font-extrabold text-gray-900 sm:text-5xl">Pesan &amp; Bayar Langsung</h1>
                <p class="mt-4 max-w-2xl mx-auto text-lg text-gray-600">
                    Pilih layanan favorit atau paket hemat, masukkan ke keranjang, dan selesaikan pemesanan dalam hitungan menit.
                </p>
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

            @if($packages->isNotEmpty())
                <div class="mb-14">
                    <div class="flex items-center justify-between flex-wrap gap-4 mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">Paket Populer</h2>
                            <p class="text-gray-600 text-sm">Gabungan layanan terbaik dengan harga lebih hemat.</p>
                        </div>
                        <a href="{{ route('cart.index') }}" class="text-sm font-semibold text-pink-600 hover:text-pink-700">Lihat Keranjang &rarr;</a>
                    </div>
                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @foreach($packages as $service)
                            <x-service-card :service="$service">
                                <x-slot name="details">
                                    <p class="font-semibold text-gray-800">Isi Paket:</p>
                                    <ul class="list-disc pl-5 space-y-1 text-sm text-gray-600">
                                        @foreach($service->packageItems as $item)
                                            <li>
                                                {{ $item->name }}
                                                <span class="text-gray-500">&times;{{ $item->pivot->qty }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </x-slot>
                            </x-service-card>
                        @endforeach
                    </div>
                </div>
            @endif

            <div>
                <div class="flex items-center justify-between flex-wrap gap-4 mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Layanan Satuan</h2>
                        <p class="text-gray-600 text-sm">Sesuaikan perawatan sesuai kebutuhan Anda.</p>
                    </div>
                    <a href="{{ route('cart.index') }}" class="text-sm font-semibold text-pink-600 hover:text-pink-700">Keranjang Anda &rarr;</a>
                </div>
                @if($singles->isNotEmpty())
                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @foreach($singles as $service)
                            <x-service-card :service="$service" />
                        @endforeach
                    </div>
                @else
                    <div class="rounded-2xl border border-dashed border-gray-300 bg-white p-10 text-center text-gray-500">
                        Belum ada layanan yang tersedia saat ini.
                    </div>
                @endif
            </div>
        </div>
    </section>
</x-layout.base>
