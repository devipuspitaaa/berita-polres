<?php

use App\Http\Controllers\BeritaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PostinganController;

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

// ADMIN
// Route::get('/dashboard', [DashboardController::class, 'index']);
/** Tambah Postingan */
Route::get('/tambah', [PostinganController::class, 'index']);
Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::resource('kategori', KategoriController::class);

/** Berita */
Route::resource('berita', BeritaController::class);
Route::get('/createBerita', [BeritaController::class, 'create']);
Route::post('createberita', [BeritaController::class, 'store'])->name('berita.create');

/** End : Berita */

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
