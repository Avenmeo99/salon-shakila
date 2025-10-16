<nav class="bg-white shadow-lg sticky top-0 z-50"
     x-data="{ mobileMenuOpen: false }"
     @close-mobile-menu.window="mobileMenuOpen = false">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center">
                    <x-ui.logo />
                    <span class="ml-3 text-xl font-bold text-gray-900">Shakila Salon</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex flex-1 justify-center">
                <div class="flex space-x-8">
                    <x-ui.nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">Home</x-ui.nav-link>
                    <x-ui.nav-link href="{{ route('branda') }}" :active="request()->routeIs('branda')">Beranda</x-ui.nav-link>
                    <x-ui.nav-link href="{{ route('services.index') }}" :active="request()->routeIs('services.*')">Layanan</x-ui.nav-link>
                    <x-ui.nav-link href="{{ route('blog') }}" :active="request()->routeIs('blog')">Blog</x-ui.nav-link>
                    <x-ui.nav-link href="{{ route('about') }}" :active="request()->routeIs('about')">Tentang</x-ui.nav-link>
                    <x-ui.nav-link href="{{ route('contact') }}" :active="request()->routeIs('contact')">Kontak</x-ui.nav-link>
                   <x-ui.nav-link href="{{ route('cart.index') }}" :active="request()->routeIs('cart.*')">Keranjang</x-ui.nav-link>
                </div>
            </div>

            <!-- Booking Button (desktop only) -->
            <div class="hidden md:block">
                <x-ui.button href="{{ route('booking') }}" variant="primary" size="sm">
                    Pesan
                </x-ui.button>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button 
                    @click="mobileMenuOpen = !mobileMenuOpen" 
                    class="text-gray-900 hover:text-pink-600 focus:outline-none transition"
                >
                    <!-- Hamburger icon -->
                    <svg x-show="!mobileMenuOpen"
                         xmlns="http://www.w3.org/2000/svg"
                         class="h-6 w-6"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                    </svg>

                    <!-- X icon -->
                    <svg x-show="mobileMenuOpen"
                         xmlns="http://www.w3.org/2000/svg"
                         class="h-6 w-6"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div 
        x-show="mobileMenuOpen"
        @click.away="mobileMenuOpen = false"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        class="md:hidden"
    >
        <div class="px-4 pt-4 pb-6 space-y-2 bg-white shadow-lg rounded-b-lg">
            <x-ui.nav-link-mobile href="{{ route('home') }}" :active="request()->routeIs('home')">Home</x-ui.nav-link-mobile>
            <x-ui.nav-link-mobile href="{{ route('branda') }}" :active="request()->routeIs('branda')">Beranda</x-ui.nav-link-mobile>
            <x-ui.nav-link-mobile href="{{ route('services.index') }}" :active="request()->routeIs('services.*')">Layanan</x-ui.nav-link-mobile>
            <x-ui.nav-link-mobile href="{{ route('blog') }}" :active="request()->routeIs('blog')">Blog</x-ui.nav-link-mobile>
            <x-ui.nav-link-mobile href="{{ route('about') }}" :active="request()->routeIs('about')">Tentang</x-ui.nav-link-mobile>
            <x-ui.nav-link-mobile href="{{ route('contact') }}" :active="request()->routeIs('contact')">Kontak</x-ui.nav-link-mobile>
            <x-ui.nav-link href="{{ route('cart.index') }}" :active="request()->routeIs('cart.*')">Keranjang</x-ui.nav-link>


            <!-- Tombol Booking -->
            <div class="pt-2">
                <x-ui.button href="{{ route('booking') }}" variant="primary" size="full">
                    Pesan
                </x-ui.button>
            </div>
        </div>
    </div>
</nav>
