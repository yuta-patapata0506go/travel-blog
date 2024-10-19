<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Home Route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Events and Tourism Routes
Route::get('/events', function () {
    return view('display.events');
});

Route::get('/admin-users-index', function () {
    return view('admin/users/users-index');
});

Route::get('/admin-posts-index', function () {
    return view('/admin/posts/posts-index');
});

Route::get('/admin-spots-index', function () {
    return view('/admin/spots/spots-index');
});

Route::get('/admin-categories-index', function () {
    return view('/admin/categories/categories-index');
});

Route::get('/admin-inquiries-index', function () {
    return view('/admin/inquiries/inquiries-index');
});

Route::get('/admin-spot_applications-index', function () {
    return view('/admin/spot_applications/spot_applications-index');
});

Route::get('/admin-update_category', function () {
    return view('/admin/modals/update_category');
});

Route::get('/admin-create_category', function () {
    return view('/admin/modals/create_category');
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
    return view('admin.spot_applications.allowCreate');
});

Route::get('/admin-update-spot', function () {
    return view('admin.spots.update');
});

Route::get('/admin-create-spot', function () {
    return view('admin.spots.create');
});

Route::get('/admin-users-index', function () {
    return view('admin/users/users-index');
});

Route::get('/admin-posts-index', function () {
    return view('/admin/posts/posts-index');
});

Route::get('/admin-spots-index', function () {
    return view('/admin/spots/spots-index');
});

Route::get('/admin-categories-index', function () {
    return view('/admin/categories/categories-index');
});

Route::get('/admin-inquiries-index', function () {
    return view('/admin/inquiries/inquiries-index');
});

Route::get('/admin-spot_applications-index', function () {
    return view('/admin/spot_applications/spot_applications-index');
});

Route::get('/admin-update_category', function () {
    return view('/admin/modals/update_category');
});

Route::get('/admin-create_category', function () {
    return view('/admin/modals/create_category');
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

<<<<<<< HEAD
// Authentication Routes
=======

>>>>>>> 5949b5f35bdfe2011180741503196236e5bd5715
Auth::routes();
