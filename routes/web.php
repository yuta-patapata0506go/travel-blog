<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\SpotController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostImageController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\Admin\InquiriesController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\Admin\ResponsesController;

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

// admin category feature
Route::get('/admin-categories-index',[CategoryController::class,'index'])->name('admin.categories.index');
Route::post('/admin-categories-store',[CategoryController::class,'store'])->name('admin.categories.store');

Route::get('/admin-categories-edit/{id}',[CategoryController::class,'edit'])->name('admin.categories.edit');

Route::patch('/admin-categories-update/{id}',[CategoryController::class,'update'])->name('admin.categories.update');
Route::patch('/admin/categories/{id}/changeVisibility', [CategoryController::class, 'changeVisibility'])->name('admin.categories.changeVisibility');



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

Route::get('/mypage-show/{id}',[ProfileController::class,'show'])->name('profile.show');  //mypage-showに遷移

Route::get('/mypage-edit',[ProfileController::class,'edit'])->name('profile.edit');  //editページに遷移
Route::patch('/mypage-edit/update',[ProfileController::class,'update'])->name('profile.update');  //profile update   
Route::get('/mypage-following/{id}',[ProfileController::class,'following'])->name('profile.following'); //mypage-followingに遷移
Route::get('/mypage-followers/{id}',[ProfileController::class,'followers'])->name('profile.followers'); //mypage-followersに遷移
Route::post('/follow/store/{user_id}',[FollowController::class,'store'])->name('follow.store'); //follow other users
Route::delete('/Follow/destroy/{user_id}',[FollowController::class,'destroy'])->name('follow.destroy'); //unforrow
Route::get('/mypage-favorite',[ProfileController::class,'favorite'])->name('profile.favorite');//mypage-favoriteに遷移



Route::get('/navbar', function () {
    return view('navbar');
});

// Map
// HTMLの表示用ルート(Route for displaying HTML)
Route::get('/map', [MapController::class, 'showMapPage'])->name('map.page');

// スポット情報のJSON取得用ルート(Route for retrieving spot information in JSON)
Route::get('/api/map', [MapController::class, 'index'])->name('map.index');
// Route::get('/mappage', function () {
//     return view('map_page/map');
// });

Route::get('/footer', function () {
    return view('footer');
});

// contact
Route::group(['middleware' => 'auth'], function () {
    Route::get('/contact/create', [ContactController::class, 'create'])->name('contact.create');
    Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');
});

Route::get('/about', function () {  
    return view('about');
})->name('about');


//Spot
Route::group(['prefix' => 'spot', 'as' => 'spot.'], function() {
    Route::get('create', [SpotController::class, 'create'])->name('create');
    Route::post('store', [SpotController::class, 'store'])->name('store'); 
    Route::get('{id}', [SpotController::class, 'show'])->name('show'); 
    
    // Like のルート
    Route::post('{id}/like', [SpotController::class, 'like'])->name('like');
    // Favorite のルート
    Route::post('{id}/favorite', [SpotController::class, 'favorite'])->name('favorite');

});




// Admin　Routes
Route::group(['middleware' => 'auth'], function () {
    // Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function(){
        Route::group(['prefix' => 'admin/inquiries', 'as' => 'admin.inquiries.'], function() { // /admin/inquiries
            Route::get('/', [InquiriesController::class, 'index'])->name('index'); 
            Route::get('/{id}/inquiry_details', [InquiriesController::class, 'show'])->name('inquiry_details');
            Route::patch('/{id}/change-visibility', [InquiriesController::class, 'changeVisibility'])->name('changeVisibility');
            Route::post('/{id}/change-status', [InquiriesController::class, 'changeStatus'])->name('changeStatus');
        });

        Route::group(['prefix' => 'admin/inquiries', 'as' => 'admin.inquiries.'], function() { // /admin/inquiries
            Route::get('/{id}/create_reply', [ResponsesController::class, 'create'])->name('create_reply');
            Route::post('/{id}/reply', [ResponsesController::class, 'store'])->name('reply');
        });
    // });
});


Route::get('/admin/inquiries/create_reply', function () {
    return view('admin/inquiries/create_reply');
});

Route::get('/admin/inquiries/inquiry_details', function () {
    return view('admin/inquiries/inquiry_details');
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

Route::get('/admin-users-index', [UsersController::class, 'index'])->name('admin.users.index');
Route::patch('/admin-users-unhide/{id}', [UsersController::class, 'unhide'])->name('admin.users.unhide');
Route::delete('/admin-users-hide/{id}', [UsersController::class, 'hide'])->name('admin.users.hide');


Route::get('/admin-posts-index', function () {
    return view('/admin/posts/posts-index');
});

Route::get('/admin-spots-index', function () {
    return view('/admin/spots/spots-index');
});


// Route::get('/admin-inquiries-index', function () {
//     return view('/admin/inquiries/inquiries-index');
// });

Route::get('/admin-spot_applications-index', function () {
    return view('/admin/spot_applications/spot_applications-index');
});

Route::get('/admin-update_category', function () {
    return view('/admin/modals/update_category');
});


Route::get('/admin-create_category', function () {
    return view('/admin/modals/create_category');
});



//  post-form
Route::get('/select-post-form', function () {
    return view('select-post-form');
})->name('select-post-form');


// Authentication Routes

Auth::routes();
// POST routes
Route::group(["middleware"=> "auth"], function(){

    Route::group(['prefix' => 'post', 'as' =>'post.'],function(){
        Route::get('create/{type}', [PostController::class, 'create'])->name('create');
        Route::post('store', [PostController::class, 'store'])->name('store');
        Route::get('show/{id}', [PostController::class, 'show'])->name('show');
        Route::get('edit/{id}', [PostController::class, 'edit'])->name('edit');
        Route::patch('update/{id}', [PostController::class, 'update'])->name('update');
        Route::delete('destroy/{id}', [PostController::class, 'destroy'])->name('destroy');
        Route::post('{id}/like', [PostController::class, 'like'])->name('like');
        Route::post('{id}/favorite', [PostController::class, 'favorite'])->name('favorite');
    
       });

       
 });

 // コメントの保存ルート (POST)
Route::post('post/{id}/comment', [CommentController::class, 'store'])->name('comment.store');
Route::delete('comment/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');

// コメントの保存ルート (SPOT)
Route::post('spot/{id}/comment', [CommentController::class, 'store'])->name('spot.comment.store');
Route::delete('comment/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');


// Serch function
Route::get('/search', [SearchController::class, 'search'])->name('search');
