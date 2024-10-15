<?php

use Illuminate\Support\Facades\Route;



Route::get('/events', function () {
    return view('display.events');
});

Route::get('/tourism', function () {
    return view('display.tourism');
});

Route::get('/events-tourism', function () {
    return view('display.events-tourism');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
