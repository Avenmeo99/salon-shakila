@props(['service'])

@php
    $price = number_format($service->effectivePrice(), 0, ',', '.');
@endphp

<div class="group relative rounded-2xl border border-pink-100 bg-white p-5 shadow-sm hover:shadow-md transition">
    {{-- Header --}}
    <div class="mb-4">
        <h3 class="text-lg font-semibold text-gray-900">{{ $service->name }}</h3>
        <p class="text-sm text-gray-500">{{ $service->duration }} menit</p>
    </div>

    {{-- Deskripsi --}}
    <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $service->description }}</p>

    {{-- Harga & Detail --}}
    <div class="mt-auto flex items-center justify-between">
        <div>
            <p class="text-xs text-gray-500">Mulai dari</p>
            <p class="text-2xl font-extrabold text-pink-600">Rp{{ $price }}</p>
        </div>

        {{-- FIX: param key harus 'service' --}}
        <a href="{{ route('services.show', ['service' => $service->slug]) }}"
           class="text-sm font-semibold text-pink-600 hover:text-pink-700 transition">
            Detail
        </a>
    </div>

    {{-- Tombol Aksi --}}
    <div class="mt-4 flex flex-col sm:flex-row gap-2">
        {{-- Tombol Pesan (keranjang) --}}
        <form action="{{ route('cart.add') }}" method="POST" class="flex-1">
            @csrf
            <input type="hidden" name="service" value="{{ $service->slug }}">
            <input type="hidden" name="qty" value="1">
            <button type="submit"
                class="w-full rounded-full bg-pink-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-pink-700 transition">
                Pesan Sekarang
            </button>
        </form>

        {{-- Tombol Booking --}}
        @auth
            <a href="{{ route('bookings.create', ['service' => $service->slug]) }}"
               class="flex-1 inline-flex items-center justify-center rounded-full border border-pink-300 px-5 py-2.5 text-sm font-semibold text-pink-600 hover:bg-pink-50 transition">
                Booking
            </a>
        @else
            <a href="{{ route('login') }}"
               class="flex-1 inline-flex items-center justify-center rounded-full border border-pink-300 px-5 py-2.5 text-sm font-semibold text-pink-600 hover:bg-pink-50 transition">
                Booking
            </a>
        @endauth
    </div>
</div>
