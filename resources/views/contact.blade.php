<x-layout.base :title="'Kontak Salon Shakila'" :description="'Hubungi Salon Shakila untuk pertanyaan, konsultasi, dan kerja sama.'">
    <x-sections.hero
        eyebrow="Hubungi Kami"
        title="Kami Siap Membantu <span class='text-pink-600'>Setiap Saat</span>"
        subtitle="Tim customer care kami siap menjawab pertanyaan dan membantu Anda memilih layanan terbaik"
        description="Hubungi kami melalui telepon, email, atau datang langsung ke salon. Anda juga dapat mengisi form konsultasi dan kami akan menghubungi kembali dalam waktu singkat."
        :stats="[
            ['label' => 'Jam Operasional', 'value' => '09.00 - 20.00'],
            ['label' => 'Waktu Respon', 'value' => '< 15 Menit'],
            ['label' => 'Konsultan Aktif', 'value' => '6 Orang'],
        ]"
    >
        <x-slot name="primaryButton">
            <x-ui.button href="#form-kontak" variant="primary" size="lg">Kirim Pesan</x-ui.button>
        </x-slot>
        <x-slot name="secondaryButton">
            <x-ui.button href="tel:+62211234567" variant="secondary" size="lg">Telepon Sekarang</x-ui.button>
        </x-slot>
    </x-sections.hero>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <div class="lg:col-span-1 bg-gradient-to-br from-pink-600 to-purple-600 text-white rounded-3xl shadow-xl p-8">
                    <h3 class="text-2xl font-semibold">Detail Kontak</h3>
                    <p class="mt-3 text-pink-100">Silakan hubungi kami melalui kanal berikut:</p>
                    <div class="mt-6 space-y-6">
                        <div>
                            <h4 class="text-sm font-semibold uppercase tracking-wide text-pink-200">Salon</h4>
                            <p class="mt-2 text-lg">Jl. Anggrek BTN, Ende, Nusa Tenggara Timur</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold uppercase tracking-wide text-pink-200">Telepon</h4>
                            <p class="mt-2 text-lg">(021) 123-4567</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold uppercase tracking-wide text-pink-200">Email</h4>
                            <p class="mt-2 text-lg">info@salonshakila.com</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold uppercase tracking-wide text-pink-200">Media Sosial</h4>
                            <p class="mt-2">@salonshakila (Instagram, TikTok, Facebook)</p>
                        </div>
                    </div>
                    <div class="mt-8 border-t border-white/20 pt-6">
                        <h4 class="text-sm font-semibold uppercase tracking-wide text-pink-200">Jam Operasional</h4>
                        <p class="mt-2 text-lg">Senin - Minggu</p>
                        <p class="text-pink-100">09.00 - 20.00 WITA</p>
                    </div>
                </div>

                <div id="form-kontak" class="lg:col-span-2 bg-gray-50 rounded-3xl shadow-xl p-10">
                    <h3 class="text-2xl font-semibold text-gray-900">Form Konsultasi & Pertanyaan</h3>
                    <p class="mt-2 text-gray-600">Lengkapi form di bawah ini dan tim kami akan menghubungi Anda kembali melalui email atau WhatsApp.</p>
                    <form class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-1">
                            <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" class="mt-1 w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500" placeholder="Masukkan nama Anda">
                        </div>
                        <div class="md:col-span-1">
                            <label class="block text-sm font-medium text-gray-700">Nomor WhatsApp</label>
                            <input type="tel" class="mt-1 w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500" placeholder="08xxxxxxxxxx">
                        </div>
                        <div class="md:col-span-1">
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" class="mt-1 w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500" placeholder="nama@email.com">
                        </div>
                        <div class="md:col-span-1">
                            <label class="block text-sm font-medium text-gray-700">Topik</label>
                            <select class="mt-1 w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500">
                                <option>Pertanyaan Layanan</option>
                                <option>Kerja Sama</option>
                                <option>Keluhan & Masukan</option>
                                <option>Reservasi Event</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Pesan</label>
                            <textarea rows="4" class="mt-1 w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500" placeholder="Tulis pertanyaan atau kebutuhan Anda"></textarea>
                        </div>
                        <div class="md:col-span-2 flex items-start">
                            <input id="privacy" type="checkbox" class="h-4 w-4 text-pink-600 border-gray-300 rounded">
                            <label for="privacy" class="ml-3 text-sm text-gray-600">Saya menyetujui kebijakan privasi dan menerima kontak lanjutan dari Salon Shakila.</label>
                        </div>
                        <div class="md:col-span-2">
                            <x-ui.button type="submit" variant="primary" class="w-full md:w-auto">Kirim Pesan</x-ui.button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div class="bg-white rounded-3xl shadow-lg p-8">
                    <h3 class="text-xl font-semibold text-gray-900">Lokasi Kami</h3>
                    <p class="mt-3 text-gray-600">Terletak di pusat kota Ende dengan akses mudah dan area parkir luas. Kami juga menyediakan layanan penjemputan khusus untuk acara besar.</p>
                    <div class="mt-6 h-56 bg-gradient-to-br from-pink-200 to-purple-200 rounded-2xl flex items-center justify-center text-pink-700 font-semibold">
                        Peta Interaktif Segera Hadir
                    </div>
                </div>
                <div class="bg-white rounded-3xl shadow-lg p-8">
                    <h3 class="text-xl font-semibold text-gray-900">Butuh Respon Cepat?</h3>
                    <p class="mt-3 text-gray-600">Gunakan kanal berikut untuk respons tercepat dari tim kami.</p>
                    <ul class="mt-6 space-y-4 text-gray-600">
                        <li class="flex items-center">
                            <span class="w-3 h-3 rounded-full bg-green-500 mr-3"></span>
                            WhatsApp Customer Care (08xx-xxxx-xxxx)
                        </li>
                        <li class="flex items-center">
                            <span class="w-3 h-3 rounded-full bg-green-500 mr-3"></span>
                            Hotline Salon (021) 123-4567
                        </li>
                        <li class="flex items-center">
                            <span class="w-3 h-3 rounded-full bg-green-500 mr-3"></span>
                            Instagram DM @salonshakila
                        </li>
                    </ul>
                    <div class="mt-8">
                        <x-ui.button href="https://wa.me/628123456789" variant="secondary" target="_blank">Chat via WhatsApp</x-ui.button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout.base>
