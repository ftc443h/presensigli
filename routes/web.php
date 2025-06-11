<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\RekapPresensiController;

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
        Route::get('/karyawan', [KaryawanController::class, 'karyawan'])->name('karyawan.index');
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
