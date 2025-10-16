## Salon Shakila

Proyek ini adalah aplikasi Laravel 12 untuk salon kecantikan yang menampilkan katalog layanan, paket bundling, keranjang belanja, dan proses checkout sederhana.

## Menjalankan Proyek

1. **Install dependensi**

   ```bash
   composer install
   npm install
   ```

2. **Salin dan konfigurasi environment**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   Lengkapi kredensial database dan konfigurasi Midtrans pada variabel `MIDTRANS_SERVER_KEY`.

3. **Migrasi dan seeding database**

   ```bash
   php artisan migrate
   php artisan db:seed --class=ServiceSeeder
   # Opsional untuk jam operasional booking
   php artisan db:seed --class=BookingTimeblockSeeder
   ```

4. **Jalankan aplikasi**

   ```bash
   php artisan serve
   npm run dev
   ```

Setelah server berjalan, akses `http://localhost:8000` untuk melihat katalog layanan dan melakukan pemesanan.

### Alur Booking

1. Jalankan migrasi (dan seeder jika menggunakan jam operasional default) seperti langkah di atas.
2. Buka `/services`, pilih layanan yang diinginkan, lalu klik tombol **Booking**.
3. Isi formulir booking. Centang opsi **Bayar sekarang** jika ingin langsung diarahkan ke alur keranjang/checkout.
