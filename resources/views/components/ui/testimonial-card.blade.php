@props([
    'name',
    'role',
    'content',
    'rating' => 5
])

<x-ui.card padding="default">
    <div class="flex items-center mb-4">
        <div class="flex text-yellow-400">
            @for($i = 1; $i <= 5; $i++)
                <svg class="w-5 h-5 {{ $i <= $rating ? 'fill-current' : 'text-gray-300' }}" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
            @endfor
        </div>
    </div>
    
    <p class="text-gray-600 mb-4">
        "{{ $content }}"
    </p>
    
    <div class="flex items-center">
        <div class="w-10 h-10 bg-gradient-to-r from-pink-500 to-purple-600 rounded-full flex items-center justify-center">
            <span class="text-white font-semibold text-sm">{{ strtoupper(substr($name, 0, 2)) }}</span>
        </div>
        <div class="ml-3">
            <p class="font-semibold text-gray-900">{{ $name }}</p>
            <p class="text-sm text-gray-600">{{ $role }}</p>
        </div>
    </div>
</x-ui.card>