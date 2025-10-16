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

// Alias lama /booking → arahkan ke daftar layanan (biar link lama tetap hidup)
Route::get('/booking', fn () => redirect()->route('services.index'))->name('booking');

/*
|--------------------------------------------------------------------------
| PROTECTED (wajib login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [LogoutController::class, 'destroy'])->name('logout');

    // Beranda utama setelah login
    Route::view('/branda', 'branda')->name('branda');

    // Services
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/{service:slug}', [ServiceController::class, 'show'])->name('services.show');

    // Booking
    Route::get('/services/{service:slug}/booking', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/services/{service:slug}/booking', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/services/{service:slug}/thanks', [BookingController::class, 'thanks'])->name('bookings.thanks');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/add/{service:slug}', [CartController::class, 'add'])->name('cart.add.slug'); // kompatibilitas lama (opsional)
    Route::patch('/cart/item/{id}', [CartController::class, 'updateQty'])->name('cart.update');
    Route::delete('/cart/item/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

    // Static pages (kita kunci agar hanya user login yang bisa akses)
    Route::view('/blog', 'blog')->name('blog');
    Route::view('/contact', 'contact')->name('contact');
});

// (Opsional) Fallback 404 kustom
// Route::fallback(fn () => response()->view('errors.404', [], 404));
