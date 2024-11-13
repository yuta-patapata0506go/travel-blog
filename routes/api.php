<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
// Add the route to search events by date
Route::get('/events/search', [EventController::class, 'searchByDate'])->name('events.search');