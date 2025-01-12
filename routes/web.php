<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\BlogDetailController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ConsultationController;

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

Route::get('/konsultasi', [ConsultationController::class, 'index'])->name('konsultasi');
Route::post('/konsultasi', [ConsultationController::class, 'sendWhatsApp'])->name('send.whatsapp');

Route::get('/blogs/artikel', [ArticleController::class, 'showArticles'])->name('blogs.articles-page');
Route::get('/blogs/video', [ArticleController::class, 'showVideos'])->name('blogs.videos-page');

Route::get('/login/google/redirect', [GoogleController::class, 'redirect']);
Route::get('/login/google/callback', [GoogleController::class, 'callback']);

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
    Route::resource('profile', ProfileController::class)->names([
        'edit' => 'admin.profile.edit',
        'update' => 'admin.profile.update',
        'destroy' => 'admin.profile.destroy',
    ]);
});

require __DIR__.'/auth.php';

Route::get('/{slug}', [BlogDetailController::class,'detail'])->name('blogs.detail.blog-detail');