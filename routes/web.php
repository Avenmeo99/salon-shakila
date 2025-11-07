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

// ------------------- PUBLIC -------------------
Route::get('/', fn () => view('home'))->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

Route::post('/payment/midtrans/callback', [PaymentWebhookController::class, 'midtrans'])
    ->name('payment.midtrans.callback');

Route::get('/booking', fn () => redirect()->route('services.index'))->name('booking');

// ------------------- PROTECTED -------------------
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LogoutController::class, 'destroy'])->name('logout');
    Route::view('/branda', 'branda')->name('branda');

    // Services
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/{service:slug}', [ServiceController::class, 'show'])->name('services.show');

    // Booking -> keranjang (single cart)
    Route::get('/services/{service:slug}/booking', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/services/{service:slug}/booking', [BookingController::class, 'store'])->name('bookings.store');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/add/{service:slug}', [CartController::class, 'add'])->name('cart.add.slug');
    Route::patch('/cart/item/{id}', [CartController::class, 'updateQty'])->name('cart.update');
    Route::delete('/cart/item/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    Route::post('/checkout/apply-coupon', [CheckoutController::class, 'applyCoupon'])->name('checkout.applyCoupon');
    Route::post('/checkout/apply-tips',   [CheckoutController::class, 'applyTips'])->name('checkout.applyTips');

    Route::view('/thanks', 'bookings.thanks')->name('bookings.thanks');
    Route::view('/blog', 'blog')->name('blog');
    Route::view('/contact', 'contact')->name('contact');

    // ------------------- ADMIN -------------------
    Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::view('/', 'admin.dashboard')->name('dashboard');

        // Services CRUD
        Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);

        // Bookings
        Route::get('bookings', [\App\Http\Controllers\Admin\BookingController::class,'index'])->name('bookings.index');
        Route::get('bookings/{id}', [\App\Http\Controllers\Admin\BookingController::class,'show'])->name('bookings.show');
        Route::patch('bookings/{id}/status', [\App\Http\Controllers\Admin\BookingController::class,'updateStatus'])->name('bookings.updateStatus');

        // Orders
        Route::get('orders', [\App\Http\Controllers\Admin\OrderController::class,'index'])->name('orders.index');
        Route::get('orders/{id}', [\App\Http\Controllers\Admin\OrderController::class,'show'])->name('orders.show');
        Route::patch('orders/{id}/status', [\App\Http\Controllers\Admin\OrderController::class,'updateStatus'])->name('orders.updateStatus');
    });
});
