<x-layout.base :title="'Pembayaran Berhasil — Shakila Salon'">
  <section class="max-w-3xl mx-auto px-4 py-14 text-center">
    <div class="mx-auto w-16 h-16 rounded-full bg-emerald-100 flex items-center justify-center">
      <span class="text-2xl">✅</span>
    </div>
    <h1 class="mt-4 text-2xl font-bold text-gray-900">Terima kasih! Pembayaran kamu sedang diproses.</h1>
    <p class="mt-2 text-gray-600">
      Kami telah menerima konfirmasi dari Midtrans. Status final akan dipastikan melalui sistem kami (webhook).
      @if(request('order_id'))
        <br/>Nomor Pesanan: <span class="font-semibold">{{ request('order_id') }}</span>
      @endif
    </p>

    <div class="mt-8 space-y-3">
      <a href="{{ route('bookings.thanks') }}"
         class="inline-flex items-center px-6 py-3 rounded-xl bg-pink-600 text-white font-semibold hover:bg-pink-700">
        Lihat Halaman Terima Kasih
      </a>
      <div>
        <a href="{{ route('services.index') }}" class="text-gray-700 hover:underline">
          Kembali ke Layanan
        </a>
      </div>
    </div>

    <p class="mt-8 text-xs text-gray-500">
      Catatan: Halaman ini hanya informasi untuk kamu. Status pembayaran resmi ditentukan oleh notifikasi server
      (webhook) dari Midtrans demi keamanan.
    </p>
  </section>
</x-layout.base>
