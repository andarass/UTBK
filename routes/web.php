<?php

use App\Http\Controllers\Admin\KategoriSaintek;
use App\Http\Controllers\Admin\KategoriSoshum;
use App\Http\Controllers\Admin\KategoriUtbkController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SoalUjianSaintekController;
use App\Http\Controllers\Admin\SoalUjianSoshumController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PaketSoalUjianSaintekController;
use App\Http\Controllers\Admin\PaketSoalUjianSoshumController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Middleware\CheckRoleMiddleware;


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

Route::get('/', function () {
    return view('welcome');
});

//Route Admin
Route::get('/admin/login', [LoginController::class, 'index'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login.post');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::group(['middleware' => [CheckRoleMiddleware::class . ':Super Admin']], function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        Route::get('/change-password', [ProfileController::class, 'change_password'])->name('changePassword');
        Route::post('/update-password', [ProfileController::class, 'update_password'])->name('updatePassword');

        Route::resource('KategoriUtbk', KategoriUtbkController::class);

        Route::group(['prefix' => 'KategoriSoal'], function () {
            Route::get('/', [KategoriSaintek::class, 'index'])->name('admin.kategori');

            Route::get('/create', [KategoriSaintek::class, 'create'])->name('admin.kategori-saintek.create');
            Route::post('/store', [KategoriSaintek::class, 'store'])->name('admin.kategori-saintek.store');

            Route::get('/edit/{id}', [KategoriSaintek::class, 'edit'])->name('admin.kategori-saintek.edit');
            Route::put('/update/{id}', [KategoriSaintek::class, 'update'])->name('admin.kategori-saintek.update');

            Route::delete('/destroy/{id}', [KategoriSaintek::class, 'destroy'])->name('admin.kategori-saintek.delete');

            Route::get('/getKategoriSoshum', [KategoriSoshum::class, 'index'])->name('admin.kategori-soshum');

            Route::get('/createKategoriSoshum', [KategoriSoshum::class, 'create'])->name('admin.kategori-soshum.create');
            Route::post('/storeKategoriSoshum', [KategoriSoshum::class, 'store'])->name('admin.kategori-soshum.store');

            Route::get('/editKategoriSoshum/{id}', [KategoriSoshum::class, 'edit'])->name('admin.kategori-soshum.edit');
            Route::put('/updateKategoriSoshum/{id}', [KategoriSoshum::class, 'update'])->name('admin.kategori-soshum.update');

            Route::delete('/destroyKategoriSoshum/{id}', [KategoriSoshum::class, 'destroy'])->name('admin.kategori-soshum.destroy');
        });

        Route::group(['prefix' => 'PaketSoalUjian'], function () {
            Route::get('/', [PaketSoalUjianSaintekController::class, 'index'])->name('admin.paket-soal-ujian');

            Route::get('/create', [PaketSoalUjianSaintekController::class, 'create'])->name('admin.paket-soal-ujian-saintek.create');
            Route::post('/store', [PaketSoalUjianSaintekController::class, 'store'])->name('admin.paket-soal-ujian-saintek.store');

            Route::get('/edit/{id}', [PaketSoalUjianSaintekController::class, 'edit'])->name('admin.paket-soal-ujian-saintek.edit');
            Route::put('/update/{id}', [PaketSoalUjianSaintekController::class, 'update'])->name('admin.paket-soal-ujian-saintek.update');

            Route::delete('/destroy/{id}', [PaketSoalUjianSaintekController::class, 'destroy'])->name('admin.paket-soal-ujian-saintek.delete');

            Route::get('/getPaketUjianSoshum', [PaketSoalUjianSoshumController::class, 'index'])->name('admin.paket-soal-ujian-soshum');

            Route::get('/createPaketUjianSoshum', [PaketSoalUjianSoshumController::class, 'create'])->name('admin.paket-soal-ujian-soshum.create');
            Route::post('/storePaketUjianSoshum', [PaketSoalUjianSoshumController::class, 'store'])->name('admin.paket-soal-ujian-soshum.store');

            Route::get('/editPaketUjianSoshum/{id}', [PaketSoalUjianSoshumController::class, 'edit'])->name('admin.paket-soal-ujian-soshum.edit');
            Route::put('/updatePaketUjianSoshum/{id}', [PaketSoalUjianSoshumController::class, 'update'])->name('admin.paket-soal-ujian-soshum.update');

            Route::delete('/destroyPaketUjianSoshum/{id}', [PaketSoalUjianSoshumController::class, 'destroy'])->name('admin.paket-soal-ujian-soshum.destroy');
        });

        Route::group(['prefix' => 'SoalUjian'], function () {
            Route::get('/', [SoalUjianSaintekController::class, 'index'])->name('admin.soal-ujian');

            Route::get('/create', [SoalUjianSaintekController::class, 'create'])->name('admin.soal-ujian-saintek.create');
            Route::post('/store', [SoalUjianSaintekController::class, 'store'])->name('admin.soal-ujian-saintek.store');

            Route::get('/edit/{id}', [SoalUjianSaintekController::class, 'edit'])->name('admin.soal-ujian-saintek.edit');
            Route::put('/update/{id}', [SoalUjianSaintekController::class, 'update'])->name('admin.soal-ujian-saintek.update');

            Route::delete('/destroy/{id}', [SoalUjianSaintekController::class, 'destroy'])->name('admin.soal-ujian-saintek.delete');

            Route::get('/getSoalUjianSoshum', [SoalUjianSoshumController::class, 'index'])->name('admin.soal-ujian-soshum');

            Route::get('/createSoalUjianSoshum', [SoalUjianSoshumController::class, 'create'])->name('admin.soal-ujian-soshum.create');
            Route::post('/storeSoalUjianSoshum', [SoalUjianSoshumController::class, 'store'])->name('admin.soal-ujian-soshum.store');

            Route::get('/editSoalUjianSoshum/{id}', [SoalUjianSoshumController::class, 'edit'])->name('admin.soal-ujian-soshum.edit');
            Route::put('/updateSoalUjianSoshum/{id}', [SoalUjianSoshumController::class, 'update'])->name('admin.soal-ujian-soshum.update');

            Route::delete('/destroySoalUjianSoshum/{id}', [SoalUjianSoshumController::class, 'destroy'])->name('admin.soal-ujian-soshum.destroy');
        });


        Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');
    });
});
