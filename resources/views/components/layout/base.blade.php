<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Salon Shakila - Salon Kecantikan Terpercaya' }}</title>
    <meta name="description" content="{{ $description ?? 'Salon Shakila menyediakan layanan kecantikan terlengkap dengan terapis profesional. Booking online dan belanja produk kecantikan berkualitas.' }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>

    
    <!-- Additional Styles -->
    {{ $styles ?? '' }}
</head>
<body class="font-inter antialiased bg-white">
    <!-- Navigation -->
    <x-layout.navbar />

    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <x-layout.footer />

    <!-- Additional Scripts -->
    {{ $scripts ?? '' }}
</body>
</html>