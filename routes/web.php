<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\RekapPresensiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {
    // Group Prefix Dashboard
    Route::prefix('dashboard')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard.index');
    });

    // Group Prefix Karyawan
    Route::prefix('karyawan')->group(function () {
        // Route Prefix GET
        Route::get('/', [KaryawanController::class, 'karyawan'])->name('karyawan.index');
        Route::get('/foto-karyawan/{filename}', [KaryawanController::class, 'fotoKaryawan'])->name('karyawan.fotoKaryawan');
        Route::get('/data-karyawan', [KaryawanController::class, 'dataKaryawan'])->name('karyawan.dataKaryawan');

        // Route Prefix POST
        Route::post('/insert-karyawan', [KaryawanController::class, 'insertKaryawan'])->name('karyawan.insertKaryawan');

        // Route Prefix Edit
        Route::put('/update-karyawan', [KaryawanController::class, 'updateKaryawan'])->name('karyawan.updateKaryawan');

        // Route Prefix First Edit
        Route::get('/edit-karyawan/{id}', [KaryawanController::class, 'getEditKaryawan'])->name('karyawan.getEditKaryawan');
    });

    // Group Prefix Master Data
    Route::prefix('master-data')->group(function () {
        Route::get('/position', [MasterDataController::class, 'masterData'])->name('master_data.index');
    });

    // Group Prefix Rekap Presensi
    Route::prefix('rekap-presensi')->group(function () {
        Route::get('/attendance-summary', [RekapPresensiController::class, 'rekapPresensi'])->name('rekap_presensi.index');
    });
});
