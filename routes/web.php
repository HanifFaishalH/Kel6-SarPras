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
use App\Http\Controllers\SaranaController;
use App\Http\Controllers\UserController;

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

Route::pattern('id', '[0-9]+');

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('register', [RegisterController::class, 'index']);
Route::post('register', [RegisterController::class, 'store']);

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/', [HomeController::class, 'index']);

    Route::middleware(['authorize:mhs,dosen,tendik'])->group(function () {
        Route::group(['prefix' => 'laporan'], function () {
            Route::get('/', [LaporanController::class, 'index']);
            Route::get('/list', [LaporanController::class, 'list']);
            Route::get('/create_ajax', [LaporanController::class, 'create_ajax']);
            Route::get('/show_ajax/{id}', [LaporanController::class, 'show_ajax']);
            Route::get('/ajax/gedung', [LaporanController::class, 'getGedung']);
            Route::get('/ajax/lantai/{gedung_id}', [LaporanController::class, 'getLantai']);
            Route::get('/ajax/ruang-sarana/{lantai_id}', [LaporanController::class, 'getRuangDanSarana']);
            Route::post('/store_ajax', [LaporanController::class, 'store_ajax']);
        });

        Route::post('/feedback', [LaporanController::class, 'feedback']);
    });

    Route::middleware(['authorize:admin,sarpras'])->group(function (): void {
        Route::group(['prefix' => 'laporan'], function () {
            // Admin
            Route::get('/kelola', [LaporanController::class, 'kelola']);
            Route::get('/list_kelola', [LaporanController::class, 'list_kelola']);
            Route::get('/show_kelola_ajax/{id}', [LaporanController::class, 'show_kelola'])->name('laporan.show_kelola_detail');
            Route::get('/edit_ajax/{id}', [LaporanController::class, 'edit_ajax']);
            Route::post('/{id}/update_ajax', [LaporanController::class, 'update_ajax']);
            // User
        });
    });

    Route::middleware(['authorize:admin'])->group(function () {
        Route::group(['prefix' => 'level'], function () {
            Route::get('/', [LevelController::class, 'index']);
            Route::get('/list', [LevelController::class, 'list']);
        });

        Route::group(['prefix' => 'user'], function () {
            Route::get('/', [UserController::class, 'index']);
            Route::get('/list', [UserController::class, 'list']);
        });

        Route::group(['prefix' => 'gedung'], function () {
            Route::get('/', [GedungController::class, 'index'])->name('gedung.index');
            Route::get('/list', [GedungController::class, 'list']);
            Route::get('/{id}/show', [GedungController::class, 'show']);
            Route::get('/{id}/edit', [GedungController::class, 'edit']);
            Route::put('/{id}/update', [GedungController::class, 'update'])->name('gedung.update');
            Route::post('/{id}/update', [GedungController::class, 'update'])->name('gedung.update');
            Route::get('/{id}/delete', [GedungController::class, 'confirm']);
            Route::delete('/{id}/delete', [GedungController::class, 'destroy'])->name('gedung.destroy');
        });

        Route::group(['prefix' => 'barang'], function () {
            Route::get('/', [BarangController::class, 'index']);
            Route::get('/list', [BarangController::class, 'list']);
        });
        Route::group(['prefix' => 'sarana'], function () {
            Route::get('/', [SaranaController::class, 'index']);
            Route::get('/list', [SaranaController::class, 'list']);
        });

        Route::group(['prefix' => 'teknisi'], function () {
            Route::get('/', [UserController::class, 'index']);
            Route::get('/list', [UserController::class, 'list']);
        });

        Route::group(['prefix' => 'sarpras'], function () {
            Route::get('/', [SaranaController::class, 'index']);
            Route::get('/list', [SaranaController::class, 'list']);
        });
    });
});
