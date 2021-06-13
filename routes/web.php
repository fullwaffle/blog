<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

require __DIR__.'/auth.php';

Route::get('/', [PostController::class, 'index'])->name('home');
Route::resource('posts', PostController::class)->except('index');
Route::get('posts/category/{category}', [PostController::class, 'sortByCategory'])->name('posts.sortByCategory');

Route::resource('comments', CommentController::class);
Route::post('/reply/store', [CommentController::class, 'replyStore'])->name('reply.add');

Route::get('/search', [SearchController::class, 'searchByPosts'])->name('searchByPosts');
