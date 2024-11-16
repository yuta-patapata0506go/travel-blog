<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PostController;
// Add the route to search events by date
Route::get('/events/search', [EventController::class, 'searchByDate'])->name('events.search');

// Route::middleware('auth')->group(function () {
//     Route::post('/post/{id}/like', [PostController::class, 'like'])->name('post.like');
//     Route::post('/post/{id}/favorite', [PostController::class, 'favorite'])->name('post.favorite');
// });
