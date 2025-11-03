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
| PUBLIC
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => view('home'))->name('home');

// Auth (guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);

    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

// Midtrans webhook (tanpa CSRF) → pastikan di VerifyCsrfToken $except
Route::post('/payment/midtrans/callback', [PaymentWebhookController::class, 'midtrans'])
    ->name('payment.midtrans.callback');

// Alias lama
Route::get('/booking', fn () => redirect()->route('services.index'))->name('booking');

/*
|--------------------------------------------------------------------------
| PROTECTED (login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Dashboard/Logout
    Route::post('/logout', [LogoutController::class, 'destroy'])->name('logout');
    Route::view('/branda', 'branda')->name('branda');

    // Services
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/{service:slug}', [ServiceController::class, 'show'])->name('services.show');

    // Booking
Route::get('/services/{service:slug}/booking', [\App\Http\Controllers\BookingController::class, 'create'])
    ->name('bookings.create');
Route::post('/services/{service:slug}/booking', [\App\Http\Controllers\BookingController::class, 'store'])
    ->name('bookings.store');


    // Cart (satu keranjang saja)
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'add'])->name('cart.add'); // mode pemesanan biasa
    Route::post('/cart/add/{service:slug}', [CartController::class, 'add'])->name('cart.add.slug');
    Route::patch('/cart/item/{id}', [CartController::class, 'updateQty'])->name('cart.update');
    Route::delete('/cart/item/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');

    // Checkout (satu alur)
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    // Kupon & Tips (opsional)
    Route::post('/checkout/apply-coupon', [CheckoutController::class, 'applyCoupon'])->name('checkout.applyCoupon');
    Route::post('/checkout/apply-tips',   [CheckoutController::class, 'applyTips'])->name('checkout.applyTips');

    // Thanks & pages
    Route::view('/thanks', 'bookings.thanks')->name('bookings.thanks');
    Route::view('/blog', 'blog')->name('blog');
    Route::view('/contact', 'contact')->name('contact');
});
