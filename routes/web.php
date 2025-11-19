<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController; 
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Beranda (MENGGUNAKAN CONTROLLER, BUKAN CLOSURE)
Route::get('/', [PageController::class, 'home'])->name('home');

// 2. Profil UKM
Route::get('/struktur', [PageController::class, 'structure'])->name('structure');
Route::get('/sejarah', [PageController::class, 'history'])->name('profile.history');
Route::get('/program-kerja', [PageController::class, 'programs'])->name('profile.programs');

// 3. Berita & Kegiatan
Route::get('/berita', [PageController::class, 'posts'])->name('posts.index');
Route::get('/berita/{post:slug}', [PageController::class, 'post'])->name('post.show');

// 4. Redirect Login ke Admin
Route::get('/login', function () {
    return redirect('/admin/login');
})->name('login');