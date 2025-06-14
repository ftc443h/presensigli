<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JabatanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {

    Route::middleware(['role:admin'])->group( function () {

        // Group Prefix Dashboard
        Route::prefix('dashboard')->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard.index');
        });
        
        // Group Prefix Karyawan
        // Route::prefix('karyawan')->group(function () {
        //     //
        // });
        
        // Group Prefix Master Data
        Route::prefix('master-data')->group(function () {
            Route::get('/jabatan', [JabatanController::class, 'index'])->name('jabatan.index');
            Route::post('/jabatan', [JabatanController::class, 'store'])->name('jabatan.store');
            Route::put('/jabatan/{jabatan}', [JabatanController::class, 'update'])->name('jabatan.update');
            Route::patch('/jabatan/{jabatan}', [JabatanController::class, 'update'])->name('jabatan.update');
            Route::delete('/jabatan/{jabatan}', [JabatanController::class, 'destroy'])->name('jabatan.destroy');
        });

        // Group Prefix Rekap Karyawan
        // Route::prefix('rekap-karyawan')->group(function () {
        //     //
        // });
    });


    Route::middleware(['role:karyawan'])->group( function () {

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