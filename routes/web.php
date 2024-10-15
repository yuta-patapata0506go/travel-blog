<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


