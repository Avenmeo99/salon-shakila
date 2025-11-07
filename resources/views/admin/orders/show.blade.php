<x-layout.base :title="'Detail Order'">
  <div class="max-w-4xl mx-auto px-4 py-10">
    <h1 class="text-2xl font-bold mb-6">Detail Order #{{ $order->id }}</h1>

    <div class="space-y-1 text-sm">
      <div><b>Customer:</b> {{ $order->user->name ?? '-' }}</div>
      <div><b>Total:</b> Rp {{ number_format($order->total_amount ?? 0,0,',','.') }}</div>
      <div><b>Status:</b> {{ $order->status }}</div>
      <div><b>Tanggal:</b> {{ $order->created_at }}</div>
    </div>

    <div class="mt-6 rounded-xl border overflow-hidden">
      <table class="min-w-full text-sm">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-4 py-2 text-left">Service</th>
            <th class="px-4 py-2 text-left">Qty</th>
            <th class="px-4 py-2 text-left">Harga</th>
          </tr>
        </thead>
        <tbody>
          @foreach(($order->items ?? []) as $it)
            <tr class="border-t">
              <td class="px-4 py-2">{{ $it->service->name ?? '-' }}</td>
              <td class="px-4 py-2">{{ $it->qty ?? 1 }}</td>
              <td class="px-4 py-2">Rp {{ number_format($it->price ?? 0,0,',','.') }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <form action="{{ route('admin.orders.updateStatus',$order->id) }}" method="POST" class="mt-6">
      @csrf @method('PATCH')
      <label class="block text-sm font-medium mb-1">Ubah Status</label>
      <select name="status" class="border rounded-lg px-3 py-2">
        @foreach(['pending','paid','failed','refunded','expired'] as $s)
          <option value="{{ $s }}" @selected($order->status===$s)>{{ $s }}</option>
        @endforeach
      </select>
      <button class="ml-2 px-4 py-2 rounded-lg bg-pink-600 text-white hover:bg-pink-700">Update</button>
    </form>
  </div>
</x-layout.base>
