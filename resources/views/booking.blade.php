<x-layout.base :title="'Booking Layanan Salon Shakila'" :description="'Reservasi layanan kecantikan favorit Anda dengan mudah melalui sistem booking online Salon Shakila.'">
    <x-sections.hero
        eyebrow="Booking Online"
        title="Atur Jadwal <span class='text-pink-600'>Perawatan</span> Anda"
        subtitle="Pilih layanan, tentukan terapis, dan booking jadwal yang sesuai tanpa perlu antre"
        description="Kami menyediakan sistem reservasi cepat dengan konfirmasi instan. Pilih layanan favorit, jadwalkan sesuai kenyamanan Anda, dan tim kami siap menyambut di salon."
        :stats="[
            ['label' => 'Waktu Operasional', 'value' => '09.00 - 20.00'],
            ['label' => 'Slot Tersedia Hari Ini', 'value' => '18'],
            ['label' => 'Terapis Profesional', 'value' => '12'],
        ]"
    >
        <x-slot name="primaryButton">
            <x-ui.button href="#form-booking" variant="primary" size="lg">Mulai Booking</x-ui.button>
        </x-slot>
        <x-slot name="secondaryButton">
            <x-ui.button href="tel:+62211234567" variant="secondary" size="lg">Butuh Bantuan? Hubungi Kami</x-ui.button>
        </x-slot>
    </x-sections.hero>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">Langkah Booking yang Mudah</h2>
                    <p class="mt-4 text-lg text-gray-600">Dalam beberapa langkah sederhana, Anda sudah bisa mendapatkan slot perawatan favorit di Salon Shakila.</p>
                    <div class="mt-8 space-y-6">
                        <div class="flex">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-pink-100 text-pink-600 font-bold mr-4">1</div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900">Pilih Layanan</h3>
                                <p class="mt-1 text-gray-600">Facial, hair styling, make up, nail art, dan banyak layanan lainnya siap Anda pesan.</p>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-pink-100 text-pink-600 font-bold mr-4">2</div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900">Tentukan Jadwal</h3>
                                <p class="mt-1 text-gray-600">Pilih tanggal dan jam sesuai kebutuhan Anda. Sistem kami menampilkan slot real-time.</p>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-pink-100 text-pink-600 font-bold mr-4">3</div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900">Konfirmasi & Nikmati Layanan</h3>
                                <p class="mt-1 text-gray-600">Setelah konfirmasi via email atau WhatsApp, datang tepat waktu dan nikmati pelayanan terbaik kami.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="form-booking" class="bg-gray-50 rounded-2xl shadow-xl p-8">
                    <h3 class="text-xl font-semibold text-gray-900">Form Booking Online</h3>
                    <p class="mt-2 text-sm text-gray-500">Tim kami akan menghubungi Anda untuk konfirmasi dalam 15 menit.</p>
                    <form class="mt-6 space-y-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" class="mt-1 w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500" placeholder="Masukkan nama Anda">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                                <input type="tel" class="mt-1 w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500" placeholder="08xxxxxxxxxx">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" class="mt-1 w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500" placeholder="nama@email.com">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Pilih Layanan</label>
                            <select class="mt-1 w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500">
                                <option>Facial Glow Treatment</option>
                                <option>Hair Styling & Coloring</option>
                                <option>Make Up Professional</option>
                                <option>Nail Art & Manicure</option>
                                <option>Body Spa & Relaxation</option>
                            </select>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                                <input type="date" class="mt-1 w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Waktu</label>
                                <input type="time" class="mt-1 w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Catatan Tambahan</label>
                            <textarea rows="3" class="mt-1 w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500" placeholder="Tuliskan preferensi atau permintaan khusus"></textarea>
                        </div>
                        <x-ui.button type="submit" variant="primary" class="w-full justify-center">Kirim Permintaan Booking</x-ui.button>
                        <p class="text-xs text-gray-500 text-center">Dengan mengirim form ini, Anda menyetujui kebijakan privasi Salon Shakila.</p>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <x-ui.card variant="gradient" class="h-full">
                    <h3 class="text-xl font-semibold text-gray-900">Konfirmasi Instan</h3>
                    <p class="mt-3 text-gray-600">Setelah mengirim form, kami mengirimkan konfirmasi melalui WhatsApp dan email dalam hitungan menit.</p>
                </x-ui.card>
                <x-ui.card variant="gradient" class="h-full">
                    <h3 class="text-xl font-semibold text-gray-900">Pengingat Otomatis</h3>
                    <p class="mt-3 text-gray-600">Terima pengingat H-1 dan H-2 jam sebelum jadwal agar Anda tidak melewatkan sesi perawatan.</p>
                </x-ui.card>
                <x-ui.card variant="gradient" class="h-full">
                    <h3 class="text-xl font-semibold text-gray-900">Pembayaran Fleksibel</h3>
                    <p class="mt-3 text-gray-600">Pilih pembayaran di salon, transfer bank, atau e-wallet favorit Anda saat konfirmasi.</p>
                </x-ui.card>
            </div>
        </div>
    </section>
</x-layout.base>
