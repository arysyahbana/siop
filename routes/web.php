<?php

use App\Helpers\GlobalFunction;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\ObjekWisataController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PenginapanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransportasiController;
use App\Http\Controllers\UserController;
use App\Models\Kamar;
use App\Models\Lokasi;
use App\Models\ObjekWisata;
use App\Models\PaketTour;
use App\Models\Penginapan;
use Illuminate\Http\Request;
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

// Guest
Route::get('/', function () {
    $page = 'Home';
    $objekWisata = ObjekWisata::inRandomOrder()->paginate(16);
    return view('guest.index', compact('objekWisata', 'page'));
})->name('index');

Route::get('/search-wisata', function (Request $request) {
    $page = 'Home';
    $columns = ['nama_wisata', 'deskripsi', 'lokasi'];
    $dataSearch = $request->search;
    $objekWisata = GlobalFunction::searchGlobal('objek_wisatas', $columns, $dataSearch);
    return view('guest.index', compact('objekWisata', 'page'));
})->name('search-wisata');

Route::get('/penginapan', function () {
    $page = 'Penginapan';
    $penginapan = Penginapan::inRandomOrder()->paginate(16);
    return view('guest.penginapan', compact('penginapan', 'page'));
})->name('penginapan');

Route::get('/search-penginapan', function (Request $request) {
    $page = 'Penginapan';
    $columns = ['nama_penginapan', 'deskripsi', 'lokasi'];
    $dataSearch = $request->search;
    $penginapan = GlobalFunction::searchGlobal('penginapans', $columns, $dataSearch);
    return view('guest.penginapan', compact('penginapan', 'page'));
})->name('search-penginapan');

Route::get('/paket-tour', function () {
    $page = 'Paket Tour';
    $paketTour = PaketTour::inRandomOrder()->paginate(16);
    return view('guest.paket', compact('paketTour', 'page'));
})->name('paket');

Route::get('/search-paket', function (Request $request) {
    $page = 'Paket Tour';
    $columns = ['nama_paket', 'deskripsi'];
    $dataSearch = $request->search;
    $paketTour = GlobalFunction::searchGlobal('paket_tours', $columns, $dataSearch);
    return view('guest.paket', compact('paketTour', 'page'));
})->name('search-paket');

Route::get('/detail-wisata/{id}', function ($id) {
    $page = 'Home';
    $objekWisata = ObjekWisata::find($id);
    $objekWisataRandom = ObjekWisata::paginate(4);

    return view('guest.detail-wisata', compact('objekWisata', 'objekWisataRandom', 'page'));
})->name('detail-wisata');

Route::get('/detail-penginapan/{id}', function ($id) {
    $page = 'Penginapan';
    $penginapan = Penginapan::find($id);
    return view('guest.detail-penginapan', compact('penginapan', 'page'));
})->name('detail-penginapan');

Route::get('/detail-paket/{id}', function ($id) {
    $page = 'Paket Tour';
    $paketTour = PaketTour::with('rItemTambahan')->findOrFail($id);
    $paketTourRandom = PaketTour::inRandomOrder()->paginate(8);
    return view('guest.detail-paket', compact('paketTour', 'paketTourRandom', 'page'));
})->name('detail-paket');

Route::get('/detail-kamar/{id}', function ($id) {
    $page = 'Penginapan';
    $kamar = Kamar::with('rPenginapan')->find($id);
    $kamarRandom = Kamar::where('id_penginapan', $kamar->id_penginapan)
        ->where('id', '!=', $kamar->id)
        ->get();
    return view('guest.detail-kamar', compact('kamar', 'kamarRandom', 'page'));
})->name('detail-kamar');

Route::get('/rekomendasi', function () {
    $page = 'Rekomendasi';
    $lokasi = Lokasi::all();
    return view('guest.rekomendasi.rekomendasi', compact('page', 'lokasi'));
})->name('rekomendasi');

Route::get('/hasil-rekomendasi', function (Request $request) {
    $anggaran = preg_replace('/[^0-9]/', '', $request->anggaran);

    $rekomendasi = Penginapan::with('rKamar')
        ->when($request->lokasi_id, function ($query) use ($request) {
            $query->where('id_lokasi', $request->lokasi_id);
        })
        ->when($request->kapasitas, function ($query) use ($request) {
            $query->whereHas('rKamar', function ($subQuery) use ($request) {
                $subQuery->where('kapasitas_kamar', '>=', $request->kapasitas);
            });
        })
        ->when($request->jenisPenginapan, function ($query) use ($request) {
            $query->where('jenis_penginapan', $request->jenisPenginapan);
        })
        ->when($request->anggaran, function ($query) use ($anggaran) {
            $query->whereHas('rKamar', function ($subQuery) use ($anggaran) {
                $subQuery->where('harga', '<=', $anggaran);
            });
        })
        ->when($request->wahana === 'Ada', function ($query) use ($request) {
            $query->where('wahana', 'Ada');
        })
        ->when($request->funGames === 'Ada', function ($query) use ($request) {
            $query->where('outbound', 'Ada');
        })
        ->when($request->kafe === 'Ada', function ($query) use ($request) {
            $query->where('kafe', 'Ada');
        })
        ->paginate(8);

    $page = 'Rekomendasi';
    return view('guest.rekomendasi.hasilRekomendasi', compact('page', 'rekomendasi'));
})->name('rekomendasi-hasil');

// Admin & Owner
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('transportasi')->group(function () {
    Route::get('/show', [TransportasiController::class, 'index'])->name('transportasi.show');
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
Route::prefix('lokasi')->group(function () {
    Route::get('/show', [LokasiController::class, 'index'])->name('lokasi.show');
    Route::post('/store', [LokasiController::class, 'store'])->name('lokasi.store');
    Route::post('/update/{id}', [LokasiController::class, 'update'])->name('lokasi.update');
    Route::get('/destroy/{id}', [LokasiController::class, 'destroy'])->name('lokasi.destroy');
    Route::get('/download/{', [LokasiController::class, 'download'])->name('lokasi.download');
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
