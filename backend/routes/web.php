<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;

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
Route::get('/',[PostController::class,'newArrive'])->name('newArrive');
// タイムライン画面
Route::get('/timeline',[PostController::class,'timeline'])->name('timeline');
// ランキング画面
Route::get('/ranking',[PostController::class,'ranking'])->name('ranking');

// 記事詳細画面
Route::get('/posts/{post_id}',[PostController::class,'postDetail'])->where('post_id','[0-9]+')->name('postDetail');
// 投稿画面
Route::get('/posts/create',[PostController::class,'create']);
// 投稿処理
Route::post('/posts',[PostController::class,'store'])->name('postStore');
// 編集画面
Route::get('/posts/{post_id}/edit',[PostController::class,'postEdit'])->where('post_id','[0-9]+')->name('postEdit');
// アップデート処理
Route::post('/posts/update',[PostController::class,'postUpdate'])->name('postUpdate');
// post削除処理
Route::delete('/posts/{post_id}',[PostController::class,'postDelete'])->where('post_id','[0-9]+')->name('postDelete');

// user詳細画面
Route::get('/users/{user_id}',[UserController::class,'userProfile'])->where('user_id','[0-9]+')->name('userProfile');
// フォロー一覧画面
Route::get('/users/{user_id}/following',[UserController::class,'following'])->where('user_id','[0-9]+')->name('following');
// フォロワー一覧画面
Route::get('/users/{user_id}/followers',[UserController::class,'followers'])->where('user_id','[0-9]+')->name('followers');
// いいね一覧
Route::get('/users/{user_id}/likes',[UserController::class,'likes'])->where('user_id','[0-9]+')->name('likes');


// follow処理
Route::post('/follow',[FollowController::class,'follow']);
// unfollow処理
Route::post('/unfollow',[FollowController::class,'unFollow']);

// コメント投稿処理
Route::post('/comments/post',[CommentController::class,'commentPost']);
// コメント編集処理
Route::post('/comments/{comment_id}/edit',[CommentController::class,'commentEdit'])->where('user_id','[0-9]+')->name('commentEdit');
// コメント削除処理
Route::post('/comments/delete',[CommentController::class,'commentDelete'])->name('commentDelete');

// いいね処理
Route::post('/like',[LikeController::class,'like']);
// いいね解除
Route::post('/unlike',[LikeController::class,'unlike']);


