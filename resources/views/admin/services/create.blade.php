<x-layout.base :title="'Tambah Layanan'">
  <div class="max-w-3xl mx-auto px-4 py-10">
    <h1 class="text-2xl font-bold mb-6">Tambah Layanan</h1>

    <form action="{{ route('admin.services.store') }}" method="POST" class="space-y-4">
      @csrf

      <x-forms.input name="name" label="Nama" required />
      <x-forms.input name="slug" label="Slug (opsional)" />

      <div class="grid sm:grid-cols-2 gap-4">
        <x-forms.select name="type" label="Type" :options="['single' => 'single','package'=>'package']" required />
        <x-forms.input name="duration_minutes" type="number" min="0" label="Durasi (menit)" required />
      </div>

      <x-forms.input name="price" type="number" step="0.01" min="0" label="Harga (opsional)" />
      <x-forms.textarea name="description" label="Deskripsi" />
      <x-forms.input name="image_url" label="Image URL (opsional)" />

      <x-forms.select name="is_active" label="Status" :options="[1=>'Aktif',0=>'Nonaktif']" required />

      <div class="pt-4">
        <button class="px-4 py-2 rounded-lg bg-pink-600 text-white hover:bg-pink-700">Simpan</button>
        <a href="{{ route('admin.services.index') }}" class="ml-2 px-3 py-2 rounded-lg border">Batal</a>
      </div>
    </form>
  </div>
</x-layout.base>
