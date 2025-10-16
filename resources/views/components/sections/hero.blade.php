@props([
    'eyebrow' => 'Salon Shakila',
    'title' => 'Wujudkan Kecantikan Impian Anda',
    'subtitle' => null,
    'description' => 'Nikmati layanan kecantikan terbaik dengan terapis profesional dan fasilitas modern.',
    'imageMain' => 'img/salon1.jpg',
    'imageSecondary' => 'img/salon2.jpg',
    'imageTertiary' => 'img/salon3.jpg',
    'stats' => [
        ['label' => 'Pelanggan Puas', 'value' => '2.5K+'],
        ['label' => 'Pengalaman', 'value' => '10+ Tahun'],
        ['label' => 'Rating Rata-rata', 'value' => '4.9/5'],
    ],
])

@php
    $statItems = collect($stats)
        ->filter(fn ($stat) => is_array($stat) && ($stat['label'] ?? null) && ($stat['value'] ?? null))
        ->take(3);
@endphp

<section class="relative overflow-hidden bg-gradient-to-br from-pink-50 via-white to-purple-50 py-16">
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        <div class="absolute -left-32 top-20 w-72 h-72 bg-pink-200 rounded-full blur-3xl opacity-40"></div>
        <div class="absolute -right-32 bottom-0 w-80 h-80 bg-purple-200 rounded-full blur-3xl opacity-40"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:items-center">
            <div>
                @if($eyebrow)
                    <span class="inline-flex items-center px-4 py-1 rounded-full bg-pink-100 text-pink-600 text-sm font-medium mb-6">
                        {{ $eyebrow }}
                    </span>
                @endif

                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 tracking-tight leading-tight">
                    {!! $title !!}
                </h1>

                @if($subtitle)
                    <p class="mt-4 text-xl text-gray-600">
                        {{ $subtitle }}
                    </p>
                @endif

                @if($description)
                    <p class="mt-6 text-lg text-gray-500 leading-relaxed">
                        {{ $description }}
                    </p>
                @endif

                @if(trim((string) $slot))
                    <div class="mt-8">
                        {{ $slot }}
                    </div>
                @endif

                <div class="mt-8 flex flex-col sm:flex-row sm:items-center gap-4">
                    @isset($primaryButton)
                        {{ $primaryButton }}
                    @endisset

                    @isset($secondaryButton)
                        {{ $secondaryButton }}
                    @endisset
                </div>

                @if($statItems->isNotEmpty())
                    <dl class="mt-12 grid grid-cols-1 sm:grid-cols-3 gap-6">
                        @foreach($statItems as $stat)
                            <div class="p-6 bg-white/70 backdrop-blur rounded-2xl shadow-sm border border-white">
                                <dt class="text-sm font-medium text-gray-500">{{ $stat['label'] }}</dt>
                                <dd class="mt-2 text-2xl font-bold text-gray-900">{{ $stat['value'] }}</dd>
                            </div>
                        @endforeach
                    </dl>
                @endif
            </div>

            <div class="relative">
                <div class="absolute -top-6 -left-6 w-24 h-24 bg-gradient-to-br from-pink-400 to-purple-400 rounded-3xl opacity-30"></div>
                <div class="absolute -bottom-8 -right-8 w-32 h-32 border-4 border-dashed border-pink-200 rounded-full"></div>

                <div class="grid grid-cols-2 gap-4">
                    <img src="{{ asset($imageMain) }}" alt="Salon Shakila"
                         class="w-full h-56 object-cover rounded-3xl shadow-xl border-4 border-white" loading="lazy">
                    <img src="{{ asset($imageSecondary) }}" alt="Layanan Salon"
                         class="w-full h-56 object-cover rounded-3xl shadow-xl border-4 border-white lg:translate-y-12"
                         loading="lazy">
                    <img src="{{ asset($imageTertiary) }}" alt="Suasana Salon"
                         class="w-full h-56 object-cover rounded-3xl shadow-xl border-4 border-white col-span-2 lg:mx-auto lg:w-3/4"
                         loading="lazy">
                </div>
            </div>
        </div>
    </div>
</section>
