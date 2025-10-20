<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentWebhookController;

/*
|--------------------------------------------------------------------------
| PUBLIC (tidak perlu login)
|--------------------------------------------------------------------------
*/

// Halaman pembuka (landing)
Route::get('/', fn () => view('home'))->name('home');

// Auth: hanya bisa diakses tamu (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);

    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

// Webhook pembayaran (dipanggil oleh Midtrans)
Route::post('/payment/midtrans/callback', [PaymentWebhookController::class, 'midtrans'])
    ->name('payment.midtrans.callback');
// PUBLIC payment result pages
Route::view('/payment/success', 'payments.success')->name('payment.success');
Route::view('/payment/failed',  'payments.failed')->name('payment.failed');

// Alias lama /booking → arahkan ke daftar layanan (biar link lama tetap hidup)
Route::get('/booking', fn () => redirect()->route('services.index'))->name('booking');


/*
|--------------------------------------------------------------------------
| PROTECTED (wajib login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    |-------------------------
    | Auth & Dashboard
    |-------------------------
    */
    Route::post('/logout', [LogoutController::class, 'destroy'])->name('logout');
    Route::view('/branda', 'branda')->name('branda');

    /*
    |-------------------------
    | Services
    |-------------------------
    */
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/{service:slug}', [ServiceController::class, 'show'])->name('services.show');

    /*
    |-------------------------
    | Booking
    |-------------------------
    */
    Route::get('/services/{service:slug}/booking', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/services/{service:slug}/booking', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/services/{service:slug}/thanks', [BookingController::class, 'thanks'])->name('bookings.service.thanks');

    /*
    |-------------------------
    | Cart
    |-------------------------
    */
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/add/{service:slug}', [CartController::class, 'add'])->name('cart.add.slug'); // kompatibilitas lama (opsional)

    // Update qty item (dipakai untuk "Update" atau stepper qty)
    Route::patch('/cart/item/{id}', [CartController::class, 'updateQty'])->name('cart.update');

    // (Opsional) Hapus item & kosongkan cart (walau di UI kita sembunyikan tombol hapus)
    Route::delete('/cart/item/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');

    /*
    |-------------------------
    | Checkout (Modern)
    |-------------------------
    | - index/store: alur checkout standar
    | - apply-coupon: terapkan kupon (percent/flat) → simpan di session
    | - apply-tips  : set tips (rate 0/5/10% atau nominal custom) → simpan di session
    */
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    // Tambahan fitur modern (sesuai yang kamu minta)
    Route::post('/checkout/apply-coupon', [CheckoutController::class, 'applyCoupon'])->name('checkout.applyCoupon');
    Route::post('/checkout/apply-tips',   [CheckoutController::class, 'applyTips'])->name('checkout.applyTips');

    // Halaman selesai/terima kasih
    Route::view('/thanks', 'bookings.thanks')->name('bookings.thanks');

    /*
    |-------------------------
    | Static pages
    |-------------------------
    | Dikunci agar hanya user login yang bisa akses
    */
    Route::view('/blog', 'blog')->name('blog');
    Route::view('/contact', 'contact')->name('contact');
});

// (Opsional) Fallback 404 kustom
// Route::fallback(fn () => response()->view('errors.404', [], 404));
