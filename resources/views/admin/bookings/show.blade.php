<x-layout.base :title="'Detail Booking'">
  <div class="max-w-3xl mx-auto px-4 py-10">
    <h1 class="text-2xl font-bold mb-6">Detail Booking #{{ $booking->id }}</h1>

    <div class="space-y-2 text-sm">
      <div><b>Service:</b> {{ $booking->service->name ?? '-' }}</div>
      <div><b>Tanggal:</b> {{ $booking->booking_date }} | <b>Jam:</b> {{ $booking->booking_time }}</div>
      <div><b>Customer:</b> {{ $booking->user->name ?? '-' }}</div>
      <div><b>Status:</b> {{ $booking->status }}</div>
      <div><b>Pembayaran:</b> {{ $booking->payment_status }}</div>
      <div><b>Catatan:</b> {{ $booking->notes }}</div>
    </div>

    <form action="{{ route('admin.bookings.updateStatus',$booking->id) }}" method="POST" class="mt-6 grid sm:grid-cols-2 gap-4">
      @csrf @method('PATCH')
      <div>
        <label class="block text-sm font-medium mb-1">Status Booking</label>
        <select name="status" class="w-full border rounded-lg px-3 py-2">
          @foreach(['pending','confirmed','completed','cancelled'] as $s)
            <option value="{{ $s }}" @selected($booking->status===$s)>{{ $s }}</option>
          @endforeach
        </select>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Status Pembayaran</label>
        <select name="payment_status" class="w-full border rounded-lg px-3 py-2">
          @foreach(['unpaid','paid','refunded'] as $ps)
            <option value="{{ $ps }}" @selected($booking->payment_status===$ps)>{{ $ps }}</option>
          @endforeach
        </select>
      </div>

      <div class="sm:col-span-2">
        <button class="px-4 py-2 rounded-lg bg-pink-600 text-white hover:bg-pink-700">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</x-layout.base>
