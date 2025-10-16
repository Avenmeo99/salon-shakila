<x-layout.base :title="'Layanan — Shakila Salon'">

  {{-- Header / Hero mini --}}
  <section class="bg-gradient-to-b from-pink-50 to-white py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <p class="text-center text-xs tracking-widest text-pink-600 font-semibold">SHAKILA SALON</p>
      <h1 class="mt-3 text-center text-4xl font-extrabold text-gray-900">Pesan & Bayar Langsung</h1>
      <p class="mx-auto mt-3 max-w-2xl text-center text-gray-600">
        Pilih layanan favorit atau paket hemat, masukkan ke keranjang, atau lakukan booking pada jam yang Anda inginkan.
      </p>

      <div class="mt-4 flex justify-end">
        <a href="{{ route('cart.index') }}" class="inline-flex items-center gap-2 text-pink-600 font-semibold hover:text-pink-700">
          <i class="fa-solid fa-cart-shopping"></i> Lihat Keranjang
        </a>
      </div>

      {{-- search + tabs --}}
      <div class="mt-6 grid gap-3 sm:grid-cols-3">
        {{-- Search --}}
        <form method="GET" class="sm:col-span-2">
          <div class="relative">
            <input type="text" name="q" value="{{ request('q') }}"
                   class="w-full rounded-full border-gray-200 pl-11 pr-4 py-3 focus:border-pink-500 focus:ring-pink-500"
                   placeholder="Cari layanan atau paket…">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
              <i class="fa-solid fa-magnifying-glass"></i>
            </span>
          </div>
        </form>

        {{-- Tabs anchor (pakai anchor sederhana agar tanpa JS) --}}
        <div class="flex items-center justify-start sm:justify-end gap-2">
          @php $tab = request('tab', 'packages'); @endphp
          <a href="{{ route('services.index', array_merge(request()->except('page'), ['tab' => 'packages'])) }}"
             class="rounded-full px-4 py-2 text-sm font-semibold {{ $tab==='packages' ? 'bg-pink-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
            Paket
          </a>
          <a href="{{ route('services.index', array_merge(request()->except('page'), ['tab' => 'single'])) }}"
             class="rounded-full px-4 py-2 text-sm font-semibold {{ $tab==='single' ? 'bg-pink-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
            Satuan
          </a>
        </div>
      </div>
    </div>
  </section>

  {{-- Konten --}}
  <section class="py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

      {{-- Paket Populer --}}
      @if($tab === 'packages')
        <h2 class="text-xl font-bold text-gray-900 mb-4">Paket Populer</h2>
        @if(isset($packageServices) && count($packageServices))
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($packageServices as $service)
              <x-ui.service-card :service="$service" :isPackage="true" />
            @endforeach
          </div>
        @else
          <div class="rounded-2xl border border-yellow-200 bg-yellow-50 p-4 text-yellow-800">
            Belum ada paket yang tersedia.
          </div>
        @endif
      @endif

      {{-- Layanan Satuan --}}
      @if($tab === 'single')
        <h2 class="text-xl font-bold text-gray-900 mb-4">Layanan Perawatan</h2>
        @if(isset($singleServices) && count($singleServices))
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($singleServices as $service)
              <x-ui.service-card :service="$service" />
            @endforeach
          </div>
        @else
          <div class="rounded-2xl border border-yellow-200 bg-yellow-50 p-4 text-yellow-800">
            Belum ada layanan yang tersedia.
          </div>
        @endif
      @endif

    </div>
  </section>

</x-layout.base>
