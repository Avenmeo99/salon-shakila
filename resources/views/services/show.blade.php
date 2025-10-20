<x-layout.base :title="$service->name . ' — Shakila Salon'">
    <section class="max-w-3xl mx-auto px-4 py-10 space-y-6">
        <h1 class="text-2xl sm:text-3xl font-bold">{{ $service->name }}</h1>
        <p class="text-gray-600">{{ $service->description ?? '—' }}</p>
        <div class="text-lg font-bold">Rp {{ number_format((int)$service->price,0,',','.') }}</div>

        <form method="POST" action="{{ route('cart.add') }}" class="mt-4">
            @csrf
            <input type="hidden" name="service" value="{{ $service->slug }}">
            <button class="px-5 py-3 rounded-xl bg-pink-600 text-white">Tambah ke Keranjang</button>
        </form>

        <a href="{{ route('cart.index') }}" class="inline-block mt-2 px-4 py-2 rounded-lg bg-gray-900 text-white">
            Lihat Keranjang
        </a>
    </section>
</x-layout.base>
