<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// =========================================================================
// 1. HALAMAN PUBLIK
// =========================================================================

Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/struktur', [PageController::class, 'structure'])->name('structure');
Route::get('/sejarah', [PageController::class, 'history'])->name('profile.history');
Route::get('/program-kerja', [PageController::class, 'programs'])->name('profile.programs');

Route::get('/berita', [PageController::class, 'posts'])->name('posts.index');
Route::get('/berita/{post:slug}', [PageController::class, 'post'])->name('post.show');


// =========================================================================
// 2. KEAMANAN: Redirect Sisa Auth Bawaan ke Landing Page
// =========================================================================

// Jika ada yang akses /login, lempar ke Home (Landing Page)
Route::get('/login', function () {
    return redirect()->route('home');
})->name('login');

// Jika ada yang akses /register, lempar ke Home
Route::redirect('/register', '/');

// Jika ada yang akses /dashboard, lempar ke Home
Route::redirect('/dashboard', '/');

// Jika ada yang akses profile bawaan, lempar ke Home
Route::redirect('/user/profile', '/');