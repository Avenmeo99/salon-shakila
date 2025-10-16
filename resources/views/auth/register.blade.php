<x-layout.base :title="'Daftar - Shakila Salon'" :description="'Buat akun untuk booking & checkout lebih mudah.'">
    <section class="min-h-[80vh] bg-gradient-to-b from-pink-50 to-white py-16">
        <div class="max-w-3xl mx-auto px-6">
            <div class="bg-white rounded-3xl shadow-xl border border-pink-100 p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-1">Daftar Akun Baru</h2>
                <p class="text-sm text-gray-600 mb-6">Butuh kurang dari 1 menit ✨</p>

                @if ($errors->any())
                    <div class="mb-4 rounded-2xl border border-red-200 bg-red-50 p-3 text-sm text-red-700">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="grid sm:grid-cols-2 gap-5">
                    @csrf

                    <label class="block sm:col-span-2">
                        <span class="text-sm font-semibold text-gray-700">Nama Lengkap</span>
                        <input type="text" name="name" value="{{ old('name') }}" required
                               class="mt-2 w-full rounded-2xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                    </label>

                    <label class="block">
                        <span class="text-sm font-semibold text-gray-700">Email</span>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="mt-2 w-full rounded-2xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                    </label>

                    <label class="block">
                        <span class="text-sm font-semibold text-gray-700">No. WhatsApp (opsional)</span>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                               class="mt-2 w-full rounded-2xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                    </label>

                    <label class="block">
                        <span class="text-sm font-semibold text-gray-700">Kata Sandi</span>
                        <input type="password" name="password" required
                               class="mt-2 w-full rounded-2xl border-gray-200 focus:border-pink-500 focus:ring-pink-500" placeholder="Minimal 6 karakter">
                    </label>

                    <label class="block">
                        <span class="text-sm font-semibold text-gray-700">Ulangi Kata Sandi</span>
                        <input type="password" name="password_confirmation" required
                               class="mt-2 w-full rounded-2xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                    </label>

                    <div class="sm:col-span-2">
                        <button type="submit"
                                class="w-full rounded-full bg-pink-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-pink-200 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                            Daftar
                        </button>
                    </div>
                </form>

                <p class="mt-6 text-center text-sm text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-semibold text-pink-600 hover:text-pink-700">Masuk</a>
                </p>
            </div>
        </div>
    </section>
</x-layout.base>
