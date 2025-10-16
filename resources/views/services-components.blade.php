<x-layout.base>
    <x-slot name="title">Layanan - Shakila Salon</x-slot>
    <x-slot name="description">Berbagai layanan kecantikan profesional di Shakila Salon. Facial, hair styling, makeup, nail art, dan perawatan kecantikan lainnya.</x-slot>

    <!-- Hero Section -->
    <x-sections.hero 
        title="Layanan Kecantikan Profesional"
        subtitle="Berbagai layanan kecantikan lengkap dengan standar profesional tertinggi"
        background="gradient" />

    <!-- Services Grid -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                
                <!-- Facial Treatment -->
                <x-ui.service-card 
                    title="Facial Treatment"
                    description="Perawatan wajah lengkap untuk berbagai jenis kulit dengan produk premium dan teknik profesional."
                    :services="[
                        'Facial Basic - Rp 150.000',
                        'Facial Acne - Rp 200.000',
                        'Facial Whitening - Rp 250.000',
                        'Facial Anti-Aging - Rp 300.000'
                    ]"
                    :booking-url="route('booking')">
                    <x-slot name="icon">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </x-slot>
                </x-ui.service-card>

                <!-- Hair Styling -->
                <x-ui.service-card 
                    title="Hair Styling"
                    description="Layanan potong, styling, dan perawatan rambut profesional dengan produk berkualitas tinggi."
                    :services="[
                        'Potong Rambut - Rp 75.000',
                        'Hair Wash & Blow - Rp 50.000',
                        'Hair Coloring - Rp 200.000',
                        'Hair Treatment - Rp 150.000'
                    ]"
                    :booking-url="route('booking')">
                    <x-slot name="icon">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM7 3V1m0 18v2m8-10h2m-2 4h2m-2-8h2m-2-4h2"/>
                        </svg>
                    </x-slot>
                </x-ui.service-card>

                <!-- Make Up -->
                <x-ui.service-card 
                    title="Make Up"
                    description="Layanan make up profesional untuk berbagai acara dengan produk premium dan teknik terkini."
                    :services="[
                        'Make Up Natural - Rp 200.000',
                        'Make Up Party - Rp 300.000',
                        'Make Up Wedding - Rp 500.000',
                        'Make Up Photoshoot - Rp 400.000'
                    ]"
                    :booking-url="route('booking')">
                    <x-slot name="icon">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </x-slot>
                </x-ui.service-card>

                <!-- Nail Art -->
                <x-ui.service-card 
                    title="Nail Art"
                    description="Perawatan kuku dan nail art dengan desain kreatif menggunakan produk berkualitas tinggi."
                    :services="[
                        'Manicure Basic - Rp 75.000',
                        'Pedicure Basic - Rp 100.000',
                        'Nail Art Simple - Rp 125.000',
                        'Nail Art Premium - Rp 200.000'
                    ]"
                    :booking-url="route('booking')">
                    <x-slot name="icon">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2m-9 0h10m-10 0a2 2 0 00-2 2v14a2 2 0 002 2h10a2 2 0 002-2V6a2 2 0 00-2-2"/>
                        </svg>
                    </x-slot>
                </x-ui.service-card>

            </div>
        </div>
    </section>

    <!-- Package Deals -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Paket Hemat
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Dapatkan lebih banyak dengan harga lebih hemat melalui paket layanan kami
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Package 1 -->
                <x-ui.card padding="lg" class="border-2 border-transparent hover:border-pink-200">
                    <div class="text-center mb-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Paket Basic</h3>
                        <div class="text-3xl font-bold text-pink-600 mb-2">Rp 300.000</div>
                        <div class="text-gray-500 line-through">Rp 375.000</div>
                        <div class="text-green-600 font-semibold">Hemat Rp 75.000</div>
                    </div>
                    <div class="space-y-3 mb-8">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-700">Facial Basic</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-700">Potong Rambut</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-700">Hair Wash & Blow</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-700">Manicure Basic</span>
                        </div>
                    </div>
                    <x-ui.button href="{{ route('booking') }}" variant="primary" class="w-full">
                        Pilih Paket
                    </x-ui.button>
                </x-ui.card>

                <!-- Package 2 -->
                <x-ui.card variant="featured" padding="lg">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                        <span class="bg-gradient-to-r from-pink-500 to-purple-600 text-white px-4 py-2 rounded-full text-sm font-semibold">
                            TERPOPULER
                        </span>
                    </div>
                    <div class="text-center mb-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Paket Premium</h3>
                        <div class="text-3xl font-bold text-pink-600 mb-2">Rp 550.000</div>
                        <div class="text-gray-500 line-through">Rp 700.000</div>
                        <div class="text-green-600 font-semibold">Hemat Rp 150.000</div>
                    </div>
                    <div class="space-y-3 mb-8">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-700">Facial Whitening</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-700">Hair Treatment</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-700">Make Up Natural</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-700">Nail Art Simple</span>
                        </div>
                    </div>
                    <x-ui.button href="{{ route('booking') }}" variant="primary" class="w-full">
                        Pilih Paket
                    </x-ui.button>
                </x-ui.card>

                <!-- Package 3 -->
                <x-ui.card padding="lg" class="border-2 border-transparent hover:border-pink-200">
                    <div class="text-center mb-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Paket Luxury</h3>
                        <div class="text-3xl font-bold text-pink-600 mb-2">Rp 850.000</div>
                        <div class="text-gray-500 line-through">Rp 1.100.000</div>
                        <div class="text-green-600 font-semibold">Hemat Rp 250.000</div>
                    </div>
                    <div class="space-y-3 mb-8">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-700">Facial Anti-Aging</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-700">Hair Coloring</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-700">Make Up Party</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-700">Nail Art Premium</span>
                        </div>
                    </div>
                    <x-ui.button href="{{ route('booking') }}" variant="primary" class="w-full">
                        Pilih Paket
                    </x-ui.button>
                </x-ui.card>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-pink-500 to-purple-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                Siap Merasakan Layanan Terbaik?
            </h2>
            <p class="text-xl mb-8 max-w-3xl mx-auto">
                Booking sekarang dan nikmati pengalaman kecantikan yang tak terlupakan
            </p>
            <x-ui.button href="{{ route('booking') }}" variant="white" size="lg">
                Pesan Sekarang
            </x-ui.button>
             <x-ui.button href="tel:+6221234567" variant="secondary" size="lg">
                    Hubungi Kami
            </x-ui.button>
        </div>
    </section>
</x-layout.base>