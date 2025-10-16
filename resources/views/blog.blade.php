<x-layout.base :title="'Blog Salon Shakila'" :description="'Kumpulan artikel tips kecantikan, tren terbaru, dan kisah inspiratif dari Salon Shakila.'">
    <x-sections.hero
        eyebrow="Blog & Artikel"
        title="Temukan <span class='text-pink-600'>Inspirasi Kecantikan</span> Terbaru"
        subtitle="Kembangkan pengetahuan Anda tentang kecantikan, perawatan tubuh, dan gaya hidup sehat bersama para ahli kami"
        description="Kami merangkum berbagai tips perawatan, tren make up, hingga cerita transformasi pelanggan untuk menginspirasi Anda tampil percaya diri setiap hari."
        :stats="[
            ['label' => 'Artikel Dipublikasikan', 'value' => '48'],
            ['label' => 'Pembaca Bulanan', 'value' => '12K+'],
            ['label' => 'Kontributor Ahli', 'value' => '5'],
        ]"
    >
        <x-slot name="primaryButton">
            <x-ui.button href="#artikel-terbaru" variant="primary" size="lg">Baca Artikel Terbaru</x-ui.button>
        </x-slot>
        <x-slot name="secondaryButton">
            <x-ui.button href="{{ route('contact') }}" variant="secondary" size="lg">Kirim Pertanyaan</x-ui.button>
        </x-slot>
    </x-sections.hero>

    @php
        $articles = [
            [
                'title' => 'Rahasia Kulit Glowing dengan Perawatan Profesional',
                'excerpt' => 'Pelajari tahapan facial favorit pelanggan kami yang mampu membuat kulit lebih cerah dalam sekali perawatan.',
                'category' => 'Perawatan Wajah',
                'date' => '12 Januari 2025',
                'read_time' => '6 menit'
            ],
            [
                'title' => 'Tren Warna Rambut 2025 yang Wajib Kamu Coba',
                'excerpt' => 'Stylist kami merangkum kombinasi warna rambut terkini lengkap dengan tips perawatan agar warnanya tahan lama.',
                'category' => 'Styling Rambut',
                'date' => '5 Januari 2025',
                'read_time' => '4 menit'
            ],
            [
                'title' => 'Panduan Make Up Flawless untuk Acara Spesial',
                'excerpt' => 'Mulai dari skincare prep hingga finishing spray, simak rekomendasi produk dan teknik make up dari tim profesional kami.',
                'category' => 'Make Up',
                'date' => '28 Desember 2024',
                'read_time' => '8 menit'
            ],
            [
                'title' => 'Mengapa Manicure & Pedicure Penting untuk Kesehatan?',
                'excerpt' => 'Tak hanya mempercantik kuku, manicure & pedicure juga membantu menjaga kebersihan dan kesehatan kulit Anda.',
                'category' => 'Perawatan Kuku',
                'date' => '19 Desember 2024',
                'read_time' => '5 menit'
            ],
        ];
    @endphp

    <section id="artikel-terbaru" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="mb-12 text-center">
                <span class="inline-block px-3 py-1 text-sm font-semibold text-pink-600 bg-pink-100 rounded-full">Artikel Terbaru</span>
                <h2 class="mt-4 text-3xl md:text-4xl font-bold text-gray-900">Cerita dan Tips dari Tim Shakila</h2>
                <p class="mt-3 text-lg text-gray-600 max-w-3xl mx-auto">Pilih topik favorit Anda dan temukan berbagai insight untuk menjaga kecantikan dan kesehatan kulit.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($articles as $article)
                    <x-ui.card class="h-full flex flex-col">
                        <div class="flex items-center text-sm text-pink-600 font-medium">
                            <span class="px-3 py-1 bg-pink-100 rounded-full">{{ $article['category'] }}</span>
                            <span class="ml-3 text-gray-400">{{ $article['date'] }}</span>
                        </div>
                        <h3 class="mt-5 text-2xl font-semibold text-gray-900 leading-snug">{{ $article['title'] }}</h3>
                        <p class="mt-3 text-gray-600">{{ $article['excerpt'] }}</p>
                        <div class="mt-6 flex items-center justify-between text-sm text-gray-500">
                            <span>{{ $article['read_time'] }} membaca</span>
                            <a href="#" class="text-pink-600 font-semibold hover:underline">Baca Selengkapnya</a>
                        </div>
                    </x-ui.card>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">Dapatkan Update Artikel Terbaru</h2>
                    <p class="mt-4 text-lg text-gray-600">Berlangganan newsletter kami dan dapatkan rekomendasi artikel, promo layanan, serta tips eksklusif langsung ke email Anda.</p>
                    <ul class="mt-6 space-y-4 text-gray-600">
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-6 h-6 rounded-full bg-pink-500 text-white flex items-center justify-center text-sm font-semibold mr-3">1</span>
                            Artikel pilihan kurasi tim profesional kami setiap minggu
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-6 h-6 rounded-full bg-pink-500 text-white flex items-center justify-center text-sm font-semibold mr-3">2</span>
                            Akses undangan event beauty class eksklusif
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-6 h-6 rounded-full bg-pink-500 text-white flex items-center justify-center text-sm font-semibold mr-3">3</span>
                            Promo spesial layanan favorit pelanggan
                        </li>
                    </ul>
                </div>
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <h3 class="text-xl font-semibold text-gray-900">Daftar Newsletter</h3>
                    <form class="mt-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" class="mt-1 w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500" placeholder="Masukkan nama Anda">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Alamat Email</label>
                            <input type="email" class="mt-1 w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500" placeholder="nama@email.com">
                        </div>
                        <div class="flex items-start">
                            <input id="agreement" type="checkbox" class="h-4 w-4 text-pink-600 border-gray-300 rounded">
                            <label for="agreement" class="ml-3 text-sm text-gray-600">Saya setuju menerima email promosi dari Salon Shakila.</label>
                        </div>
                        <x-ui.button type="submit" variant="primary" class="w-full justify-center">Daftar Sekarang</x-ui.button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layout.base>
