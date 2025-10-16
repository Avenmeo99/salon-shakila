@props([
    'variant' => 'default',
    'padding' => 'default',
    'hover' => true
])

@php
$baseClasses = 'bg-white rounded-xl shadow-lg';

$variantClasses = [
    'default' => '',
    'gradient' => 'bg-gradient-to-br from-pink-50 to-purple-50',
    'bordered' => 'border-2 border-gray-200',
    'featured' => 'border-2 border-pink-200 relative'
];

$paddingClasses = [
    'sm' => 'p-4',
    'default' => 'p-6',
    'lg' => 'p-8',
    'xl' => 'p-10'
];

$hoverClasses = $hover ? 'hover:shadow-xl transition-shadow duration-300' : '';

$classes = implode(' ', [
    $baseClasses,
    $variantClasses[$variant] ?? '',
    $paddingClasses[$padding] ?? $paddingClasses['default'],
    $hoverClasses,
    $attributes->get('class', '')
]);
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>