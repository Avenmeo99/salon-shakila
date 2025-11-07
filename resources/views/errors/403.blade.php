<x-layout.base :title="'Akses Ditolak'">
  <section class="max-w-xl mx-auto px-4 py-16 text-center">
    <h1 class="text-3xl font-bold mb-3">403 — Akses Ditolak</h1>
    <p class="text-gray-600">Hanya admin yang dapat mengakses halaman ini.</p>
    <a href="{{ route('home') }}" class="mt-6 inline-flex px-4 py-2 bg-pink-600 text-white rounded-lg">Kembali ke Beranda</a>
  </section>
</x-layout.base>
