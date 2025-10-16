@props(['active' => false])

@php
$classes = $active
    ? 'bg-pink-50 text-pink-600 font-semibold'
    : 'text-gray-700 hover:text-pink-600 hover:bg-pink-50';
@endphp

<a {{ $attributes->merge([
    'class' => "
        block px-4 py-2 rounded-md text-base font-medium
        transition-all duration-300 ease-in-out
        $classes
    "
]) }}>
    {{ $slot }}
</a>
