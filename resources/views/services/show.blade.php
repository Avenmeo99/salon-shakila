<<<<<<< HEAD
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
=======
<x-layout.base :title="$service->name . ' — Layanan'">
    <section class="max-w-4xl mx-auto px-4 py-10">
        @php
            $placeholder = asset('images/salon1.jpg');
            $img = $placeholder;
            if (!empty($service->image_url)) {
                $candidate = public_path($service->image_url);
                $img = file_exists($candidate) ? asset($service->image_url) : $placeholder;
            }
        @endphp

        <div class="bg-white border rounded-2xl overflow-hidden">
            <img src="{{ $img }}" alt="{{ $service->name }}" class="w-full h-56 object-cover">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-900">{{ $service->name }}</h1>
                <p class="text-gray-600 mt-2">{{ $service->description ?? '—' }}</p>
                <div class="mt-3 font-semibold text-lg">Rp {{ number_format((int)($service->price ?? 0),0,',','.') }}</div>

                <div class="mt-6 grid grid-cols-2 gap-2">
                    <form action="{{ route('cart.add.slug', $service->slug) }}" method="POST">
                        @csrf
                        <input type="hidden" name="qty" value="1">
                        <input type="hidden" name="kind" value="purchase">
                        <input type="hidden" name="redirect" value="checkout">
                        <button class="w-full inline-flex items-center justify-center rounded-lg bg-pink-600 text-white px-4 py-2 hover:bg-pink-700">
                            Pesan Sekarang
                        </button>
                    </form>

                    <form action="{{ route('cart.add.slug', $service->slug) }}" method="POST">
                        @csrf
                        <input type="hidden" name="qty" value="1">
                        <input type="hidden" name="kind" value="booking">
                        <input type="hidden" name="redirect" value="cart_booking">
                        <button class="w-full inline-flex items-center justify-center rounded-lg border px-4 py-2 hover:bg-gray-50">
                            Booking
                        </button>
                    </form>
                </div>
            </div>
        </div>
>>>>>>> 198812f (First commit - upload salon_shakila project)
    </section>
</x-layout.base>
