<x-layout.base :title="'Welcome - Shakila Salon'" :description="'Selamat datang di Salon Shakila, tempat terbaik untuk perawatan kecantikan Anda.'">

    <section class="relative bg-white py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-12 lg:items-center">
                <!-- Text -->
                <div class="mb-10 lg:mb-0">
                    <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl">
                        Shakila Salon
                        <span class="block text-pink-600">Wujudkan Kecantikan Impian Anda</span>
                    </h1>
                    <p class="mt-4 text-lg text-gray-600">
                        Nikmati layanan kecantikan terbaik dengan terapis profesional, produk berkualitas,
                        dan sistem booking online yang mudah dan praktis.
                    </p>

                    <div class="mt-6 flex flex-wrap gap-3">
                        @guest
                            <!-- Belum login -->
                            <a href="{{ route('login') }}"
                               class="px-6 py-3 rounded-lg bg-gradient-to-r from-pink-500 to-purple-600 text-white font-semibold shadow-md hover:opacity-90 transition">
                                Mulai Jelajahi
                            </a>
                            <a href="{{ route('login') }}"
                               class="px-6 py-3 rounded-lg border border-pink-500 text-pink-600 font-semibold hover:bg-pink-50 transition">
                                Lihat Layanan
                            </a>
                        @else
                            <!-- Sudah login -->
                            <a href="{{ route('branda') }}"
                               class="px-6 py-3 rounded-lg bg-gradient-to-r from-pink-500 to-purple-600 text-white font-semibold shadow-md hover:opacity-90 transition">
                                Mulai Jelajahi
                            </a>
                            <a href="{{ route('services.index') }}"
                               class="px-6 py-3 rounded-lg border border-pink-500 text-pink-600 font-semibold hover:bg-pink-50 transition">
                                Lihat Layanan
                            </a>

                            <!-- CTA tambahan -->
                            <a href="{{ route('services.index') }}"
                               class="px-6 py-3 rounded-lg bg-pink-100 text-pink-700 font-semibold hover:bg-pink-200 transition border border-pink-300">
                                Booking Sekarang
                            </a>
                        @endauth
                    </div>

                    @guest
                        <p class="mt-4 text-sm text-gray-500">
                            Belum punya akun?
                            <a href="{{ route('register') }}" class="font-semibold text-pink-600 hover:text-pink-700">Daftar sekarang</a>
                            untuk mulai booking & checkout.
                        </p>
                    @endguest
                </div>

                <!-- Images -->
                <div class="grid grid-cols-2 gap-4">
                    <img src="{{ asset('img/salon1.jpg') }}" alt="Ruang layanan Salon Shakila"
                         loading="lazy" class="w-full aspect-square object-cover rounded-lg shadow-lg">
                    <img src="{{ asset('img/salon2.jpg') }}" alt="Peralatan profesional di Salon Shakila"
                         loading="lazy" class="w-full aspect-square object-cover rounded-lg shadow-lg">
                    <img src="{{ asset('img/salon3.jpg') }}" alt="Proses perawatan kecantikan di Salon Shakila"
                         loading="lazy" class="w-full aspect-square object-cover rounded-lg shadow-lg">
                    <img src="{{ asset('img/salon4.jpg') }}" alt="Hasil perawatan pelanggan di Salon Shakila"
                         loading="lazy" class="w-full aspect-square object-cover rounded-lg shadow-lg">
                </div>
            </div>
        </div>
    </section>

</x-layout.base>
