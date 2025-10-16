{{-- resources/views/components/layout/navbar.blade.php --}}
<nav class="bg-white shadow-lg sticky top-0 z-50"
     x-data="{ mobileMenuOpen: false, accountOpen: false }"
     @close-mobile-menu.window="mobileMenuOpen = false">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            {{-- Logo kiri --}}
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <x-ui.logo />
                    <span class="text-xl font-bold text-gray-900">Shakila Salon</span>
                </a>
            </div>

            {{-- Navigasi desktop (tengah) --}}
            <div class="hidden md:flex flex-1 justify-center">
                <div class="flex items-center space-x-8">
                    {{-- Tidak menampilkan "Home" di navbar sesuai permintaan --}}
                    <x-ui.nav-link href="{{ route('branda') }}" :active="request()->routeIs('branda')">
                        Beranda
                    </x-ui.nav-link>

                    <x-ui.nav-link href="{{ route('services.index') }}" :active="request()->routeIs('services.*')">
                        Layanan
                    </x-ui.nav-link>

                    <x-ui.nav-link href="{{ route('blog') }}" :active="request()->routeIs('blog')">
                        Blog
                    </x-ui.nav-link>

                    <x-ui.nav-link href="{{ route('contact') }}" :active="request()->routeIs('contact')">
                        Kontak
                    </x-ui.nav-link>
                </div>
            </div>

            {{-- Aksi kanan (desktop) --}}
            <div class="hidden md:flex items-center gap-4">

                {{-- CTA PESAN → ke daftar layanan --}}
                <x-ui.button href="{{ route('services.index') }}" variant="primary" size="sm">
                    Pesan
                </x-ui.button>

                {{-- Icon keranjang --}}
                <a href="{{ route('cart.index') }}"
                   class="text-gray-700 hover:text-pink-600 transition"
                   title="Keranjang">
                    <i class="fas fa-shopping-cart text-xl"></i>
                </a>

                {{-- Akun / Login --}}
                @guest
                    <a href="{{ route('login') }}"
                       class="text-gray-700 hover:text-pink-600 transition"
                       title="Masuk / Daftar">
                        <i class="fas fa-user-circle text-xl"></i>
                    </a>
                @else
                    <div class="relative">
                        <button @click="accountOpen = !accountOpen"
                                class="text-gray-700 hover:text-pink-600 transition focus:outline-none"
                                aria-haspopup="true" :aria-expanded="accountOpen">
                            <i class="fas fa-user-circle text-xl"></i>
                        </button>

                        {{-- Dropdown akun --}}
                        <div x-cloak
                             x-show="accountOpen"
                             @click.away="accountOpen = false"
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 -translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 -translate-y-1"
                             class="absolute right-0 mt-3 w-56 rounded-2xl border border-pink-100 bg-white shadow-xl">
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-sm text-gray-500">Hai,</p>
                                <p class="text-sm font-semibold text-gray-900 truncate">
                                    {{ auth()->user()->name }}
                                </p>
                            </div>

                            <div class="py-1">
                                {{-- Ganti href jika punya halaman profil --}}
                                <a href="#"
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-pink-50">
                                    Profil Saya
                                </a>

                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-pink-50">
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endguest
            </div>

            {{-- Tombol hamburger (mobile) --}}
            <div class="md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="text-gray-900 hover:text-pink-600 focus:outline-none transition"
                        aria-label="Toggle menu">
                    {{-- Hamburger --}}
                    <svg x-show="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg"
                         class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    {{-- X --}}
                    <svg x-show="mobileMenuOpen" xmlns="http://www.w3.org/2000/svg"
                         class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- NAV MOBILE --}}
    <div x-cloak
         x-show="mobileMenuOpen"
         @click.away="mobileMenuOpen = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="md:hidden">

        <div class="px-4 pt-4 pb-6 space-y-2 bg-white shadow-lg rounded-b-lg">

            <x-ui.nav-link-mobile href="{{ route('branda') }}" :active="request()->routeIs('branda')">
                Beranda
            </x-ui.nav-link-mobile>

            <x-ui.nav-link-mobile href="{{ route('services.index') }}" :active="request()->routeIs('services.*')">
                Layanan
            </x-ui.nav-link-mobile>

            <x-ui.nav-link-mobile href="{{ route('blog') }}" :active="request()->routeIs('blog')">
                Blog
            </x-ui.nav-link-mobile>

            <x-ui.nav-link-mobile href="{{ route('contact') }}" :active="request()->routeIs('contact')">
                Kontak
            </x-ui.nav-link-mobile>

            {{-- Baris icon (keranjang & akun) --}}
            <div class="flex items-center gap-5 pt-2">
                <a href="{{ route('cart.index') }}" class="text-gray-700 hover:text-pink-600 transition">
                    <i class="fas fa-shopping-cart text-lg"></i>
                    <span class="sr-only">Keranjang</span>
                </a>

                @guest
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-pink-600 transition">
                        <i class="fas fa-user-circle text-lg"></i>
                        <span class="sr-only">Masuk / Daftar</span>
                    </a>
                @else
                    <a href="#" class="text-gray-700 hover:text-pink-600 transition">
                        <i class="fas fa-user-circle text-lg"></i>
                        <span class="sr-only">Akun</span>
                    </a>
                @endguest
            </div>

            {{-- CTA PESAN (mobile) → ke daftar layanan --}}
            <div class="pt-3">
                <x-ui.button href="{{ route('services.index') }}" variant="primary" size="full">
                    Pesan
                </x-ui.button>
            </div>
        </div>
    </div>
</nav>
