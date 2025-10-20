<x-layout.base :title="$service->name">
    <section class="bg-white py-16">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="{{ route('services.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700 mb-6">
                &larr; Kembali ke daftar layanan
            </a>

            <div class="overflow-hidden rounded-3xl border border-pink-100 bg-white shadow-xl">
                <div class="p-8 md:p-12">
                    <div class="mb-4 flex items-center justify-between flex-wrap gap-4">
                        <span class="inline-flex items-center rounded-full bg-pink-50 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-pink-500">
                            {{ $service->type === 'package' ? 'Paket' : 'Layanan Satuan' }}
                        </span>
                        <span class="text-sm text-gray-500">Durasi estimasi {{ $service->duration_minutes }} menit</span>
                    </div>

                    <h1 class="mb-4 text-4xl font-bold text-gray-900">{{ $service->name }}</h1>

                    @if($service->description)
                        <div class="prose prose-pink max-w-none text-gray-700 leading-relaxed mb-8">
                            {!! nl2br(e($service->description)) !!}
                        </div>
                    @endif

                    @if($service->type === 'package' && $service->packageItems->isNotEmpty())
                        <div class="mb-8 rounded-2xl border border-pink-100 bg-pink-50 p-6">
                            <h2 class="mb-3 text-lg font-semibold text-pink-700">Isi Paket</h2>
                            <ul class="grid gap-2 sm:grid-cols-2">
                                @foreach($service->packageItems as $item)
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1 inline-flex h-2.5 w-2.5 flex-shrink-0 rounded-full bg-pink-400"></span>
                                        <span class="text-sm text-gray-700">
                                            {{ $item->name }}
                                            <span class="text-gray-500">&times;{{ $item->pivot->qty }}</span>
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Harga</p>
                            <p class="text-4xl font-bold text-pink-600">Rp{{ number_format($service->effectivePrice(), 0, ',', '.') }}</p>
                        </div>
                        <form action="{{ route('cart.add') }}" method="POST" class="flex flex-col items-start gap-4 sm:flex-row sm:items-center">
                            @csrf
                            <input type="hidden" name="service" value="{{ $service->slug }}">
                            <label class="flex items-center gap-2 text-sm text-gray-700">
                                Jumlah
                                <input type="number" name="qty" value="1" min="1" class="w-20 rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500">
                            </label>
                            <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-full bg-pink-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-pink-200 transition hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                                Tambah ke Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="mt-10 flex flex-wrap gap-4">
                <a href="{{ route('bookings.create', ['service' => $service->slug]) }}" class="inline-flex items-center rounded-full bg-white px-5 py-3 text-sm font-semibold text-pink-600 transition hover:bg-pink-50">
                    Booking
                </a>
                <a href="{{ route('cart.index') }}" class="inline-flex items-center rounded-full bg-gray-100 px-5 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-200">
                    Lihat Keranjang
                </a>
                <a href="{{ route('checkout.index') }}" class="inline-flex items-center rounded-full bg-pink-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-pink-700">
                    Lanjut ke Checkout
                </a>
            </div>
        </div>
    </section>
</x-layout.base>
