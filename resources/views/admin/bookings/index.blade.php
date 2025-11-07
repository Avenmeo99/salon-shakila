<x-layout.base :title="'Daftar Booking'">
  <div class="max-w-7xl mx-auto px-4 py-10">
    <h1 class="text-2xl font-bold mb-6">Booking</h1>

    @if(session('success'))
      <div class="mb-4 rounded-lg bg-green-50 text-green-700 px-4 py-3">
        {{ session('success') }}
      </div>
    @endif

    <div class="overflow-x-auto bg-white rounded-xl border">
      <table class="min-w-full text-sm">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-4 py-3 text-left">Tanggal</th>
            <th class="px-4 py-3 text-left">Jam</th>
            <th class="px-4 py-3 text-left">Service</th>
            <th class="px-4 py-3 text-left">Customer</th>
            <th class="px-4 py-3 text-left">Status</th>
            <th class="px-4 py-3 text-left">Pembayaran</th>
            <th class="px-4 py-3"></th>
          </tr>
        </thead>
        <tbody>
        @forelse($bookings as $b)
          <tr class="border-t">
            <td class="px-4 py-3">{{ $b->booking_date }}</td>
            <td class="px-4 py-3">{{ $b->booking_time }}</td>
            <td class="px-4 py-3">{{ $b->service->name ?? '-' }}</td>
            <td class="px-4 py-3">{{ $b->user->name ?? '-' }}</td>
            <td class="px-4 py-3">{{ $b->status }}</td>
            <td class="px-4 py-3">{{ $b->payment_status }}</td>
            <td class="px-4 py-3 text-right">
              <a href="{{ route('admin.bookings.show', $b->id) }}" class="px-3 py-1 rounded border hover:bg-gray-50">Detail</a>
            </td>
          </tr>
        @empty
          <tr><td colspan="7" class="px-4 py-6 text-center text-gray-500">Belum ada data.</td></tr>
        @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-4">
      {{ $bookings->links() }}
    </div>
  </div>
</x-layout.base>
