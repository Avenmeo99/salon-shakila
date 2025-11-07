<x-layout.base title="Dashboard Admin">
  <div class="max-w-6xl mx-auto px-4 py-10">
    <h1 class="text-2xl font-bold mb-4">Dashboard Admin</h1>
    <p class="text-gray-600">Selamat datang, {{ auth()->user()->name }}.</p>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
      <a href="{{ route('admin.services.index') }}" class="p-6 bg-white rounded-xl shadow hover:shadow-lg transition">
        <div class="font-semibold">Kelola Layanan</div>
      </a>
      <a href="{{ route('admin.bookings.index') }}" class="p-6 bg-white rounded-xl shadow hover:shadow-lg transition">
        <div class="font-semibold">Booking</div>
      </a>
      <a href="{{ route('admin.orders.index') }}" class="p-6 bg-white rounded-xl shadow hover:shadow-lg transition">
        <div class="font-semibold">Orders</div>
      </a>
    </div>
  </div>
</x-layout.base>
