<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\LokasiPresensiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {

    Route::middleware(['role:admin'])->group(function () {

        // Group Prefix Dashboard
        Route::prefix('dashboard')->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard.index');
        });

        // Group Prefix Karyawan
        Route::prefix('karyawan')->group(function () {
            Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
            Route::post('/karyawan', [KaryawanController::class, 'store'])->name('karyawan.store');
            Route::put('/karyawan/{karyawan}', [KaryawanController::class, 'update'])->name('karyawan.update');
            Route::patch('/karyawan/{karyawan}', [KaryawanController::class, 'update'])->name('karyawan.update');
            Route::delete('/karyawan/{karyawan}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');
        });

        // Group Prefix Master Data
        Route::prefix('master-data')->group(function () {
            // Jabatan
            Route::get('/jabatan', [JabatanController::class, 'index'])->name('jabatan.index');
            Route::post('/jabatan', [JabatanController::class, 'store'])->name('jabatan.store');
            Route::put('/jabatan/{jabatan}', [JabatanController::class, 'update'])->name('jabatan.update');
            Route::patch('/jabatan/{jabatan}', [JabatanController::class, 'update'])->name('jabatan.update');
            Route::delete('/jabatan/{jabatan}', [JabatanController::class, 'destroy'])->name('jabatan.destroy');

            // Lokasi Presensi
            Route::get('/lokasi-presensi', [LokasiPresensiController::class, 'index'])->name('lokasi-presensi.index');
            Route::post('/lokasi-presensi', [LokasiPresensiController::class, 'store'])->name('lokasi-presensi.store');
            Route::put('/lokasi-presensi/{lokasi_presensi}', [LokasiPresensiController::class, 'update'])->name('lokasi-presensi.update');
            Route::patch('/lokasi-presensi/{lokasi_presensi}', [LokasiPresensiController::class, 'update'])->name('lokasi-presensi.update');
            Route::delete('/lokasi-presensi/{lokasi_presensi}', [LokasiPresensiController::class, 'destroy'])->name('lokasi-presensi.destroy');
        });

        // Group Prefix Rekap Karyawan
        // Route::prefix('rekap-karyawan')->group(function () {
        //     //
        // });
    });


    Route::middleware(['role:karyawan'])->group(function () {

        // Group Prefix Dashboard
        Route::prefix('dashboard-karyawan')->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'karyawan'])->name('karyawan.dashboard');
        });

        // Group Prefix Rekap Presensi
        // Route::prefix('rekap-presensi')->group(function () {
        //     //
        // });
    });
});
