@props(['service'])

@php
    $price = number_format($service->effectivePrice(), 0, ',', '.');
    $duration = $service->duration_minutes ?? 60;
@endphp

<div class="group relative flex flex-col rounded-2xl border border-pink-100 bg-white p-5 shadow-sm transition hover:shadow-md">
    <div class="mb-3 flex items-center justify-between gap-2">
        <span class="inline-flex items-center rounded-full bg-pink-50 px-3 py-1 text-xs font-semibold text-pink-600 uppercase">
            {{ $service->type === 'package' ? 'Paket' : 'Layanan' }}
        </span>
        <span class="text-sm text-gray-500">{{ $duration }} menit</span>
    </div>

    <h3 class="text-lg font-semibold text-gray-900">{{ $service->name }}</h3>

    @if($service->description)
        <p class="mt-2 text-sm text-gray-600 line-clamp-3">{{ $service->description }}</p>
    @endif

    @isset($details)
        <div class="mt-4 rounded-xl bg-pink-50/70 p-4 text-sm text-gray-700">
            {{ $details }}
        </div>
    @endisset

    <div class="mt-6 flex items-center justify-between">
        <div>
            <p class="text-xs text-gray-500">Mulai dari</p>
            <p class="text-2xl font-extrabold text-pink-600">Rp{{ $price }}</p>
        </div>
        <a href="{{ route('services.show', ['service' => $service->slug]) }}" class="text-sm font-semibold text-pink-600 hover:text-pink-700 transition">
            Detail
        </a>
    </div>

    <div class="mt-4 flex flex-col gap-2 sm:flex-row">
        <form action="{{ route('cart.add') }}" method="POST" class="flex-1">
            @csrf
            <input type="hidden" name="service" value="{{ $service->slug }}">
            <input type="hidden" name="qty" value="1">
            <button type="submit" class="w-full rounded-full bg-pink-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-pink-700">
                Tambah ke Keranjang
            </button>
        </form>
        @auth
            <a href="{{ route('bookings.create', ['service' => $service->slug]) }}" class="flex-1 inline-flex items-center justify-center rounded-full border border-pink-300 px-5 py-2.5 text-sm font-semibold text-pink-600 transition hover:bg-pink-50">
                Booking
            </a>
        @else
            <a href="{{ route('login') }}" class="flex-1 inline-flex items-center justify-center rounded-full border border-pink-300 px-5 py-2.5 text-sm font-semibold text-pink-600 transition hover:bg-pink-50">
                Booking
            </a>
        @endauth
    </div>
</div>
