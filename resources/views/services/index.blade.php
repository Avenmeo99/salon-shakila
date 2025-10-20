<x-layout.base :title="'Layanan — Shakila Salon'">
    <section class="max-w-5xl mx-auto px-4 py-10 space-y-8">
        <h1 class="text-2xl sm:text-3xl font-bold">Pesan & Bayar Langsung</h1>

        <div class="space-y-6">
            <h2 class="text-xl font-semibold">Layanan Satuan</h2>
            @if($singles->isEmpty())
                <p class="text-gray-500">Belum ada layanan yang tersedia saat ini.</p>
            @else
                <ul class="grid sm:grid-cols-2 gap-4">
                    @foreach($singles as $s)
                        <li class="rounded-xl border p-4">
                            <div class="font-semibold">{{ $s->name }}</div>
                            <div class="text-sm text-gray-500 mb-2">{{ $s->description ?? '—' }}</div>
                            <div class="font-bold">Rp {{ number_format((int)$s->price,0,',','.') }}</div>
                            <a href="{{ route('services.show', $s->slug) }}"
                               class="inline-block mt-2 px-4 py-2 rounded-lg bg-pink-600 text-white">
                                Lihat
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </section>
</x-layout.base>
