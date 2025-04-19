<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;
use Illuminate\Routing\Route as RoutingRoute;

// PAGE ROUTES
Route::get('/', [authController::class, "showDynamicHomepage"])->name('login');
Route::get('/create-post', [BlogController::class, "createPostForm"])->middleware('auth');
Route::get('/edit-post/{post_id}', [BlogController::class, "editPostForm"])->middleware('auth')->middleware('can:update,post_id');



// AUTH POST ROUTES
Route::post('/register', [authController::class, "register"])->middleware('guest')->name('register');
Route::post('/login', [authController::class, "login"])->middleware('guest');
Route::post('/logout', [authController::class, "logout"])->middleware('auth')->name('logout');


//BLOG ROUTES
Route::post('/create-post', [BlogController::class, "createPost"])->middleware('auth');
Route::get('/posts/{post_id}', [BlogController::class, "showPost"]);
// Route::get('/posts', [BlogController::class, "showPosts"]);
// Route::get('/edit-post/{id}', [BlogController::class, "editPostForm"]);
Route::put('/update-post/{post_id}', [BlogController::class, "updatePost"])->middleware('can:update,post_id');
Route::delete('/post/{post_id}', [BlogController::class, "deletePost"])->middleware('can:delete,post_id');
Route::get('/search/{term}', [BlogController::class, "search"]);


//PROFILE ROUTES
Route::get('/profile/{user_id}', [UserController::class, 'profile'])->middleware('auth');
Route::get('/profile/{user_id}/followers', [UserController::class, 'getFollowers'])->middleware('auth');
Route::get('/profile/{user_id}/following', [UserController::class, 'getFollowing'])->middleware('auth');
Route::get('/upload/photo', [UserController::class, 'uploadPhotoForm'])->middleware('auth');
Route::post('/upload/photo', [UserController::class, 'uploadPhoto'])->middleware('auth');

// follow routes
Route::post('/create/follow/{user:username}', [FollowController::class, 'createFollow'])->middleware('auth');
Route::post('/remove/follow/{user:username}', [FollowController::class, 'removeFollow'])->middleware('auth');



//ADMIN ROUTES
Route::get('/admin', function () {
    return view('adminDashboard');
})->middleware('can:seeAdminPages');
