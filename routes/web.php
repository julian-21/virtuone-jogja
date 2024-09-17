<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FormulirController;
use App\Http\Controllers\CoachingController;
use App\Http\Controllers\ZoomController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CekKodeController;
use App\Http\Controllers\CekKodeCoachingController;
use App\Http\Controllers\FormulirAdminController;
use App\Http\Controllers\CoachingAdminController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\HalamanController;
use App\Http\Controllers\UserController;
use App\Models\Formulir;

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


Route::group(['middleware' => ['web']], function () {
    Route::get('/', [HalamanController::class, 'index'])->name('index');
    Route::get('/', [HalamanController::class, 'index'])->name('homeindex');

    Route::get('/formulirkonsultasi', [FormulirController::class, 'create'])->name('formulir.create');
    Route::post('/formulir', [FormulirController::class, 'store'])->name('formulir.store');
    Route::get('/formulir/{id}', [FormulirController::class, 'show'])->name('formulir.show');
    // Rute untuk menampilkan daftar Zoom Meeting
    Route::get('/coachingkonsultasi', [CoachingController::class, 'create'])->name('coaching.create');
    Route::post('/coaching', [CoachingController::class, 'store'])->name('coaching.store');
    Route::get('/coaching/{id}', [CoachingController::class, 'show'])->name('coaching.show');

    Route::get('/reload-captcha', [FormulirController::class, 'reloadCaptcha']);

    Route::get('/refresh-captcha', [CoachingController::class, 'refreshCaptcha']);
    // Rute-rute Anda di sini
    Route::get('/cek-kode', [CekKodeController::class, 'index'])->name('cek-kode');
    Route::post('/cek-kode', [CekKodeController::class, 'cekKode'])->name('cek-kode.submit');
    Route::post('/cek-kode', [CekKodeController::class, 'cek'])->name('cek-kode.cek');

    Route::get('/cek-kode-coaching', [CekKodeCoachingController::class, 'index'])->name('cek-kode-coaching');
    Route::post('/cek-kode-coaching', [CekKodeCoachingController::class, 'cekKode'])->name('cek-kode-coaching.submit');
    Route::post('/cek-kode-coaching', [CekKodeCoachingController::class, 'cek'])->name('cek-kode-coaching.cek');


    // Rute untuk menampilkan formulir login
    Route::get('/sagutep', [CustomAuthController::class, 'sagutepmasuk'])->name('sagutep');

    // Rute untuk menangani proses login
    Route::post('/sagutep', [CustomAuthController::class, 'sagutep']);

    // Rute untuk menampilkan formulir registrasi
    //Route::get('/register', [CustomAuthController::class, 'showRegistrationForm'])->name('register');

    // Rute untuk menangani proses registrasi
    //Route::post('/register', [CustomAuthController::class, 'register']);

    Route::get('/logout', [CustomAuthController::class, 'logout'])->name('logout');
});

Auth::routes();

// routes/web.php

// Rute-rute untuk ADMIN
Route::middleware(['auth', 'role:ADMIN,VA,PETUGAS'])->group(function () {
    Route::get('/register', [CustomAuthController::class, 'showRegistrationForm'])->name('register')->middleware('auth');

    // Rute untuk menangani proses registrasi
    Route::post('/register', [CustomAuthController::class, 'register'])->middleware('auth');

    Route::get('/index', [HomeController::class, 'index'])->name('index')->middleware('auth');

    Route::get('/user-list', [UserController::class, 'userList'])->name('user.list')->middleware('auth');

    Route::get('/change-password/{user}', [UserController::class, 'showChangePasswordForm'])->name('change.password.form')->middleware('auth');

    Route::post('/change-password/{user}', [UserController::class, 'changePassword'])->name('change.password')->middleware('auth');

    Route::get('/activate/{user}', [UserController::class, 'activate'])->name('activate.user')->middleware('auth');

    Route::get('/deactivate/{user}', [UserController::class, 'deactivate'])->name('deactivate.user')->middleware('auth');

    Route::get('/edit-role/{user}', [UserController::class, 'editRole'])->name('edit.role')->middleware('auth');
    
    Route::put('/update-role/{user}', [UserController::class, 'updateRole'])->name('update.role')->middleware('auth');

    Route::get('/zoom', [ZoomController::class, 'index'])->name('zoom.index')->middleware('auth');

    Route::get('/set-active/{id}', [ZoomController::class, 'setActive'])->name('set-active')->middleware('auth');

    Route::get('/set-inactive/{id}', [ZoomController::class, 'setInactive'])->name('set-inactive')->middleware('auth');

    // Rute untuk menampilkan formulir tambah Zoom Meeting
    Route::get('/zoom/create', [ZoomController::class, 'create'])->name('zoom.create')->middleware('auth');

    // Rute untuk menyimpan data Zoom Meeting yang baru
    Route::post('/zoom', [ZoomController::class, 'store'])->name('zoom.store')->middleware('auth');

    // Rute untuk menampilkan halaman edit Zoom Meeting
    Route::get('/zoom/{id}/edit', [ZoomController::class, 'edit'])->name('zoom.edit')->middleware('auth');

    // Rute untuk memperbarui data Zoom Meeting yang ada
    Route::put('/zoom/{id}', [ZoomController::class, 'update'])->name('zoom.update')->middleware('auth');

    // Rute untuk menampilkan detail Zoom Meeting
    Route::get('/zoom/{id}', [ZoomController::class, 'show'])->name('zoom.show')->middleware('auth');

    // Rute untuk menghapus Zoom Meeting
    Route::delete('/zoom/{id}', [ZoomController::class, 'destroy'])->name('zoom.destroy')->middleware('auth');

    // Tambahkan rute-rute khusus ADMIN di sini
    Route::resource('formulir-admin', 'FormulirAdminController');

    Route::get('/formuliradmin', [FormulirAdminController::class, 'index'])->name('formuliradmin.index')->middleware('auth');

    Route::get('/export-formulir', [FormulirAdminController::class, 'formulirExport'])->name('formulir.export')->middleware('auth');

    Route::get('/formulir-report', [FormulirAdminController::class, 'formulirReport'])->name('formulir-report')->middleware('auth');
    // Rute untuk menampilkan formulir tambah FormulirAdmin

    // Rute untuk menampilkan detail FormulirAdmin
    Route::get('/formuliradmin/{formuliradmin}', [FormulirAdminController::class, 'show'])->name('formuliradmin.show')->middleware('auth');

    Route::get('/formuliradmin-petugas', [FormulirAdminController::class, 'indexpetugas'])->name('formuliradmin.indexpetugas')->middleware('auth');
    // Rute untuk menampilkan formulir tambah FormulirAdmin

    // Rute untuk menampilkan detail FormulirAdmin
    Route::get('/formuliradmin-petugas/{formuliradmin}', [FormulirAdminController::class, 'showpetugas'])->name('formuliradmin.showpetugas')->middleware('auth');

    // Rute untuk menampilkan formulir edit FormulirAdmin
    Route::get('/formuliradmin/{formuliradmin}/edit', [FormulirAdminController::class, 'edit'])->name('formuliradmin.edit')->middleware('auth');

    // Rute untuk memperbarui FormulirAdmin
    Route::put('/formuliradmin/{formuliradmin}', [FormulirAdminController::class, 'update'])->name('formuliradmin.update')->middleware('auth');

    // Rute untuk klaim formulir
    Route::post('/formuliradmin/{formulir}/claim', [FormulirAdminController::class, 'claim'])->name('formuliradmin.claim')->middleware('auth');

    // Rute untuk unclaim formulir
    Route::post('/formuliradmin/{formulir}/unclaim', [FormulirAdminController::class, 'unclaim'])->name('formuliradmin.unclaim')->middleware('auth');

    Route::post('/formulir/upload-gambar', [FormulirAdminController::class, 'uploadGambar'])->name('formuliradmin.upload-gambar')->middleware('auth');

    Route::get('/download-gambar/{fileName}', [FormulirAdminController::class, 'downloadGambar'])->name('formuliradmin.download-gambar')->middleware('auth');

    Route::get('/download-foto/{fileName}', [FormulirAdminController::class, 'downloadFoto'])->name('formuliradmin.download-foto')->middleware('auth');

    Route::delete('/formuliradmin/hapus-gambar/{id}', [FormulirAdminController::class, 'hapusGambar'])->name('formuliradmin.hapus-gambar')->middleware('auth');

    // routes/web.php
    Route::post('formulir/update-status', [FormulirAdminController::class, 'updateStatus'])->name('formuliradmin.update-status')->middleware('auth');

    // Tambahkan rute-rute khusus ADMIN di sini
    Route::resource('coaching-admin', 'CoachingAdminController');

    Route::get('/coachingadmin', [CoachingAdminController::class, 'index'])->name('coachingadmin.index')->middleware('auth');

    Route::get('/export', [CoachingAdminController::class, 'export'])->name('coaching.export')->middleware('auth');
    // Rute untuk menampilkan coaching tambah coachingAdmin
    Route::get('/coaching-report', [CoachingAdminController::class, 'coachingReport'])->name('coaching-report')->middleware('auth');
    
    // Rute untuk menampilkan detail coachingAdmin
    Route::get('/coachingadmin/{coachingadmin}', [CoachingAdminController::class, 'show'])->name('coachingadmin.show')->middleware('auth');

    Route::get('/coachingadmin-petugas', [CoachingAdminController::class, 'indexpetugas'])->name('coachingadmin.indexpetugas')->middleware('auth');
    // Rute untuk menampilkan coaching tambah coachingAdmin

    // Rute untuk menampilkan detail coachingAdmin
    Route::get('/coachingadmin-petugas/{coachingadmin}', [CoachingAdminController::class, 'showpetugas'])->name('coachingadmin.showpetugas')->middleware('auth');

    // Rute untuk menampilkan coaching edit coachingAdmin
    Route::get('/coachingadmin/{coachingadmin}/edit', [CoachingAdminController::class, 'edit'])->name('coachingadmin.edit')->middleware('auth');

    // Rute untuk memperbarui coachingAdmin
    Route::put('/coachingadmin/{coachingadmin}', [CoachingAdminController::class, 'update'])->name('coachingadmin.update')->middleware('auth');

    // Rute untuk klaim coaching
    Route::post('/coachingadmin/{coaching}/claim', [CoachingAdminController::class, 'claim'])->name('coachingadmin.claim')->middleware('auth');

    // Rute untuk unclaim coaching
    Route::post('/coachingadmin/{coaching}/unclaim', [CoachingAdminController::class, 'unclaim'])->name('coachingadmin.unclaim')->middleware('auth');

    Route::post('/coaching/upload-file', [CoachingAdminController::class, 'uploadFile'])->name('coachingadmin.upload-file')->middleware('auth');

    Route::get('/download-gambar/{fileName}', [CoachingAdminController::class, 'downloadGambar'])->name('coachingadmin.download-gambar')->middleware('auth');

    Route::get('/download-file/{fileName}', [CoachingAdminController::class, 'downloadFile'])->name('coachingadmin.download-file')->middleware('auth');

    Route::delete('/coachingadmin/hapus-gambar/{id}', [CoachingAdminController::class, 'hapusGambar'])->name('coachingadmin.hapus-gambar')->middleware('auth');

    // routes/web.php
    Route::post('/update-status', [CoachingAdminController::class, 'updateStatus'])->name('coachingadmin.update-status')->middleware('auth');
});
