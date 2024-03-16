<?php

use App\Http\Controllers\Admin\KategoriSaintek;
use App\Http\Controllers\Admin\KategoriSoshum;
use App\Http\Controllers\Admin\KategoriUtbkController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
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

        Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');
    });
});
