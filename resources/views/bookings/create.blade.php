{{-- resources/views/bookings/create.blade.php --}}
<x-layout.base :title="'Booking • ' . $service->name">

    <section class="bg-white py-16">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Back link --}}
            <a href="{{ route('services.show', ['service' => $service->slug]) }}"
               class="inline-flex items-center text-sm text-gray-500 hover:text-pink-600 mb-6">
                &larr; Kembali ke layanan
            </a>

            {{-- Card --}}
            <div class="bg-white shadow-xl rounded-3xl border border-pink-100 overflow-hidden">
                <div class="p-8 md:p-10">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">
                        Booking {{ $service->name }}
                    </h1>
                    <p class="text-sm text-gray-500 mb-8">
                        Pilih jadwal kunjungan dan kami akan menghubungi Anda untuk konfirmasi.
                    </p>

                    {{-- Flash status --}}
                    @if(session('status'))
                        <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 p-4 text-sm text-green-700">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- Validation errors --}}
                    @if($errors->any())
                        <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Form --}}
                    <form action="{{ route('bookings.store', ['service' => $service->slug]) }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid gap-6 md:grid-cols-2">
                            {{-- Nama --}}
                            <label class="block">
                                <span class="text-sm font-semibold text-gray-700">Nama Lengkap</span>
                                <input type="text" name="customer_name" value="{{ old('customer_name') }}" required
                                       class="mt-2 w-full rounded-2xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                            </label>

                            {{-- WA/Telepon --}}
                            <label class="block">
                                <span class="text-sm font-semibold text-gray-700">Nomor WhatsApp</span>
                                <input type="text" name="customer_phone" value="{{ old('customer_phone') }}" maxlength="20" required
                                       class="mt-2 w-full rounded-2xl border-gray-200 focus:border-pink-500 focus:ring-pink-500"
                                       placeholder="08xxxxxxxxxx">
                            </label>
                        </div>

                        <div class="grid gap-6 md:grid-cols-2">
                            {{-- Tanggal --}}
                            <label class="block">
                                <span class="text-sm font-semibold text-gray-700">Tanggal</span>
                                <input
                                    type="date"
                                    id="booking-date"
                                    name="booking_date"
                                    min="{{ now()->format('Y-m-d') }}"
                                    value="{{ old('booking_date', $date->format('Y-m-d')) }}"
                                    required
                                    class="mt-2 w-full rounded-2xl border-gray-200 focus:border-pink-500 focus:ring-pink-500"
                                >
                                <p class="mt-2 text-xs text-gray-500">Ubah tanggal untuk melihat slot yang tersedia.</p>
                            </label>

                            {{-- Jam --}}
                            <label class="block">
                                <span class="text-sm font-semibold text-gray-700">Jam</span>

                                @if($slots->isNotEmpty())
                                    <select name="booking_time" required
                                            class="mt-2 w-full rounded-2xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                                        <option value="" disabled {{ old('booking_time') ? '' : 'selected' }}>Pilih jam tersedia</option>
                                        @foreach($slots as $slot)
                                            <option value="{{ $slot }}" {{ old('booking_time') === $slot ? 'selected' : '' }}>
                                                {{ $slot }} WIB
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    <div class="mt-2 rounded-2xl border border-yellow-200 bg-yellow-50 px-4 py-3 text-sm text-yellow-700">
                                        Slot tidak tersedia untuk tanggal ini. Silakan pilih tanggal lain.
                                    </div>
                                @endif
                            </label>
                        </div>

                        {{-- Catatan --}}
                        <label class="block">
                            <span class="text-sm font-semibold text-gray-700">Catatan Tambahan</span>
                            <textarea name="notes" rows="4"
                                      class="mt-2 w-full rounded-2xl border-gray-200 focus:border-pink-500 focus:ring-pink-500"
                                      placeholder="Opsional">{{ old('notes') }}</textarea>
                        </label>

                        {{-- Pay now --}}
                        <label class="inline-flex items-center space-x-3 text-sm text-gray-700">
                            <input type="checkbox" name="pay_now" value="1" {{ old('pay_now') ? 'checked' : '' }}
                                   class="h-4 w-4 rounded border-gray-300 text-pink-600 focus:ring-pink-500">
                            <span>Bayar sekarang melalui checkout</span>
                        </label>

                        {{-- Actions --}}
                        <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                            <button type="submit"
                                    class="inline-flex items-center justify-center rounded-full bg-pink-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-pink-200 transition hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                                Kirim Booking
                            </button>

                            <a href="{{ route('services.show', ['service' => $service->slug]) }}"
                               class="inline-flex items-center justify-center rounded-full bg-gray-100 px-6 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-200">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>

    {{-- Auto-reload slots saat tanggal berubah --}}
    <x-slot name="scripts">
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const dateInput = document.getElementById('booking-date');
                if (!dateInput) return;

                dateInput.addEventListener('change', (e) => {
                    const selected = e.target.value;
                    if (!selected) return;
                    const url = new URL(window.location.href);
                    url.searchParams.set('date', selected);
                    window.location.href = url.toString();
                });
            });
        </script>
    </x-slot>
</x-layout.base>
