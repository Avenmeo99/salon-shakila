{{-- resources/views/checkout/index.blade.php --}}
<x-layout.base :title="'Checkout — Shakila Salon'">
  <section class="max-w-5xl mx-auto px-4 py-10 space-y-6">

    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Checkout</h1>

    @if(session('status'))
      <div class="rounded-lg bg-emerald-50 text-emerald-700 px-4 py-2">{{ session('status') }}</div>
    @endif

    {{-- Ringkasan --}}
    <div class="bg-white rounded-2xl border p-6">
      <h2 class="text-lg font-semibold mb-4">Ringkasan Pesanan</h2>
      @if(($items ?? collect())->isEmpty())
        <p class="text-gray-600">Tidak ada item dalam keranjang Anda.</p>
      @else
        <ul class="divide-y">
          @foreach($items as $it)
            @php
              $name = $it->service->name ?? $it->name_cache ?? 'Layanan';
              $qty  = (int) $it->qty;
              $price = (int) $it->unit_price;
              $subtotalRow = $qty * $price;
            @endphp
            <li class="py-4 flex items-center justify-between">
              <div>
                <p class="font-medium">{{ $name }}</p>
                <p class="text-sm text-gray-500">Qty: {{ $qty }}</p>
              </div>
              <div class="font-semibold">Rp {{ number_format($subtotalRow,0,',','.') }}</div>
            </li>
          @endforeach
        </ul>
      @endif
    </div>

    {{-- Kupon --}}
    <form method="POST" action="{{ route('checkout.applyCoupon') }}" class="flex gap-2">
      @csrf
      <input name="code" placeholder="Masukkan kode kupon" class="flex-1 rounded-lg border px-3 py-2" />
      <button class="rounded-lg bg-gray-900 text-white px-4 py-2 hover:bg-black/80">Gunakan</button>
    </form>
    @if(session('coupon'))
      <p class="text-emerald-600 text-sm">Kupon aktif: {{ session('coupon.code') }}</p>
    @endif

    {{-- Tips --}}
    <form method="POST" action="{{ route('checkout.applyTips') }}" class="mt-4 flex gap-2 flex-wrap">
      @csrf
      @foreach([0,5,10] as $r)
        <button name="rate" value="{{ $r }}" class="rounded-lg border px-3 py-2 hover:bg-gray-50">
          Tip {{ $r }}%
        </button>
      @endforeach
      <input type="number" name="custom" min="0" placeholder="Nominal (Rp)" class="rounded-lg border px-3 py-2 w-40" />
      <button class="rounded-lg bg-gray-900 text-white px-4">Set</button>
    </form>

    {{-- Total --}}
    <div class="bg-white rounded-2xl border p-6 mt-4 space-y-2">
      <div class="flex justify-between">
        <span>Subtotal</span>
        <span>Rp {{ number_format($subtotal,0,',','.') }}</span>
      </div>
      @if($discount>0)
      <div class="flex justify-between text-emerald-600">
        <span>Diskon</span>
        <span>- Rp {{ number_format($discount,0,',','.') }}</span>
      </div>
      @endif
      @if($tips>0)
      <div class="flex justify-between">
        <span>Tips</span>
        <span>Rp {{ number_format($tips,0,',','.') }}</span>
      </div>
      @endif
      <div class="flex justify-between font-bold text-lg border-t pt-2">
        <span>Total</span>
        <span>Rp {{ number_format($grand_total,0,',','.') }}</span>
      </div>
    </div>

    {{-- Tombol Bayar (Snap) --}}
    <button id="btn-pay"
            class="mt-4 inline-flex items-center px-6 py-3 rounded-xl bg-pink-600 text-white font-semibold hover:bg-pink-700">
      Bayar Sekarang
    </button>

  </section>

  {{-- Midtrans Snap JS --}}
  <script src="https://app.sandbox.midtrans.com/snap/snap.js"
          data-client-key="{{ config('midtrans.client_key') }}"></script>

  <script>
    document.getElementById('btn-pay').addEventListener('click', function () {
      snap.pay(@json($snapToken), {
        onSuccess: function (result) {
          window.location.href = @json(route('checkout.store'));
        },
        onPending: function (result) {
          window.location.href = @json(route('checkout.store'));
        },
        onError: function (result) {
          alert('Pembayaran gagal / dibatalkan');
        },
        onClose: function () {
          // user menutup popup
        }
      });
    });
  </script>
</x-layout.base>
