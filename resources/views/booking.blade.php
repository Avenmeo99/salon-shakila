{{-- resources/views/services/booking.blade.php --}}
<x-layout.base :title="'Booking ' . ($service->name ?? 'Layanan')">
  <section class="max-w-3xl mx-auto px-4 py-10">
    <a href="{{ route('services.show', $service->slug) }}" class="text-sm text-gray-500 hover:text-gray-700">← Kembali</a>

    <h1 class="mt-3 text-2xl sm:text-3xl font-bold">Booking {{ $service->name }}</h1>
    <p class="text-gray-600 mt-1">Pilih jadwal, kami hubungi untuk konfirmasi.</p>

    <form method="POST" action="{{ route('bookings.store', $service->slug) }}" class="bg-white rounded-2xl border p-6 mt-6 space-y-4">
      @csrf
      <div class="grid sm:grid-cols-2 gap-4">
        <div>
          <label class="text-sm font-medium">Nama Lengkap</label>
          <input name="customer_name" class="mt-1 w-full rounded-lg border px-3 py-2" />
        </div>
        <div>
          <label class="text-sm font-medium">WhatsApp</label>
          <input name="whatsapp" class="mt-1 w-full rounded-lg border px-3 py-2" />
        </div>
      </div>

      <div class="grid sm:grid-cols-2 gap-4">
        <div>
          <label class="text-sm font-medium">Tanggal</label>
          <input type="date" name="date" value="{{ now()->toDateString() }}" required class="mt-1 w-full rounded-lg border px-3 py-2" />
        </div>
        <div>
          <label class="text-sm font-medium">Jam</label>
          <select name="time" required class="mt-1 w-full rounded-lg border px-3 py-2">
            <option value="" hidden>Pilih jam</option>
            @foreach($timeblocks as $tb)
              <option value="{{ $tb }}">{{ $tb }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div>
        <label class="text-sm font-medium">Catatan</label>
        <textarea name="note" rows="3" class="mt-1 w-full rounded-lg border px-3 py-2" placeholder="Opsional"></textarea>
      </div>

      <div class="flex items-center gap-2 text-sm text-gray-700">
        <input type="checkbox" checked disabled class="rounded border-gray-300">
        <span>Bayar melalui checkout (DP 50%).</span>
      </div>

      <div class="flex items-center gap-3 pt-2">
        <button class="px-5 py-2 rounded-xl bg-pink-600 text-white font-semibold hover:bg-pink-700">Kirim Booking</button>
        <a href="{{ route('services.index') }}" class="px-4 py-2 rounded-xl border hover:bg-gray-50">Batal</a>
      </div>
    </form>
  </section>
</x-layout.base>
