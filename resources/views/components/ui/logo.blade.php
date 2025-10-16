@props(['size' => 'default'])

@php
$sizeClasses = [
    'sm' => 'w-8 h-8',
    'default' => 'w-10 h-10',
    'lg' => 'w-12 h-12',
    'xl' => 'w-16 h-16'
];

$textSizeClasses = [
    'sm' => 'text-sm',
    'default' => 'text-lg',
    'lg' => 'text-xl',
    'xl' => 'text-2xl'
];
@endphp

<div class="{{ $sizeClasses[$size] }} bg-gradient-to-r from-pink-500 to-purple-600 rounded-full flex items-center justify-center">
    <span class="text-white font-bold {{ $textSizeClasses[$size] }}">S</span>
</div>