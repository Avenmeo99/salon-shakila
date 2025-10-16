<x-layout.base>
    <x-slot name="title">Salon Shakila - Salon Kecantikan Terpercaya</x-slot>
    <x-slot name="description">Salon Shakila menyediakan layanan kecantikan terlengkap dengan terapis profesional. Booking online dan belanja produk kecantikan berkualitas.</x-slot>

    <!-- Hero Section -->
    <x-sections.hero 
        title="Wujudkan Kecantikan <span class='block text-yellow-300'>Impian Anda</span>"
        subtitle="Salon kecantikan terpercaya dengan layanan profesional dan produk berkualitas tinggi">
        
        <x-slot name="primaryButton">
            {{-- Dulu: route('booking') → booking kini per-layanan, jadi arahkan ke daftar layanan --}}
            <x-ui.button href="{{ route('services.index') }}" variant="white" size="lg">
                Booking Sekarang
            </x-ui.button>
        </x-slot>
        
        <x-slot name="secondaryButton">
            {{-- Dulu: route('services') --}}
            <x-ui.button href="{{ route('services.index') }}" variant="secondary" size="lg">
                Lihat Layanan
            </x-ui.button>
        </x-slot>
    </x-sections.hero>

    <!-- Features Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Mengapa Memilih Salon Shakila?
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Kami berkomitmen memberikan pengalaman kecantikan terbaik dengan standar profesional tertinggi
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <x-ui.feature-card 
                    title="Terapis Profesional"
                    description="Tim terapis berpengalaman dan tersertifikasi yang siap memberikan layanan terbaik untuk Anda">
                    <x-slot name="icon">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </x-slot>
                </x-ui.feature-card>

                <x-ui.feature-card 
                    title="Produk Berkualitas"
                    description="Menggunakan produk kecantikan premium dan berkualitas tinggi dari brand terpercaya">
                    <x-slot name="icon">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </x-slot>
                </x-ui.feature-card>

                <x-ui.feature-card 
                    title="Booking Online"
                    description="Sistem booking online yang mudah dan praktis, bisa diakses kapan saja dan dimana saja">
                    <x-slot name="icon">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </x-slot>
                </x-ui.feature-card>
            </div>
        </div>
    </section>

    <!-- Services Preview Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Layanan Unggulan Kami
                </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Berbagai layanan kecantikan lengkap untuk memenuhi kebutuhan perawatan Anda
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Service 1 -->
                <div class="group cursor-pointer">
                    <x-ui.card variant="gradient" padding="default" class="text-center group-hover:scale-105 transition-transform duration-300">
                        <div class="w-16 h-16 bg-gradient-to-r from-pink-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Facial Treatment</h3>
                        <p class="text-gray-600 text-sm">Perawatan wajah lengkap untuk kulit sehat dan berseri</p>
                    </x-ui.card>
                </div>

                <!-- Service 2 -->
                <div class="group cursor-pointer">
                    <x-ui.card variant="gradient" padding="default" class="text-center group-hover:scale-105 transition-transform duration-300">
                        <div class="w-16 h-16 bg-gradient-to-r from-pink-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM7 3V1m0 18v2m8-10h2m-2 4h2m-2-8h2m-2-4h2"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Hair Styling</h3>
                        <p class="text-gray-600 text-sm">Potong, styling, dan perawatan rambut profesional</p>
                    </x-ui.card>
                </div>

                <!-- Service 3 -->
                <div class="group cursor-pointer">
                    <x-ui.card variant="gradient" padding="default" class="text-center group-hover:scale-105 transition-transform duration-300">
                        <div class="w-16 h-16 bg-gradient-to-r from-pink-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Make Up</h3>
                        <p class="text-gray-600 text-sm">Make up profesional untuk berbagai acara spesial</p>
                    </x-ui.card>
                </div>

                <!-- Service 4 -->
                <div class="group cursor-pointer">
                    <x-ui.card variant="gradient" padding="default" class="text-center group-hover:scale-105 transition-transform duration-300">
                        <div class="w-16 h-16 bg-gradient-to-r from-pink-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2m-9 0h10m-10 0a2 2 0 00-2 2v14a2 2 0 002 2h10a2 2 0 002-2V6a2 2 0 00-2-2"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Nail Art</h3>
                        <p class="text-gray-600 text-sm">Perawatan kuku dan nail art dengan desain menarik</p>
                    </x-ui.card>
                </div>
            </div>

            <div class="text-center mt-12">
                {{-- Dulu: route('services') --}}
                <x-ui.button href="{{ route('services.index') }}" variant="primary" size="default">
                    Lihat Semua Layanan
                </x-ui.button>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Apa Kata Pelanggan Kami
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Kepuasan pelanggan adalah prioritas utama kami
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <x-ui.testimonial-card 
                    name="Sari Andini"
                    role="Pelanggan Setia"
                    content="Pelayanan di Salon Shakila sangat memuaskan! Terapis sangat profesional dan hasilnya selalu sesuai harapan. Pasti akan kembali lagi!"
                    :rating="5" />

                <x-ui.testimonial-card 
                    name="Dina Pratiwi"
                    role="Pelanggan Baru"
                    content="Sistem booking online sangat memudahkan! Tidak perlu antri lama dan bisa pilih waktu sesuai keinginan. Recommended banget!"
                    :rating="5" />

                <x-ui.testimonial-card 
                    name="Maya Rahayu"
                    role="Pelanggan Reguler"
                    content="Produk yang dijual di sini berkualitas tinggi dan harganya reasonable. Staff juga ramah dan memberikan konsultasi yang baik."
                    :rating="5" />
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-pink-500 to-purple-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                Siap Tampil Lebih Cantik?
            </h2>
            <p class="text-xl mb-8 max-w-3xl mx-auto">
                Booking sekarang dan rasakan pengalaman kecantikan terbaik di Salon Shakila
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                {{-- Dulu: route('booking') --}}
                <x-ui.button href="{{ route('services.index') }}" variant="white" size="lg">
                    Booking Sekarang
                </x-ui.button>
                <x-ui.button href="tel:+6221234567" variant="secondary" size="lg">
                    Hubungi Kami
                </x-ui.button>
            </div>
        </div>
    </section>
</x-layout.base>
