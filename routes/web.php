<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ObjekWisataController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PenginapanController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Models\Petugas;
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

// Route::get('/', function () {
//     return view('admin.pages.dashboard');
// });
Route::get('/', function () {
    return view('auth.login');
});
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('kategori')->group(function () {
    Route::get('/show', [KategoriController::class, 'index'])->name('kategori.show');
});
Route::prefix('objek-wisata')->group(function () {
    Route::get('/show', [ObjekWisataController::class, 'index'])->name('objek-wisata.show');
});
Route::prefix('penginapan')->group(function () {
    Route::get('/show', [PenginapanController::class, 'index'])->name('penginapan.show');
});
Route::prefix('kamar')->group(function () {
    Route::get('/show', [KamarController::class, 'index'])->name('kamar.show');
});
Route::prefix('owner')->group(function () {
    Route::get('/show', [OwnerController::class, 'index'])->name('owner.show');
});
Route::prefix('paket')->group(function () {
    Route::get('/show', [PaketController::class, 'index'])->name('paket.show');
    Route::get('/edit', [PaketController::class, 'edit'])->name('paket.edit');
});


Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('/show', [UserController::class, 'index'])->name('users.show');
        Route::post('/store', [UserController::class, 'store'])->name('users.store');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('users.update');
        Route::get('/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});

require __DIR__ . '/auth.php';
