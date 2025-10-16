{{-- resources/views/bookings/thanks.blade.php --}}
<x-layout.base :title="'Booking Berhasil - Shakila Salon'">

    <section class="bg-white py-24">
        <div class="max-w-2xl mx-auto text-center px-6">
            
            {{-- Icon sukses --}}
            <div class="flex justify-center mb-6">
                <div class="w-20 h-20 rounded-full bg-gradient-to-r from-pink-500 to-purple-600 flex items-center justify-center shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-10 w-10 text-white"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>

            {{-- Judul --}}
            <h1 class="text-3xl font-extrabold text-gray-900 mb-3">
                Booking Berhasil!
            </h1>

            {{-- Subteks --}}
            <p class="text-gray-600 mb-8">
                Terima kasih telah melakukan pemesanan di <span class="font-semibold text-pink-600">Shakila Salon</span>.<br>
                Tim kami akan segera menghubungi Anda melalui WhatsApp untuk konfirmasi jadwal.
            </p>

            {{-- Informasi tambahan --}}
            @if(session('booking_code'))
                <div class="bg-pink-50 border border-pink-200 text-pink-700 rounded-2xl px-6 py-4 mb-8 inline-block">
                    <p class="font-semibold text-sm">Kode Booking Anda:</p>
                    <p class="text-lg font-bold">{{ session('booking_code') }}</p>
                </div>
            @endif

            {{-- Tombol aksi --}}
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('services.index') }}"
                   class="inline-flex items-center justify-center px-6 py-3 rounded-full bg-gradient-to-r from-pink-500 to-purple-600 text-white font-semibold shadow-md hover:opacity-90 transition">
                    Lihat Layanan Lain
                </a>

                <a href="{{ route('cart.index') }}"
                   class="inline-flex items-center justify-center px-6 py-3 rounded-full bg-gray-100 text-gray-700 font-semibold hover:bg-gray-200 transition">
                    Pergi ke Keranjang
                </a>
            </div>

        </div>
    </section>

</x-layout.base>
