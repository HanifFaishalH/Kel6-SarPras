<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LaporanKerusakanController;
use App\Http\Controllers\UserController;

Route::pattern('id', '[0-9]+');

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('register', [RegisterController::class, 'index']);
Route::post('register', [RegisterController::class, 'store']);

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::middleware(['authorize:admin'])->group(function () {
        Route::get('/laporan/per_tahun', [LaporanKerusakanController::class, 'laporanPerTahun']);
        Route::get('/laporan/per_bulan', [LaporanKerusakanController::class, 'laporanPerBulan']);
    });

    Route::middleware(['authorize:admin,mhs'])->group(function () {
        Route::prefix('level')->group(function () {
            Route::get('/', [LevelController::class, 'index']);
            Route::get('/list', [LevelController::class, 'list']);
        });

        Route::prefix('user')->group(function () {
            Route::get('/', [UserController::class, 'index']);
            Route::get('/list', [UserController::class, 'list']);
        });

        Route::prefix('gedung')->group(function () {
            Route::get('/', [GedungController::class, 'index'])->name('gedung.index');
            Route::get('/list', [GedungController::class, 'list']);
            Route::get('/{id}/show', [GedungController::class, 'show']);
            Route::get('/{id}/edit', [GedungController::class, 'edit']);
            Route::match(['put', 'post'], '/{id}/update', [GedungController::class, 'update'])->name('gedung.update');
            Route::get('/{id}/delete', [GedungController::class, 'confirm']);
            Route::delete('/{id}/delete', [GedungController::class, 'destroy'])->name('gedung.destroy');
        });

        Route::prefix('fasilitas')->group(function () {
            Route::get('/', [BarangController::class, 'index']);
            Route::get('/list', [BarangController::class, 'list']);
        });

        Route::prefix('laporan')->group(function () {
            Route::get('/', [LaporanController::class, 'index']);
            Route::get('/list', [LaporanController::class, 'list']);
            Route::get('/ajax/gedung', [LaporanController::class, 'getGedung']);
            Route::get('/show_ajax/{id}', [LaporanController::class, 'show_ajax']);
            Route::get('/ajax/lantai/{gedung_id}', [LaporanController::class, 'getLantai']);
            Route::get('/ajax/ruang-sarana/{lantai_id}', [LaporanController::class, 'getRuangDanSarana']);
        });
    });

    foreach (['mhs', 'dosen', 'tendik'] as $role) {
        Route::middleware(["authorize:$role"])->group(function () use ($role) {
            Route::prefix('user')->group(function () {
                Route::get('/', [UserController::class, 'index']);
                Route::get('/list', [UserController::class, 'list']);
            });

            Route::prefix('fasilitas')->group(function () {
                Route::get('/', [BarangController::class, 'index']);
                Route::get('/list', [BarangController::class, 'list']);
            });

            Route::prefix('laporan')->group(function () {
                Route::get('/', [LaporanController::class, 'index']);
                Route::get('/list', [LaporanController::class, 'list']);
                Route::get('/create_ajax', [LaporanController::class, 'create_ajax']);
                Route::get('/ajax/gedung', [LaporanController::class, 'getGedung']);
                Route::get('/show_ajax/{id}', [LaporanController::class, 'show_ajax']);
                Route::get('/ajax/lantai/{gedung_id}', [LaporanController::class, 'getLantai']);
                Route::get('/ajax/ruang-sarana/{lantai_id}', [LaporanController::class, 'getRuangDanSarana']);
                Route::post('/store_ajax', [LaporanController::class, 'store_ajax']);
            });
        });
    }

    Route::middleware(['authorize:teknisi'])->group(function () {
        Route::prefix('user')->group(function () {
            Route::get('/', [UserController::class, 'index']);
            Route::get('/list', [UserController::class, 'list']);
        });

        Route::prefix('gedung')->group(function () {
            Route::get('/', [GedungController::class, 'index'])->name('gedung.index');
            Route::get('/list', [GedungController::class, 'list']);
            Route::get('/{id}/show', [GedungController::class, 'show']);
            Route::get('/{id}/edit', [GedungController::class, 'edit']);
            Route::match(['put', 'post'], '/{id}/update', [GedungController::class, 'update'])->name('gedung.update');
            Route::get('/{id}/delete', [GedungController::class, 'confirm']);
            Route::delete('/{id}/delete', [GedungController::class, 'destroy'])->name('gedung.destroy');
        });

        Route::prefix('fasilitas')->group(function () {
            Route::get('/', [BarangController::class, 'index']);
            Route::get('/list', [BarangController::class, 'list']);
        });

        Route::prefix('laporan')->group(function () {
            Route::get('/', [LaporanController::class, 'index']);
            Route::get('/kelola', [LaporanController::class, 'kelola']);
            Route::get('/list', [LaporanController::class, 'list']);
            Route::get('/list_kelola', [LaporanController::class, 'list_kelola']);
            Route::get('/create_ajax', [LaporanController::class, 'create_ajax']);
            Route::get('/ajax/gedung', [LaporanController::class, 'getGedung']);
            Route::get('/show_ajax/{id}', [LaporanController::class, 'show_ajax']);
            Route::get('/ajax/lantai/{gedung_id}', [LaporanController::class, 'getLantai']);
            Route::get('/ajax/ruang-sarana/{lantai_id}', [LaporanController::class, 'getRuangDanSarana']);
            Route::post('/store_ajax', [LaporanController::class, 'store_ajax']);
        });
    });
});
