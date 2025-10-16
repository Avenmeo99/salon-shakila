@props(['active' => false])

@php
$classes = $active
    ? 'text-pink-600 font-semibold'
    : 'text-gray-700 hover:text-pink-600';
@endphp

<a 
    x-data="{ hover: false, active: @js($active) }"
    {{ $attributes->merge([
        'class' => "
            relative px-3 py-2 text-sm font-medium
            transition-colors duration-300 ease-in-out
            $classes
        "
    ]) }}
>
    <span 
        @mouseenter="hover = true" 
        @mouseleave="hover = false" 
        class="relative inline-block"
    >
        {{ $slot }}

        <!-- Garis bawah lenting halus -->
        <span 
            class="absolute left-1/2 bottom-0 h-[2px] bg-pink-500 origin-center 
                   transition-all duration-400 ease-[cubic-bezier(0.45,0,0.25,1)]"
            :class="(active || hover) 
                ? 'w-full opacity-100 -translate-x-1/2' 
                : 'w-0 opacity-0 -translate-x-1/2'">
        </span>
    </span>
</a>
