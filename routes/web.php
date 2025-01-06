<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogDetailController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\YoutubeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomePageController::class, 'index'])->name('/');
Route::get('/blogs', [ArticleController::class, 'index'])->name('blogs');

Route::get('/konsultasi', function(){
    return view('konsultasi-page');
})->name('konsultasi');

Route::get('/tentang-pokarez', function(){
    abort(404);
})->name('tentang-pokarez');

Route::get('/dashboard/youtube/auth/google', [YoutubeController::class, 'authenticate']);
Route::get('/dashboard/youtube/callback', [YoutubeController::class, 'callback']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('dashboard', BlogController::class)
        ->names([
            'index' => 'admin.blogs.index',
            'create' => 'admin.blogs.create',
            'store' => 'admin.blogs.store',
            'edit' => 'admin.blogs.edit',
            'update' => 'admin.blogs.update',
            'destroy' => 'admin.blogs.destroy',
        ])
        ->parameters(['dashboard' => 'post']);
});

Route::middleware('auth')->group(function () {
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });
});

require __DIR__.'/auth.php';

Route::get('/{slug}', [BlogDetailController::class,'detail'])->name('blog-detail');