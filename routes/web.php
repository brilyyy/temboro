<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CkEditorController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/tag/{slug}', [PostController::class, 'postsByTag'])->name('posts.by.tag');
Route::get('/post/{slug}/{postSlug}', [PostController::class, 'showPost'])->name('post.show');

Route::get('dashboard/login', [PagesController::class, 'login'])->name('login.admin');


Route::get('dashboard', [PagesController::class, 'indexAdmin'])->name('home.admin');
Route::post('dashboard/login/auth', [AuthController::class, 'login'])->name('login.service');
Route::get('dashboard/logout', [AuthController::class, 'logout'])->name('logout.service');

Route::middleware(['auth', 'role:super-admin'])->group(function () {
    Route::get('dashboard/post/', [PostController::class, 'allPosts'])->name('all.post');
    Route::get('dashboard/post/create', [PostController::class, 'createPost'])->name('create.post');
    Route::post('dashboard/post/create/service', [PostController::class, 'create'])->name('create.post.service');
});
