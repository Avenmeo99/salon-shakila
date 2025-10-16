<?php

use Illuminate\Support\Facades\Route;

// Halaman Welcome (default)
Route::get('/', function () {
    return view('home'); 
})->name('home');

// Homepage dengan komponen
Route::get('/branda', function () {
    return view('branda');
})->name('branda');

// Services dengan komponen
Route::get('/layanan', function () {
    return view('services-components');
})->name('services');

Route::get('/blog', function () {
    return view('blog');
})->name('blog');

Route::get('/booking', function () {
    return view('booking');
})->name('booking');

Route::get('/kontak', function () {
    return view('contact');
})->name('contact');

Route::get('/tentang', function () {
    return view('about');
})->name('about');



