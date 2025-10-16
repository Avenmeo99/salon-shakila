# Ikhtisar Proyek Salon Shakila

## Gambaran Umum Proyek
- **Kerangka & tooling:** Aplikasi Laravel 12 yang menargetkan PHP 8.2 dengan service provider dan scaffolding kernel/console standar.
- **Stack front-end:** Vite menjalankan proses build dengan Tailwind CSS serta PostCSS/autoprefixer. File bootstrap JavaScript default sudah mengatur Axios untuk permintaan HTTP.
- **Struktur repositori:** Direktori inti Laravel tersedia (mis. `app`, `bootstrap`, `config`, `database`, `resources`, `routes`, `tests`). Folder `app` baru berisi controller dasar, model `User` default, dan service provider bawaan.

## Routing & Struktur Aplikasi Server
- Semua routing didefinisikan di `routes/web.php`, masing-masing memetakan URL publik ke view Blade (`home`, `branda`, `services-components`, dan placeholder untuk `blog`, `booking`, `contact`, `about`).
- Belum ada controller kustom—closure pada route langsung mengembalikan view. Untuk logika halaman yang lebih kompleks, tambahkan controller baru atau pindahkan closure ke metode controller.

## Blade View & Komponen
- Halaman menggunakan komponen `<x-layout.base>` yang menyiapkan metadata `<head>`, font, navbar, Alpine.js, Tailwind lewat Vite, dan footer bersama.
- Komponen navbar menunjukkan perilaku responsif dengan Alpine.js untuk toggle menu mobile, dan memakai komponen UI reusable (`nav-link`, `nav-link-mobile`, `button`).
- Footer mengelola informasi perusahaan, tautan cepat, dan detail kontak via komponen UI bertingkat (`logo`, `social-links`, `contact-info`).
- Tiga view utama saat ini:
  - `home.blade.php`: hero landing dengan highlight layanan dan call-to-action.
  - `branda.blade.php`: halaman alternatif yang menyusun highlight fitur, pratinjau layanan, testimoni, dan CTA akhir.
  - `services-components.blade.php`: katalog layanan, paket harga, dan CTA tambahan yang memanfaatkan kartu dan tombol reusable.
- Perpustakaan komponen Blade di `resources/views/components/ui` menyediakan kartu, tombol, tile testimoni, dan kartu layanan reusable.
- Berkas komponen `hero` sudah ada namun masih kosong—peluang untuk mengekstrak markup hero yang berulang.

## Styling, Aset, & Pipeline Build
- Tailwind CSS diaktifkan melalui direktif `@tailwind` dalam `resources/css/app.css`; kustomisasi tema dapat ditambahkan di `tailwind.config.js`.
- Vite mengompilasi entry point CSS dan JavaScript, kemudian menyuntikannya melalui direktif Blade `@vite` pada layout dasar.
- JavaScript bootstrap saat ini hanya mengekspos Axios dan menyiapkan header default—siap untuk pengembangan Alpine atau integrasi Vue/React di masa depan.
- Aset statis (mis. gambar salon) berada di `public/img`, sesuai konvensi Laravel.

## Lapisan Data & Penyimpanan
- Migrasi database masih default (`users`, `cache`, `jobs`). Belum ada skema domain khusus. Direktori `database/factories` dan `database/seeders` belum diisi.
- Direktori storage dan bootstrap masih standar, jadi fitur upload file atau caching belum dikonfigurasi.

## Testing & Developer Experience
- Test suite feature dan unit masih placeholder. Setelah ada logika aplikasi, tambahkan test untuk route, controller, dan komponen.
- Composer menyediakan script `dev` untuk menjalankan `php artisan serve`, worker antrian, tail log, dan `npm run dev` secara bersamaan—berguna saat aplikasi makin kompleks.

## Celah Saat Ini & Langkah Berikutnya
- Beberapa route mengharapkan view (`blog`, `booking`, `contact`, `about`) tetapi belum tersedia. Prioritaskan pembuatan template tersebut atau pindahkan ke controller dinamis.
- Ekstraksi markup hero ke `resources/views/components/sections/hero.blade.php` akan mengurangi duplikasi dan memungkinkan reuse di `branda` serta `services-components`.
- Setelah menambah interaktivitas, pertimbangkan penggunaan controller, Laravel Livewire, atau Inertia untuk UI yang lebih dinamis.

## Rekomendasi Pembelajaran untuk Pendatang Baru
- **Dasar Laravel:** routing, controller, Blade component, dan lifecycle request.
- **Tailwind utility:** pahami pola utility untuk memperluas sistem desain.
- **Workflow build & deployment:** kuasai `npm run dev`, `npm run build`, `php artisan serve`, dan script Composer `dev`.
- **Testing:** mulai dengan feature test untuk halaman yang ada dan rencanakan test formulir/booking ketika backend siap.
