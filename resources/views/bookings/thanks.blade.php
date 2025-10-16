<x-layout.base title="Booking Berhasil">
    <section class="bg-white py-24">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="mb-10 inline-flex h-16 w-16 items-center justify-center rounded-full bg-green-100 text-green-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Terima kasih!</h1>
            <p class="text-gray-600 mb-8">Permintaan booking Anda telah kami terima. Tim kami akan menghubungi Anda untuk konfirmasi jadwal. Anda dapat kembali melihat layanan lain yang tersedia di Salon Shakila.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('services.index') }}" class="inline-flex items-center justify-center rounded-full bg-pink-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-pink-200 transition hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">Kembali ke Daftar Layanan</a>
                <a href="{{ route('services.show', ['slug' => $service->slug]) }}" class="inline-flex items-center justify-center rounded-full bg-gray-100 px-6 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-200">Lihat Detail Layanan</a>
            </div>
        </div>
    </section>
</x-layout.base>
