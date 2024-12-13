<?php

use App\Http\Controllers\LoginPasienController;
use App\Http\Controllers\LoginDokterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.home');
})->name('home');

//login/daftar pasien
Route::get('/daftar-pasien', [LoginPasienController::class, 'showRegisterForm'])->name('pasien.registerForm');
Route::post('/daftar-pasien', [LoginPasienController::class, 'register'])->name('pasien.register');
Route::get('/login-pasien', [LoginPasienController::class, 'showLoginForm'])->name('pasien.loginForm');
Route::post('/login-pasien', [LoginPasienController::class, 'login'])->name('pasien.login');

Route::get('pasien/dashboard', [PasienController::class, 'dashboard'])->name('pasien.dashboard');

//login dokter
Route::get('/login-dokter', [LoginDokterController::class, 'showLoginForm'])->name('dokter.loginForm');
Route::post('/login-dokter', [LoginDokterController::class, 'login'])->name('dokter.login');
Route::get('dokter/dashboard', [DokterController::class, 'dashboard'])->name('dokter.dashboard');
Route::get('/dashboard-admin', [AdminController::class, 'showDashboardAdmin'])->name('admin.index');
Route::get('/data-dokter', [AdminController::class, 'listDokter'])->name('dokter.index');
Route::post('/dokter/store', [AdminController::class, 'storeDokter'])->name('dokter.store');
Route::get('/dokter/{id}/edit', [AdminController::class, 'editDokter'])->name('dokter.edit');
Route::put('/dokter/{id}', [AdminController::class, 'updateDokter'])->name('dokter.update');
Route::delete('/dokter/{id}', [AdminController::class, 'deleteDokter'])->name('dokter.destroy');

Route::get('/data-poli', [AdminController::class, 'listPoli'])->name('poli.index');
Route::post('/poli/store', [AdminController::class, 'storePoli'])->name('poli.store');
Route::get('poli/{id}/edit', [AdminController::class, 'editPoli'])->name('poli.edit');
Route::put('poli/{id}', [AdminController::class, 'updatePoli'])->name('poli.update');
Route::delete('poli/{id}', [AdminController::class, 'deletePoli'])->name('poli.delete');

Route::get('/data-pasien', [AdminController::class, 'listPasien'])->name('pasien.index');
Route::post('/admin/pasien', [AdminController::class, 'storePasien'])->name('pasien.store');
Route::get('/pasien/{id}/edit', [AdminController::class, 'editPasien'])->name('pasien.edit');
Route::put('/admin/pasien/{id}', [AdminController::class, 'updatePasien'])->name('pasien.update');
Route::delete('/admin/pasien/{id}', [AdminController::class, 'deletePasien'])->name('pasien.delete');

Route::get('/data-obat', [AdminController::class, 'listObat'])->name('obat.index');
Route::post('/obat/store', [AdminController::class, 'storeObat'])->name('obat.store');
Route::put('/obat/{id}/edit', [AdminController::class, 'editObat'])->name('obat.edit');
Route::put('/obat/{id}', [AdminController::class, 'updateObat'])->name('obat.update');
Route::delete('/obat/{id}', [AdminController::class, 'deleteObat'])->name('obat.delete');
Route::get('/logout', [AdminController::class, 'logout'])->name('logout');