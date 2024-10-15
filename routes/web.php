<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts-event-post', function () {
    return view('posts.event-post');
});
Route::get('/posts-tourism-post', function () {
    return view('posts.tourism-post');
});

Route::get('/posts-modal-post-delete', function () {
    return view('posts.modal-post-delete');
});


Route::get('/admin-allow-spot', function () {
    return view('admin.allow-spot');
});

Route::get('/admin-update-spot', function () {
    return view('admin.update-spot');
});

Route::get('/admin-create-spot', function () {
    return view('admin.create-spot');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
