<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Middleware\CheckRoleMiddleware;
use App\Http\Controllers\Admin\PaketUjianController;
use App\Http\Controllers\Admin\SoalUjianController;
use App\Http\Controllers\Admin\LatihanSoalController;
use App\Http\Controllers\Admin\UniversitasController;
use App\Http\Controllers\Admin\ProdiController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\LoginController as UserLoginController;
use App\Http\Controllers\User\MenuController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\LatihanSoalController as UserLatihanSoalController;
use App\Http\Controllers\User\UjianController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KategoriLatihanSoalController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\User\ProfileController as UserProfileController;
use App\Http\Controllers\User\ProfileUserController;
use App\Http\Controllers\User\HomeController;

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

//Route User
// Route::get('/', function () {
//     return view('user.home');
// })->name('home');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [UserLoginController::class, 'index'])->name('user.login');
Route::post('/login', [UserLoginController::class, 'auth'])->name('login.auth');

Route::get('/register', [RegisterController::class, 'index'])->name('user.register');
Route::post('/register', [RegisterController::class, 'store'])->name('user.register.store');

Route::group(['middleware' => [CheckRoleMiddleware::class . ':Super Admin|User']], function () {
    Route::group(['middleware' => [CheckRoleMiddleware::class . ':User']], function () {
        Route::resource('ProfileUser', ProfileUserController::class);

        Route::get('/dashboard-user', [DashboardController::class, 'index'])->name('dashboard.user');

        Route::post('/update-profile-user', [UserProfileController::class, 'updateProfile'])->name('user.update.profile');

        Route::get('/change-password-user', [UserProfileController::class, 'change_password'])->name('user.changePassword');
        Route::post('/update-password-user', [UserProfileController::class, 'update_password'])->name('user.updatePassword');
    });

    Route::get('/logout', [UserLoginController::class, 'logout'])->name('user.logout');

    Route::get('/menu', [MenuController::class, 'index'])->name('user.menu');

    Route::get('/latihan-soal', [UserLatihanSoalController::class, 'index'])->name('user.latihan-soal');
    Route::get('/latihan-soal/{id}', [UserLatihanSoalController::class, 'detailKategori'])->name('user.detail-latihan-soal');
    Route::get('/latihan-soal/{kategoriLatihanSoalId}/{soalId}', [UserLatihanSoalController::class, 'mulaiLatihanSoal'])->name('user.soal-mulai');
    Route::get('/skor-akhir-latihan-soal', [UserLatihanSoalController::class, 'hasilAkhir'])->name('user.hasil-akhir-latihan-soal');

    Route::get('/paket-ujian', [UjianController::class, 'index'])->name('user.ujian');
    Route::get('/paket-ujian/{id}', [UjianController::class, 'detailPaketSoal'])->name('user.ujian.detail-paket-ujian');
    Route::get('/soal-ujian/{paketSoalId}/{soalId}', [UjianController::class, 'mulaiUjian'])->name('user.soal-ujian');
    Route::get('/skor-akhir-ujian', [UjianController::class, 'jawaban'])->name('user.ujian.skor-akhir-ujian');
    Route::get('/{prodiId}/kriteria-kelulusan', [UjianController::class, 'kriteriaKelulusan'])->name('prodi.kriteriaKelulusan');
    Route::post('/store-tesimoni', [UjianController::class, 'storeTestimoni'])->name('user.testimoni.store');
});

//Route Admin
Route::get('/admin/login', [LoginController::class, 'index'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login.post');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::group(['middleware' => [CheckRoleMiddleware::class . ':Super Admin']], function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        Route::post('/update-profile', [ProfileController::class, 'updateProfile'])->name('update.profile');

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

        Route::resource('User', UserController::class);

        Route::resource('ReviewAplikasi', ReviewController::class);

        Route::resource('Universitas', UniversitasController::class);

        Route::resource('Prodi', ProdiController::class);

        Route::group(['prefix' => 'SoalUjian'], function () {
            Route::get('/soal/{id}/delete-image', [SoalUjianController::class, 'deleteImage'])->name('admin.soal-ujian.delete_image');
            Route::get('/soal/{id}/delete-audio', [SoalUjianController::class, 'deleteAudio'])->name('admin.soal-ujian.delete_audio');
        });

        Route::resource('SoalUjian', SoalUjianController::class);

        Route::resource('KTLatihanSoal', KategoriLatihanSoalController::class);

        Route::resource('LatihanSoal', LatihanSoalController::class);

        Route::group(['prefix' => 'LatihanSoal'], function () {
            Route::get('/soal/{id}/delete-image', [LatihanSoalController::class, 'deleteImage'])->name('admin.soal-ujian.delete_image');
            Route::get('/soal/{id}/delete-audio', [LatihanSoalController::class, 'deleteAudio'])->name('admin.soal-ujian.delete_audio');
        });

        Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');
    });
});
