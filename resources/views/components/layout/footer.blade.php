<footer class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center mb-4">
                    <x-ui.logo />
                    <span class="ml-3 text-xl font-bold">Shakila Salon</span>
                </div>
                <p class="text-gray-300 mb-4">
                    Salon kecantikan terpercaya dengan layanan profesional dan produk berkualitas tinggi. 
                    Kami berkomitmen memberikan pengalaman kecantikan terbaik untuk Anda.
                </p>
                <x-ui.social-links />
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Menu Cepat</h3>
               <ul class="space-y-2">
                  <li><a href="{{ route('services.index') }}" class="text-gray-300 hover:text-pink-400 transition-colors duration-200">Layanan</a></li>
                  <li><a href="{{ route('blog') }}" class="text-gray-300 hover:text-pink-400 transition-colors duration-200">Blog</a></li>
  {{-- Booking per layanan (butuh slug), jadi di footer kita arahkan ke daftar layanan dulu --}}
                <li><a href="{{ route('services.index') }}" class="text-gray-300 hover:text-pink-400 transition-colors duration-200">Booking</a></li>
                 <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-pink-400 transition-colors duration-200">Kontak</a></li>
                    </ul>

            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                <x-ui.contact-info />
            </div>
        </div>

        <div class="border-t border-gray-800 mt-8 pt-8 text-center">
            <p class="text-gray-300">&copy; {{ date('Y') }} Shakila Salon. Semua hak dilindungi.</p>
        </div>
    </div>
</footer>