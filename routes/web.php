<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('posts', PostController::class);
Route::resource('like', LikeController::class)->only(['index', 'store', 'destroy']);
Route::resource('follows', FollowController::class)->only(['index', 'store', 'destroy']);
Route::get('/follower',[FollowController::class, 'followerindex']);

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('comments', CommentController::class)->only('store', 'destroy');
Route::get('/posts/{post}/edit_image', [PostController::class, 'editImage'])->name('posts.edit_image');
Route::patch('/posts/{post}/edit_image', [PostController::class, 'updateImage'])->name('posts.update_image');