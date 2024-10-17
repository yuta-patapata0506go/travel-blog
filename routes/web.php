<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Home Route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Events and Tourism Routes
Route::get('/events', function () {
    return view('display.events');
});

Route::get('/tourism', function () {
    return view('display.tourism');
});

Route::get('/events-tourism', function () {
    return view('display.events-tourism');
});
// My Page Routes
Route::get('/mypage-show', function () {
    return view('mypage.mypage-show');
});
Route::get('/mypage-edit', function () {
    return view('mypage.mypage-edit');
});
Route::get('/mypage-following', function () {
    return view('mypage.mypage-following');
});
Route::get('/mypage-followers', function () {
    return view('mypage.mypage-followers');
});
Route::get('/mypage-favorite', function () {
    return view('mypage.mypage-favorite');
});

Route::get('/navbar', function () {
    return view('navbar');
});

Route::get('/mappage', function () {
    return view('map_page/map');
});

Route::get('/footer', function () {
    return view('footer');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/spot', function () {
    return view('spot');
});


// Admin　Routes
Route::get('/admin/inquiries/create_reply', function () {
    return view('admin/inquiries/create_reply');
});

Route::get('/admin/inquiries/inquiry_details', function () {
    return view('admin/inquiries/inquiry_details');
});

Route::get('/select-post-form', function () {
    return view('select-post-form');
});

Route::get('/spot-post-form', function () {
    return view('spot-post-form');
});

Route::get('/event-post-form', function () {
    return view('event-post-form');
});

Route::get('/tourism-post-form', function () {
    return view('tourism-post-form');
});

Route::get('/edit-event-post', function () {
    return view('edit-event-post');
});

Route::get('/edit-tourism-post', function () {
    return view('edit-tourism-post');
});

// Authentication Routes
Auth::routes();
