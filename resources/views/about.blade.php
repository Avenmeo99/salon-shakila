<x-layout.base :title="'Tentang Salon Shakila'" :description="'Kenali perjalanan, visi, dan tim profesional di balik Salon Shakila.'">
    <x-sections.hero
        eyebrow="Tentang Kami"
        title="Cerita di Balik <span class='text-pink-600'>Salon Shakila</span>"
        subtitle="Kami hadir untuk menghadirkan pengalaman kecantikan yang hangat, profesional, dan penuh perhatian"
        description="Sejak berdiri tahun 2014, Salon Shakila terus berkembang menjadi destinasi kecantikan terpercaya dengan layanan lengkap dan tenaga ahli bersertifikat."
        :stats="[
            ['label' => 'Tahun Berdiri', 'value' => '2014'],
            ['label' => 'Cabang Aktif', 'value' => '3 Kota'],
            ['label' => 'Terapis Bersertifikat', 'value' => '25'],
        ]"
    >
        <x-slot name="primaryButton">
            <x-ui.button href="{{ route('services') }}" variant="primary" size="lg">Jelajahi Layanan</x-ui.button>
        </x-slot>
        <x-slot name="secondaryButton">
            <x-ui.button href="{{ route('booking') }}" variant="secondary" size="lg">Booking Konsultasi</x-ui.button>
        </x-slot>
    </x-sections.hero>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">Visi & Misi Kami</h2>
                    <p class="mt-4 text-lg text-gray-600">Kami percaya setiap orang berhak mendapatkan perawatan personal yang memancarkan kecantikan alami. Karena itu, kami fokus menghadirkan layanan yang ramah, profesional, dan berkelanjutan.</p>
                    <ul class="mt-6 space-y-4 text-gray-600">
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-pink-500 mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Memberikan layanan kecantikan kelas premium dengan harga terjangkau
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-pink-500 mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Menggunakan produk ramah lingkungan dan aman bagi kulit sensitif
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-pink-500 mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Mengembangkan SDM kecantikan lokal melalui pelatihan berkelanjutan
                        </li>
                    </ul>
                </div>
                <div class="bg-gray-50 rounded-3xl shadow-xl p-8">
                    <h3 class="text-2xl font-semibold text-gray-900">Perjalanan Kami</h3>
                    <p class="mt-3 text-gray-600">Dari salon rumahan hingga menjadi brand kecantikan tepercaya di Nusa Tenggara Timur.</p>
                    <ol class="mt-6 space-y-6 text-gray-600">
                        <li>
                            <div class="flex items-start">
                                <span class="flex-shrink-0 w-10 h-10 rounded-full bg-pink-500 text-white flex items-center justify-center font-semibold mr-4">2014</span>
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900">Mulai dari Studio Kecil</h4>
                                    <p>Salon Shakila pertama kali melayani pelanggan di ruang studio keluarga dengan fokus pada perawatan wajah.</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-start">
                                <span class="flex-shrink-0 w-10 h-10 rounded-full bg-pink-500 text-white flex items-center justify-center font-semibold mr-4">2018</span>
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900">Ekspansi Layanan</h4>
                                    <p>Menambah layanan hair styling, make up, dan nail art serta membuka cabang kedua di Kota Ende.</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-start">
                                <span class="flex-shrink-0 w-10 h-10 rounded-full bg-pink-500 text-white flex items-center justify-center font-semibold mr-4">2022</span>
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900">Digitalisasi & Booking Online</h4>
                                    <p>Merilis platform booking online dan program membership untuk meningkatkan kenyamanan pelanggan.</p>
                                </div>
                            </div>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Tim Profesional Kami</h2>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto">Kami bangga dengan tim terapis dan stylist yang berdedikasi untuk memberikan pengalaman terbaik bagi setiap pelanggan.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <x-ui.card class="text-center">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-pink-400 to-purple-400 mx-auto mb-4 flex items-center justify-center text-white text-2xl font-semibold">AR</div>
                    <h3 class="text-xl font-semibold text-gray-900">Anita Rahayu</h3>
                    <p class="text-pink-600 font-medium">Lead Therapist</p>
                    <p class="mt-3 text-gray-600 text-sm">Spesialis facial dan perawatan anti-aging dengan pengalaman 8 tahun.</p>
                </x-ui.card>
                <x-ui.card class="text-center">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-pink-400 to-purple-400 mx-auto mb-4 flex items-center justify-center text-white text-2xl font-semibold">DN</div>
                    <h3 class="text-xl font-semibold text-gray-900">Dimas Nugraha</h3>
                    <p class="text-pink-600 font-medium">Senior Hair Stylist</p>
                    <p class="mt-3 text-gray-600 text-sm">Ahli hair styling & coloring dengan sertifikasi internasional.</p>
                </x-ui.card>
                <x-ui.card class="text-center">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-pink-400 to-purple-400 mx-auto mb-4 flex items-center justify-center text-white text-2xl font-semibold">LS</div>
                    <h3 class="text-xl font-semibold text-gray-900">Laras Setiani</h3>
                    <p class="text-pink-600 font-medium">Make Up Director</p>
                    <p class="mt-3 text-gray-600 text-sm">Berpengalaman menangani rias pengantin dan event fashion nasional.</p>
                </x-ui.card>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <x-ui.card variant="gradient">
                    <h3 class="text-xl font-semibold text-gray-900">Komitmen Kebersihan</h3>
                    <p class="mt-3 text-gray-600">Kami menerapkan standar sanitasi yang ketat dengan sterilisasi alat dan ruang perawatan setiap sesi.</p>
                </x-ui.card>
                <x-ui.card variant="gradient">
                    <h3 class="text-xl font-semibold text-gray-900">Produk Teruji</h3>
                    <p class="mt-3 text-gray-600">Hanya menggunakan produk pilihan yang bersertifikat BPOM dan aman untuk ibu hamil.</p>
                </x-ui.card>
                <x-ui.card variant="gradient">
                    <h3 class="text-xl font-semibold text-gray-900">Pengalaman Personal</h3>
                    <p class="mt-3 text-gray-600">Setiap pelanggan mendapat konsultasi personal untuk memastikan layanan sesuai kebutuhan.</p>
                </x-ui.card>
            </div>
        </div>
    </section>
</x-layout.base>
