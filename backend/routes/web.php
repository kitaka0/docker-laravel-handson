<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Home画面(Trend)
Route::get('/',[PostController::class,'trend']);
// 記事詳細画面
Route::get('/posts/{post}',[PostController::class,'postDetail'])->where('post','[0-9]+');
// 投稿画面
Route::get('/posts/create',[PostController::class,'create']);
// 投稿処理
Route::post('/posts',[PostController::class,'store']);

// user詳細画面
Route::get('/users/{user_id}',[UserController::class,'userProfile'])->where('user_id','[0-9]+');

// follow処理
Route::post('/follow',[FollowController::class,'follow']);
// unfollow処理
Route::post('/unfollow',[FollowController::class,'unFollow']);


