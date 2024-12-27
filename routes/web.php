<?php

use App\Http\Controllers\LoginPasienController;
use App\Http\Controllers\LoginDokterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PeriksaController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\DokterMiddleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\PasienMiddleware;

Route::get('/', function () {
    return view('home.home');
})->name('home');

// Login/Register Pasien Routes
Route::get('/daftar-pasien', [LoginPasienController::class, 'showRegisterForm'])->name('pasien.registerForm');
Route::post('/daftar-pasien', [LoginPasienController::class, 'register'])->name('pasien.register');
Route::get('/login-pasien', [LoginPasienController::class, 'showLoginForm'])->name('pasien.loginForm');
Route::post('/login-pasien', [LoginPasienController::class, 'login'])->name('pasien.login');
Route::get('pasien/dashboard', [PasienController::class, 'dashboard'])->name('pasien.dashboard');

// Login Dokter Routes
Route::get('/login-dokter', [LoginDokterController::class, 'showLoginForm'])->name('dokter.loginForm');
Route::post('/login-dokter', [LoginDokterController::class, 'login'])->name('dokter.login');

// Protected Dokter Routes
Route::middleware([DokterMiddleware::class])->group(function () {
    Route::get('dokter/dashboard', [DokterController::class, 'dashboard'])->name('dokter.dashboard');
    Route::get('/dokter/edit', [DokterController::class, 'editProfile'])->name('dokter.edit');
    Route::post('/dokter/edit', [DokterController::class, 'updateProfile']);
    Route::get('/dokter/schedule', [DokterController::class, 'manageSchedule'])->name('dokter.schedule');
    Route::post('/dokter/schedule', [DokterController::class, 'storeSchedule']);
    Route::patch('/dokter/schedule/updateStatus/{id}', [DokterController::class, 'updateStatus'])->name('dokter.schedule.updateStatus');
    Route::get('/dokter/riwayatPasien', [DokterController::class, 'riwayatPasien'])->name('dokter.riwayatPasien');
    // Periksa (Medical Examination) Routes
    Route::get('/periksa/list', [PeriksaController::class, 'listPasien'])->name('periksa.list');
    Route::get('/periksa/form/{idDaftarPoli}', [PeriksaController::class, 'formPeriksa'])->name('periksa.form');
    Route::post('/periksa/store', [PeriksaController::class, 'simpanPeriksa'])->name('periksa.store');
    Route::get('/periksa/riwayat', [PeriksaController::class, 'riwayatPasien'])->name('periksa.riwayat');
});

// Admin Routes
Route::middleware([AdminMiddleware::class])->group(function () { // Use your custom AdminMiddleware
    Route::get('/dashboard-admin', [AdminController::class, 'showDashboardAdmin'])->name('admin.index');

    // Dokter Management
    Route::put('/dokter/{id}', [AdminController::class, 'updateDokter'])->name('dokter.update');
    Route::delete('/dokter/{id}', [AdminController::class, 'deleteDokter'])->name('dokter.destroy');

    Route::get('/data-dokter', [AdminController::class, 'listDokter'])->name('dokter.index');
    Route::post('/dokter/store', [AdminController::class, 'storeDokter'])->name('dokter.store');

    // Poli Management
    Route::get('/data-poli', [AdminController::class, 'listPoli'])->name('poli.index');
    Route::post('/poli/store', [AdminController::class, 'storePoli'])->name('poli.store');
    Route::get('poli/{id}/edit', [AdminController::class, 'editPoli'])->name('poli.edit');
    Route::put('poli/{id}', [AdminController::class, 'updatePoli'])->name('poli.update');
    Route::delete('poli/{id}', [AdminController::class, 'deletePoli'])->name('poli.delete');

    // Pasien Management
    Route::get('/data-pasien', [AdminController::class, 'listPasien'])->name('pasien.index');
    Route::post('/admin/pasien', [AdminController::class, 'storePasien'])->name('pasien.store');
    Route::get('/pasien/{id}/edit', [AdminController::class, 'editPasien'])->name('pasien.edit');
    Route::put('/admin/pasien/{id}', [AdminController::class, 'updatePasien'])->name('pasien.update');
    Route::delete('/admin/pasien/{id}', [AdminController::class, 'deletePasien'])->name('pasien.delete');

    // Obat Management
    Route::get('/data-obat', [AdminController::class, 'listObat'])->name('obat.index');
    Route::post('/obat/store', [AdminController::class, 'storeObat'])->name('obat.store');
    Route::get('/obat/{id}/edit', [AdminController::class, 'editObat'])->name('obat.edit');
    Route::put('/obat/{id}', [AdminController::class, 'updateObat'])->name('obat.update');
    Route::delete('/obat/{id}', [AdminController::class, 'deleteObat'])->name('obat.delete');
});

// Protected Pasien Routes
Route::middleware([PasienMiddleware::class])->group(function () {
    Route::get('/poli/jadwal', [PasienController::class, 'listJadwal'])->name('poli.schedule');
    Route::get('/poli/daftar/{idJadwal}', [PasienController::class, 'daftarPoliForm'])->name('poli.daftar.form');
    Route::post('/poli/daftar', [PasienController::class, 'daftarPoli'])->name('poli.daftar');
});

// Logout Route
Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
