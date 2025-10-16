@props([
    'title',
    'description',
    'icon',
    'services' => [],
    'bookingUrl' => null
])

<x-ui.card variant="gradient" padding="lg" class="hover:scale-105 transition-transform duration-300">
    <div class="flex items-center mb-6">
        <div class="w-16 h-16 bg-gradient-to-r from-pink-500 to-purple-600 rounded-full flex items-center justify-center">
            {!! $icon !!}
        </div>
        <h3 class="text-2xl font-bold text-gray-900 ml-4">{{ $title }}</h3>
    </div>
    
    <p class="text-gray-600 mb-6">
        {{ $description }}
    </p>
    
    @if(count($services) > 0)
        <div class="space-y-3 mb-6">
            @foreach($services as $service)
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span class="text-gray-700">{{ $service }}</span>
                </div>
            @endforeach
        </div>
    @endif
    
    @if($bookingUrl)
        <x-ui.button href="{{ $bookingUrl }}" variant="primary">
            Pesan Sekarang
        </x-ui.button>
    @endif
</x-ui.card>