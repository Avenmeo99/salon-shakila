@props(['service'])

<div class="bg-white shadow-lg rounded-2xl overflow-hidden border border-pink-100 flex flex-col h-full">
    <div class="p-6 flex-1 flex flex-col">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-semibold uppercase tracking-wide text-pink-500">
                {{ $service->isPackage() ? 'Paket' : 'Layanan' }}
            </span>
            <span class="text-sm text-gray-500">{{ $service->duration_minutes }} menit</span>
        </div>

        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $service->name }}</h3>

        @if($service->description)
            <p class="text-gray-600 text-sm leading-relaxed flex-1">
                {{ \Illuminate\Support\Str::limit(strip_tags($service->description), 140) }}
            </p>
        @endif

        @isset($details)
            <div class="mt-4 text-sm text-gray-700 space-y-2">
                {{ $details }}
            </div>
        @endisset
    </div>

    <div class="px-6 pb-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="text-xs text-gray-500">Mulai dari</p>
                <p class="text-2xl font-bold text-pink-600">
                    Rp{{ number_format($service->effectivePrice(), 0, ',', '.') }}
                </p>
            </div>
            <a href="{{ route('services.show', $service->slug) }}" class="text-sm text-pink-600 hover:text-pink-700 font-semibold">
                Detail
            </a>
        </div>
        <form action="{{ route('cart.add') }}" method="POST" class="space-y-3">
            @csrf
            <input type="hidden" name="service" value="{{ $service->slug }}">
            <button type="submit"
                    class="w-full inline-flex justify-center items-center px-4 py-2 bg-pink-600 text-white text-sm font-semibold rounded-full hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transition">
                Pesan Sekarang
            </button>
        </form>
    </div>
</div>
