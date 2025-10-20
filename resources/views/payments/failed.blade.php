<x-layout.base :title="'Pembayaran Gagal — Shakila Salon'">
  <section class="max-w-3xl mx-auto px-4 py-14 text-center">
    <div class="mx-auto w-16 h-16 rounded-full bg-rose-100 flex items-center justify-center">
      <span class="text-2xl">⚠️</span>
    </div>
    <h1 class="mt-4 text-2xl font-bold text-gray-900">Pembayaran belum berhasil.</h1>
    <p class="mt-2 text-gray-600">
      Silakan coba lagi, atau gunakan metode pembayaran lain.
      @if(request('order_id'))
        <br/>Nomor Pesanan: <span class="font-semibold">{{ request('order_id') }}</span>
      @endif
    </p>

    <div class="mt-8 space-y-3">
      <a href="{{ route('checkout.index') }}"
         class="inline-flex items-center px-6 py-3 rounded-xl border border-gray-300 text-gray-800 hover:bg-gray-50">
        Kembali ke Checkout
      </a>
      <div>
        <a href="{{ route('services.index') }}" class="text-gray-700 hover:underline">
          Lihat Layanan
        </a>
      </div>
    </div>

    <p class="mt-8 text-xs text-gray-500">
      Bila dana terdebet namun status belum berubah, sistem kami akan menyelaraskan status otomatis dari webhook Midtrans.
    </p>
  </section>
</x-layout.base>
