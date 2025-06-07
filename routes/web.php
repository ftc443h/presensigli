<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {

    // Group Prefix Dashboard
    Route::prefix('dashboard')->group(function() {
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard.index');
    });

    // Group Prexif Karyawan
    Route::prefix('karyawan')->group(function() {
        Route::get('/karyawan', [KaryawanController::class, 'karyawan'])->name('karyawan.index');
    });

});
