<x-layout.base :title="'Kelola Layanan'">
  <div class="max-w-7xl mx-auto px-4 py-10">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-bold">Layanan</h1>
      <a href="{{ route('admin.services.create') }}" class="px-4 py-2 rounded-lg bg-pink-600 text-white hover:bg-pink-700">Tambah</a>
    </div>

    @if(session('success'))
      <div class="mb-4 rounded-lg bg-green-50 text-green-700 px-4 py-3">
        {{ session('success') }}
      </div>
    @endif

    <div class="overflow-x-auto bg-white rounded-xl border">
      <table class="min-w-full text-sm">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-4 py-3 text-left">Nama</th>
            <th class="px-4 py-3 text-left">Type</th>
            <th class="px-4 py-3 text-left">Durasi</th>
            <th class="px-4 py-3 text-left">Harga</th>
            <th class="px-4 py-3 text-left">Status</th>
            <th class="px-4 py-3"></th>
          </tr>
        </thead>
        <tbody>
        @forelse($services as $svc)
          <tr class="border-t">
            <td class="px-4 py-3">{{ $svc->name }}</td>
            <td class="px-4 py-3">{{ $svc->type }}</td>
            <td class="px-4 py-3">{{ $svc->duration_minutes }} mnt</td>
            <td class="px-4 py-3">Rp {{ number_format($svc->price ?? 0,0,',','.') }}</td>
            <td class="px-4 py-3">
              <span class="px-2 py-1 rounded text-xs {{ $svc->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                {{ $svc->is_active ? 'Aktif' : 'Nonaktif' }}
              </span>
            </td>
            <td class="px-4 py-3 text-right">
              <a href="{{ route('admin.services.edit', $svc) }}" class="px-3 py-1 rounded border hover:bg-gray-50">Edit</a>
              <form action="{{ route('admin.services.destroy', $svc) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus layanan?')">
                @csrf @method('DELETE')
                <button class="px-3 py-1 rounded border text-red-600 hover:bg-red-50">Hapus</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td class="px-4 py-6 text-center text-gray-500" colspan="6">Belum ada layanan.</td></tr>
        @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-4">
      {{ $services->links() }}
    </div>
  </div>
</x-layout.base>
