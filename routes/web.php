<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentWebhookController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('services.index'))->name('home');

Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{service:slug}/booking', [BookingController::class, 'create'])->name('bookings.create');
Route::post('/services/{service:slug}/booking', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/services/{service:slug}/thanks', [BookingController::class, 'thanks'])->name('bookings.thanks');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/item/{id}', [CartController::class, 'updateQty'])->name('cart.update');
Route::delete('/cart/item/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');

Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

Route::post('/payment/midtrans/callback', [PaymentWebhookController::class, 'midtrans'])->name('payment.midtrans.callback');

Route::view('/blog', 'blog')->name('blog');
Route::view('/booking', 'booking')->name('booking');
Route::view('/contact', 'contact')->name('contact');
Route::view('/about', 'about')->name('about');
Route::view('/branda', 'branda')->name('branda');
Route::view('/home', 'home');
Route::view('/services-components', 'services-components');



