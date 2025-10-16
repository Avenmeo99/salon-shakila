@props([
    'variant' => 'primary',
    'size' => 'default',
    'href' => null,
    'type' => 'button',
    'disabled' => false
])

@php
$baseClasses = 'inline-flex items-center justify-center font-semibold rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2';

$variantClasses = [
    'primary' => 'bg-gradient-to-r from-pink-500 to-purple-600 text-white hover:from-pink-600 hover:to-purple-700 focus:ring-pink-500 shadow-lg',
    'secondary' => 'border-2 border-pink-600 text-pink-600 hover:bg-pink-600 hover:text-white focus:ring-pink-500',
    'outline' => 'border-2 border-gray-300 text-gray-700 hover:border-gray-400 hover:bg-gray-50 focus:ring-gray-500',
    'ghost' => 'text-gray-700 hover:bg-gray-100 focus:ring-gray-500',
    'white' => 'bg-white text-pink-600 hover:bg-gray-100 focus:ring-pink-500 shadow-lg'
];

$sizeClasses = [
    'sm' => 'px-4 py-2 text-sm',
    'default' => 'px-6 py-3 text-base',
    'lg' => 'px-8 py-4 text-lg',
    'xl' => 'px-10 py-5 text-xl'
];

$disabledClasses = $disabled ? 'opacity-50 cursor-not-allowed' : '';

$classes = implode(' ', [
    $baseClasses,
    $variantClasses[$variant] ?? $variantClasses['primary'],
    $sizeClasses[$size] ?? $sizeClasses['default'],
    $disabledClasses,
    $attributes->get('class', '')
]);
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif