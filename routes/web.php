<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Middleware\CheckRoleMiddleware;
use App\Http\Controllers\Admin\PaketUjianController;


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

        Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');
    });
});
