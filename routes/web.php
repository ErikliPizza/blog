<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthorController;
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
Route::get('posts/{post:slug}', [PostController::class, 'show']);


// show author
Route::get('/author/{user:username}', [AuthorController::class, 'index']);
Route::get('/foo', function () {
$targetFolder = $_SERVER['DOCUMENT_ROOT'].'/storage/app/public';
$linkFolder = $_SERVER['DOCUMENT_ROOT'].'/storage';
symlink($targetFolder,$linkFolder);
echo 'Symlink process successfully completed';
});

// slide manager
Route::get('/dashboard/admin/sliders', [SliderController::class, 'create'])->middleware('can:admin')->name('manage-sliders');
Route::post('/dashboard/admin/sliders', [SliderController::class, 'store'])->middleware('can:admin');
Route::patch('/dashboard/admin/sliders/{slider}/edit', [SliderController::class, 'update'])->middleware('can:admin');
Route::delete('/dashboard/admin/sliders/{slider}/edit', [SliderController::class, 'destroy'])->middleware('can:admin');


// post manager
Route::get('/dashboard/admin/posts', [AdminPostController::class, 'create'])->middleware('can:admin')->name('manage-posts');
Route::post('/dashboard/admin/posts', [AdminPostController::class, 'store'])->middleware('can:admin');
Route::get('/dashboard/admin/{post}/edit', [AdminPostController::class, 'edit'])->middleware('can:admin');
Route::patch('/dashboard/admin/{post}/edit', [AdminPostController::class, 'update'])->middleware('can:admin');
Route::delete('/dashboard/admin/{post}/edit', [AdminPostController::class, 'destroy'])->middleware('can:admin');

// category manager
Route::get('/dashboard/admin/categories', [CategoriesController::class, 'create'])->middleware('can:admin')->name('categories');
Route::post('/dashboard/admin/categories', [CategoriesController::class, 'store'])->middleware('can:admin');
Route::patch('/dashboard/admin/categories', [CategoriesController::class, 'update'])->middleware('can:admin');
Route::delete('/dashboard/admin/categories', [CategoriesController::class, 'destroy'])->middleware('can:admin');

// comment manager
Route::post('posts/{post:slug}/comments', [CommentController::class, 'store'])->middleware('auth', 'verified');
Route::delete('posts/comments/delete', [CommentController::class, 'destroy'])->middleware('auth', 'verified');


Route::middleware('auth', 'verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
