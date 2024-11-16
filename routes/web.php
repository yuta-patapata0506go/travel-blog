<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\SpotController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\Admin\InquiriesController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\Admin\ResponsesController;
use App\Http\Controllers\Admin\RecommendationsController;
use App\Http\Controllers\Admin\SpotApplicationsController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TourismController;
use App\Http\Controllers\Admin\SpotsController;
use App\Http\Controllers\Admin\PostsController;


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


// Routes for Map Page

// ユーザーの緯度経度をセッションに保存するルート
Route::post('/save-location', [MapController::class, 'saveLocation'])->name('save.location');
// HTMLの表示用ルート(Route for displaying HTML) *Use this route to display the map page
Route::get('/map', [MapController::class, 'showMapPage'])->name('map.page');
// スポット情報のJSON取得用ルート(Route for retrieving spot information in JSON)
Route::get('/api/map', [MapController::class, 'index'])->name('map.index');



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

/*Route::get('/spot-post-form', function () {
    return view('spot-post-form');
});*/


// Recommendation Route
Route::group(['prefix' => 'recommendation', 'as' => 'recommendation.'], function() {
    Route::get('/', [RecommendationController::class, 'showRecommendations'])->name('showRecommendations');
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

        Route::group(['prefix' => 'admin/recommendations', 'as' => 'admin.recommendations.'], function() { // /admin/recommendations
            Route::get('/modal', [RecommendationsController::class, 'showModal'])->name('modal');
            Route::patch('/save', [RecommendationsController::class, 'saveRecommendations'])->name('save');
        });

        Route::group(['prefix' => 'admin/spot_applications', 'as' => 'admin.spot_applications.'], function() { 
            Route::get('/', [SpotApplicationsController::class, 'index'])->name('index');
            Route::post('/{id}/update-status', [SpotApplicationsController::class, 'updateStatus'])->name('updateStatus');
        });

        Route::group(['prefix' => 'admin/spots', 'as' => 'admin.spots.'], function() { 
            Route::get('/', [SpotsController::class, 'index'])->name('index');
            Route::get('/create', [SpotsController::class, 'create'])->name('create');
            Route::post('/store', [SpotsController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [SpotsController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [SpotsController::class, 'update'])->name('update');
            Route::post('/{id}/status', [SpotsController::class, 'changeStatus'])->name('changeStatus');
            Route::delete('/delete-spot/{id}', [SpotsController::class, 'deleteSpot'])->name('deleteSpot');

        });

        Route::group(['prefix' => 'admin/posts', 'as' => 'admin.posts.'], function() { // /admin/posts
            Route::get('/', [PostsController::class, 'index'])->name('index');
            Route::patch('/unhide/{id}', [PostsController::class, 'unhide'])->name('unhide');
            Route::delete('/hide/{id}', [PostsController::class, 'hide'])->name('hide');
            
        });

        Route::group(['prefix' => 'admin/categories', 'as' => 'admin.categories.'], function() { 
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::post('/store',[CategoryController::class,'store'])->name('store');
            Route::patch('/update/{id}',[CategoryController::class,'update'])->name('update');
            Route::patch('/{id}/changeVisibility', [CategoryController::class, 'changeVisibility'])->name('changeVisibility');
        });

        Route::group(['prefix' => 'admin/users', 'as' => 'admin.users.'], function() { 
            Route::get('/', [UsersController::class, 'index'])->name('index');
            Route::patch('/unhide/{id}', [UsersController::class, 'unhide'])->name('unhide');
            Route::delete('/hide/{id}', [UsersController::class, 'hide'])->name('hide');
        });
    // });
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
        Route::post('store', action: [PostController::class, 'store'])->name('store');
        Route::get('show/{id}', [PostController::class, 'show'])->name('show');
        Route::get('edit/{id}', [PostController::class, 'edit'])->name('edit');
        Route::patch('update/{id}', [PostController::class, 'update'])->name('update');
        Route::delete('destroy/{id}', [PostController::class, 'destroy'])->name('destroy');
        Route::post('{id}/like', [PostController::class, 'like'])->name('like');
        Route::post('{id}/favorite', [PostController::class, 'favorite'])->name('favorite');
       });
 });

// Search Routes
Route::get('/search', [SearchController::class, 'index'])->name('search');




// Serch function
//Route::get('/search', [SearchController::class, 'search'])->name('search');


 Route::get('/{type}/{id}', [CommentController::class, 'show'])->name('comment.show');
 Route::post('/comment/store/{id}', [CommentController::class, 'store'])->name('comment.store');
 Route::delete('/comment/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');
 


 
//Serch function
Route::get('/search', [SearchController::class, 'search'])->name('search');
