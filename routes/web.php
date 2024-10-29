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
use App\Models\Kamar;
use App\Models\ObjekWisata;
use App\Models\PaketTour;
use App\Models\Penginapan;
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
    $objekWisata = ObjekWisata::paginate(8)->shuffle();
    $penginapan = Penginapan::paginate(8)->shuffle();
    $paketTour = PaketTour::paginate(8)->shuffle();
    return view('guest.index', compact('objekWisata', 'penginapan', 'paketTour'));
})->name('index');

Route::get('/detail-wisata/{id}', function ($id) {
    $objekWisata = ObjekWisata::find($id);
    $objekWisataRandom = ObjekWisata::paginate(4)->shuffle();
    return view('guest.detail-wisata', compact('objekWisata', 'objekWisataRandom'));
})->name('detail-wisata');

Route::get('/detail-penginapan/{id}', function ($id) {
    $penginapan = Penginapan::find($id);
    return view('guest.detail-penginapan', compact('penginapan'));
})->name('detail-penginapan');

Route::get('/detail-paket/{id}', function ($id) {
    $paketTour = PaketTour::find($id);
    $paketTourRandom = PaketTour::paginate(8)->shuffle();
    return view('guest.detail-paket', compact('paketTour', 'paketTourRandom'));
})->name('detail-paket');

Route::get('/detail-kamar/{id}', function ($id) {
    $kamar = Kamar::with('rPenginapan')->find($id);
    $kamarRandom = Kamar::where('id_penginapan', $kamar->id_penginapan)
        ->where('id', '!=', $kamar->id)
        ->get();
    return view('guest.detail-kamar', compact('kamar', 'kamarRandom'));
})->name('detail-kamar');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('kategori')->group(function () {
    Route::get('/show', [KategoriController::class, 'index'])->name('kategori.show');
    Route::post('/store', [KategoriController::class, 'store'])->name('kategori.store');
    Route::post('/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::get('/destroy/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    Route::get('/download', [KategoriController::class, 'download'])->name('kategori.download');
});
Route::prefix('objek-wisata')->group(function () {
    Route::get('/show', [ObjekWisataController::class, 'index'])->name('objek-wisata.show');
    Route::post('/store', [ObjekWisataController::class, 'store'])->name('objek-wisata.store');
    Route::post('/update/{id}', [ObjekWisataController::class, 'update'])->name('objek-wisata.update');
    Route::get('/destroy/{id}', [ObjekWisataController::class, 'destroy'])->name('objek-wisata.destroy');
    Route::get('/download/{', [ObjekWisataController::class, 'download'])->name('objek-wisata.download');
});
Route::prefix('penginapan')->group(function () {
    Route::get('/show', [PenginapanController::class, 'index'])->name('penginapan.show');
    Route::post('/store', [PenginapanController::class, 'store'])->name('penginapan.store');
    Route::post('/update/{id}', [PenginapanController::class, 'update'])->name('penginapan.update');
    Route::get('/destroy/{id}', [PenginapanController::class, 'destroy'])->name('penginapan.destroy');
    Route::get('/download', [PenginapanController::class, 'download'])->name('penginapan.download');
});
Route::prefix('kamar')->group(function () {
    Route::get('/show', [KamarController::class, 'index'])->name('kamar.show');
    Route::post('/store', [KamarController::class, 'store'])->name('kamar.store');
    Route::post('/update/{id}', [KamarController::class, 'update'])->name('kamar.update');
    Route::get('/destroy/{id}', [KamarController::class, 'destroy'])->name('kamar.destroy');
    Route::get('/download', [KamarController::class, 'download'])->name('kamar.download');
});
Route::prefix('owner')->group(function () {
    Route::get('/show', [OwnerController::class, 'index'])->name('owner.show');
    Route::get('/store', [OwnerController::class, 'store'])->name('owner.store');
});
Route::prefix('paket')->group(function () {
    Route::get('/show', [PaketController::class, 'index'])->name('paket.show');
    Route::post('/store', [PaketController::class, 'store'])->name('paket.store');
    Route::get('/edit/{id}', [PaketController::class, 'edit'])->name('paket.edit');
    Route::post('/update/{id}', [PaketController::class, 'update'])->name('paket.update');
    Route::get('/destroy/{id}', [PaketController::class, 'destroy'])->name('paket.destroy');
    Route::get('/download', [PaketController::class, 'download'])->name('paket.download');
});

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('/show', [UserController::class, 'index'])->name('users.show');
        Route::post('/store', [UserController::class, 'store'])->name('users.store');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('users.update');
        Route::get('/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::get('/download', [UserController::class, 'download'])->name('users.download');
    });
});

require __DIR__ . '/auth.php';
