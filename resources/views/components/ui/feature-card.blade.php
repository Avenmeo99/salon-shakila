@props([
    'title',
    'description',
    'icon'
])

<x-ui.card padding="lg">
    <div class="w-16 h-16 bg-gradient-to-r from-pink-500 to-purple-600 rounded-full flex items-center justify-center mb-6">
        {!! $icon !!}
    </div>
    
    <h3 class="text-xl font-semibold text-gray-900 mb-4">{{ $title }}</h3>
    
    <p class="text-gray-600">
        {{ $description }}
    </p>
</x-ui.card>