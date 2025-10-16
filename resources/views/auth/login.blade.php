<x-layout.base :title="'Masuk - Shakila Salon'" :description="'Login untuk melanjutkan pemesanan & booking.'">
    <section class="min-h-[80vh] bg-gradient-to-b from-pink-50 to-white py-16">
        <div class="max-w-6xl mx-auto px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-10 items-center">
                <div class="hidden lg:block">
                    <div class="bg-white/70 backdrop-blur rounded-3xl border border-pink-100 p-10 shadow-xl">
                        <div class="flex items-center gap-3 mb-6">
                            <x-ui.logo />
                            <span class="text-2xl font-extrabold text-gray-900">Shakila Salon</span>
                        </div>
                        <h1 class="text-4xl font-extrabold text-gray-900 leading-tight">
                            Selangkah lagi menuju <span class="text-pink-600">perawatan terbaik</span>
                        </h1>
                        <p class="mt-4 text-gray-600">Masuk untuk melanjutkan booking & checkout.</p>
                    </div>
                </div>

                <div>
                    <div class="mx-auto max-w-md bg-white rounded-3xl shadow-xl border border-pink-100 p-8" x-data="{ show: false }">
                        <h2 class="text-2xl font-bold text-gray-900 mb-1">Masuk ke Akun</h2>
                        <p class="text-sm text-gray-600 mb-6">Senang bertemu lagi! ✨</p>

                        @if ($errors->any())
                            <div class="mb-4 rounded-2xl border border-red-200 bg-red-50 p-3 text-sm text-red-700">
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}" class="space-y-5">
                            @csrf

                            <label class="block">
                                <span class="text-sm font-semibold text-gray-700">Email</span>
                                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                                       class="mt-2 w-full rounded-2xl border-gray-200 focus:border-pink-500 focus:ring-pink-500"
                                       placeholder="you@example.com">
                            </label>

                            <label class="block">
                                <span class="text-sm font-semibold text-gray-700">Kata Sandi</span>
                                <div class="mt-2 relative">
                                    <input :type="show ? 'text' : 'password'" name="password" required
                                           class="w-full rounded-2xl border-gray-200 pr-12 focus:border-pink-500 focus:ring-pink-500"
                                           placeholder="••••••••">
                                    <button type="button" class="absolute inset-y-0 right-0 px-3 text-gray-500 hover:text-pink-600"
                                            @click="show = !show" aria-label="Toggle password">👁️</button>
                                </div>
                            </label>

                            <div class="flex items-center justify-between">
                                <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                                    <input type="checkbox" name="remember" class="rounded text-pink-600 border-gray-300 focus:ring-pink-500">
                                    Ingat saya
                                </label>
                                @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm font-medium text-pink-600 hover:text-pink-700">
                                    Lupa sandi?
                                </a>
                                @endif
                            </div>

                            <button type="submit"
                                    class="w-full rounded-full bg-pink-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-pink-200 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                                Masuk
                            </button>
                        </form>

                        <p class="mt-6 text-center text-sm text-gray-600">
                            Belum punya akun?
                            <a href="{{ route('register') }}" class="font-semibold text-pink-600 hover:text-pink-700">Daftar sekarang</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout.base>
