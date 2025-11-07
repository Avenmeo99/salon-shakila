<x-layout.base :title="'Daftar Order'">
  <div class="max-w-7xl mx-auto px-4 py-10">
    <h1 class="text-2xl font-bold mb-6">Orders</h1>

    <div class="overflow-x-auto bg-white rounded-xl border">
      <table class="min-w-full text-sm">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-4 py-3 text-left">Kode</th>
            <th class="px-4 py-3 text-left">Customer</th>
            <th class="px-4 py-3 text-left">Total</th>
            <th class="px-4 py-3 text-left">Status</th>
            <th class="px-4 py-3 text-left">Tanggal</th>
            <th class="px-4 py-3"></th>
          </tr>
        </thead>
        <tbody>
        @forelse($orders as $o)
          <tr class="border-t">
            <td class="px-4 py-3">{{ $o->code ?? $o->id }}</td>
            <td class="px-4 py-3">{{ $o->user->name ?? '-' }}</td>
            <td class="px-4 py-3">Rp {{ number_format($o->total_amount ?? 0,0,',','.') }}</td>
            <td class="px-4 py-3">{{ $o->status }}</td>
            <td class="px-4 py-3">{{ $o->created_at }}</td>
            <td class="px-4 py-3 text-right">
              <a href="{{ route('admin.orders.show',$o->id) }}" class="px-3 py-1 rounded border hover:bg-gray-50">Detail</a>
            </td>
          </tr>
        @empty
          <tr><td colspan="6" class="px-4 py-6 text-center text-gray-500">Belum ada data.</td></tr>
        @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-4">
      {{ $orders->links() }}
    </div>
  </div>
</x-layout.base>
