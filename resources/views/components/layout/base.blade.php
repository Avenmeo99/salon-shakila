<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Salon Shakila - Salon Kecantikan Terpercaya' }}</title>
    <meta name="description" content="{{ $description ?? 'Salon Shakila menyediakan layanan kecantikan terlengkap dengan terapis profesional. Booking online dan belanja produk kecantikan berkualitas.' }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Styles / JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    {{-- Additional Styles (opsional dari view) --}}
    {{ $styles ?? '' }}
</head>

{{-- ✅ Sticky footer setup: flex column + tinggi layar --}}
<body class="font-inter antialiased bg-white min-h-screen flex flex-col">
    {{-- Navbar --}}
    <x-layout.navbar />

    {{-- Konten utama harus flex-1 supaya footer terdorong ke bawah --}}
    <main id="main" class="flex-1">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <x-layout.footer />

    {{-- Additional Scripts (opsional dari view) --}}
    {{ $scripts ?? '' }}
</body>
</html>
