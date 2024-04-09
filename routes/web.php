<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Middleware\CheckRoleMiddleware;
use App\Http\Controllers\Admin\PaketUjianController;
use App\Http\Controllers\Admin\SoalUjianController;
use App\Http\Controllers\Admin\PaketLatihanSoalController;
use App\Http\Controllers\Admin\LatihanSoalController;

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


        Route::group(['prefix' => 'Kategori'], function () {
            Route::get('/', [KategoriController::class, 'index'])->name('admin.kategori');

            Route::get('/create', [KategoriController::class, 'create'])->name('admin.kategori.create');
            Route::post('/store', [KategoriController::class, 'store'])->name('admin.kategori.store');

            Route::get('/edit/{id}', [KategoriController::class, 'edit'])->name('admin.kategori.edit');
            Route::put('/update/{id}', [KategoriController::class, 'update'])->name('admin.kategori.update');

            Route::delete('/destroy/{id}', [KategoriController::class, 'destroy'])->name('admin.kategori.destroy');
        });

        Route::resource('PaketUjianSoal', PaketUjianController::class);


        Route::group(['prefix' => 'SoalUjian'], function () {
            Route::get('/soal/{id}/delete-image', [SoalUjianController::class, 'deleteImage'])->name('admin.soal-ujian.delete_image');
            Route::get('/soal/{id}/delete-audio', [SoalUjianController::class, 'deleteAudio'])->name('admin.soal-ujian.delete_audio');
        });

        Route::resource('SoalUjian', SoalUjianController::class);

        Route::resource('PaketLatihanSoal', PaketLatihanSoalController::class);

        Route::resource('LatihanSoal', LatihanSoalController::class);

        Route::group(['prefix' => 'LatihanSoal'], function () {
            Route::get('/soal/{id}/delete-image', [LatihanSoalController::class, 'deleteImage'])->name('admin.soal-ujian.delete_image');
            Route::get('/soal/{id}/delete-audio', [LatihanSoalController::class, 'deleteAudio'])->name('admin.soal-ujian.delete_audio');
        });

        Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');
    });
});
