{{-- resources/views/cart/index.blade.php --}}
<x-layout.base :title="'Keranjang — Shakila Salon'">
    <section class="max-w-5xl mx-auto px-4 py-10 space-y-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Keranjang Pemesanan</h1>

        @if(session('status'))
            <div class="rounded-lg bg-emerald-50 text-emerald-700 px-4 py-2">
                {{ session('status') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl border">
            @forelse(($items ?? collect()) as $it)
                @php
                    $name = $it->name_cache ?? ($it->service->name ?? 'Layanan');
                    $qty  = (int) ($it->qty ?? 1);
                    $price = (int) ($it->unit_price ?? 0);
                    $subtotal = $qty * $price;
                @endphp
                <div class="p-4 border-b flex items-center justify-between">
                    <div>
                        <div class="font-medium">{{ $name }}</div>
                        <div class="text-sm text-gray-500">Rp {{ number_format($price,0,',','.') }} x {{ $qty }}</div>
                    </div>
                    <div class="flex items-center gap-3">
                        <form method="POST" action="{{ route('cart.update', $it->id) }}" class="flex items-center gap-2">
                            @method('PATCH') @csrf
                            <input type="number" name="qty" value="{{ $qty }}" min="1" class="w-16 rounded border px-2 py-1">
                            <button class="px-3 py-1 rounded bg-gray-100 hover:bg-gray-200">Update</button>
                        </form>
                        <form method="POST" action="{{ route('cart.remove', $it->id) }}">
                            @method('DELETE') @csrf
                            <button class="px-3 py-1 rounded bg-red-100 text-red-700 hover:bg-red-200">Hapus</button>
                        </form>
                        <div class="font-semibold">Rp {{ number_format($subtotal,0,',','.') }}</div>
                    </div>
                </div>
            @empty
                <div class="p-6 text-gray-600">Belum ada item dalam keranjang.</div>
            @endforelse
        </div>

        <div class="text-right">
            <div class="text-lg font-bold">Total: Rp {{ number_format($total ?? 0,0,',','.') }}</div>
            <a href="{{ route('checkout.index') }}"
               class="inline-flex mt-3 items-center px-6 py-3 rounded-xl bg-pink-600 text-white font-semibold hover:bg-pink-700">
                Lanjut ke Checkout
            </a>
        </div>
    </section>
</x-layout.base>
