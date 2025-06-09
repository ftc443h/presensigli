<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {

    // Group Prefix Dashboard
    Route::middleware(['role:admin'])->prefix('dashboard')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard.index');
    });

    // Group Prefix Karyawan
    Route::middleware(['role:karyawan'])->prefix('karyawan')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'karyawan'])->name('karyawan.dashboard');
    });
});
