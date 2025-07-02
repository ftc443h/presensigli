<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RekapPresensiController;
use App\Http\Controllers\KetidakhadiranController;
use App\Http\Controllers\LokasiPresensiController;

Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {

    Route::middleware(['role:admin'])->group(function () {

        // Group Prefix Dashboard
        Route::prefix('dashboard')->group(function () {
            Route::get(
                '/dashboard',
                [DashboardController::class, 'dashboard']
            )->name('dashboard.index');
            Route::get(
                '/profile',
                [ProfileController::class, 'showAdmin']
            )->name('profile.admin.show');
        });

        // Group Prefix Karyawan
        Route::prefix('karyawan')->group(function () {
            Route::get(
                '/karyawan',
                [KaryawanController::class, 'index']
            )->name('karyawan.index');
            Route::post(
                '/karyawan',
                [KaryawanController::class, 'store']
            )->name('karyawan.store');
            Route::put(
                '/karyawan/{karyawan}',
                [KaryawanController::class, 'update']
            )->name('karyawan.update');
            Route::patch(
                '/karyawan/{karyawan}',
                [KaryawanController::class, 'update']
            )->name('karyawan.update');
            Route::delete(
                '/karyawan/{karyawan}',
                [KaryawanController::class, 'destroy']
            )->name('karyawan.destroy');
        });

        // Group Prefix Master Data
        Route::prefix('master-data')->group(function () {
            // Jabatan
            Route::get(
                '/jabatan',
                [JabatanController::class, 'index']
            )->name('jabatan.index');
            Route::post(
                '/jabatan',
                [JabatanController::class, 'store']
            )->name('jabatan.store');
            Route::put(
                '/jabatan/{jabatan}',
                [JabatanController::class, 'update']
            )->name('jabatan.update');
            Route::patch(
                '/jabatan/{jabatan}',
                [JabatanController::class, 'update']
            )->name('jabatan.update');
            Route::delete(
                '/jabatan/{jabatan}',
                [JabatanController::class, 'destroy']
            )->name('jabatan.destroy');

            // Lokasi Presensi
            Route::get(
                '/lokasi-presensi',
                [LokasiPresensiController::class, 'index']
            )->name('lokasi-presensi.index');
            Route::post(
                '/lokasi-presensi',
                [LokasiPresensiController::class, 'store']
            )->name('lokasi-presensi.store');
            Route::put(
                '/lokasi-presensi/{lokasi_presensi}',
                [LokasiPresensiController::class, 'update']
            )->name('lokasi-presensi.update');
            Route::patch(
                '/lokasi-presensi/{lokasi_presensi}',
                [LokasiPresensiController::class, 'update']
            )->name('lokasi-presensi.update');
            Route::delete(
                '/lokasi-presensi/{lokasi_presensi}',
                [LokasiPresensiController::class, 'destroy']
            )->name('lokasi-presensi.destroy');
        });

        // Group Prefix Rekap Karyawan
        Route::prefix('rekap-karyawan')->group(function () {
            // Rekap Harian
            Route::get(
                '/rekap-harian',
                [RekapPresensiController::class, 'rekapHarian']
            )->name('rekap-harian.index');
            Route::get(
                '/rekap-harian/data',
                [RekapPresensiController::class, 'rekapHarianData']
            )->name('rekap-harian.data');
            Route::get(
                '/rekap-harian/export-excel',
                [RekapPresensiController::class, 'exportRHExcel']
            )->name('rekap-harian.export.excel');
            Route::get(
                '/rekap-harian/export-pdf',
                [RekapPresensiController::class, 'exportRHPdf']
            )->name('rekap-harian.export.pdf');

            // Rekap Bulanan
            Route::get(
                '/rekap-bulanan',
                [RekapPresensiController::class, 'rekapBulanan']
            )->name('rekap-bulanan.index');
            Route::get(
                '/rekap-bulanan/data',
                [RekapPresensiController::class, 'rekapBulananData']
            )->name('rekap-bulanan.data');
            Route::get(
                '/rekap-bulanan/export-excel',
                [RekapPresensiController::class, 'exportRBExcel']
            )->name('rekap-bulanan.export.excel');
            Route::get(
                '/rekap-bulanan/export-pdf',
                [RekapPresensiController::class, 'exportRBPdf']
            )->name('rekap-bulanan.export.pdf');
        });

        // Group Prefix Ketidakhadiran Admin
        Route::prefix('ketidakhadiran-admin')->group(function () {
            Route::get(
                '/ketidakhadiran',
                [KetidakhadiranController::class, 'adminIndex']
            )->name('ketidakhadiran.admin.index');
            Route::get(
                '/ketidakhadiran/data-admin',
                [KetidakhadiranController::class, 'adminData']
            )->name('ketidakhadiran.admin.data');
            Route::put(
                '/ketidakhadiran/{ketidakhadiran}/approve',
                [KetidakhadiranController::class, 'approve']
            )->name('ketidakhadiran.admin.approve');
            Route::patch(
                '/ketidakhadiran/{ketidakhadiran}/approve',
                [KetidakhadiranController::class, 'approve']
            )->name('ketidakhadiran.admin.approve');
            Route::put(
                '/ketidakhadiran/{ketidakhadiran}/reject',
                [KetidakhadiranController::class, 'reject']
            )->name('ketidakhadiran.admin.reject');
            Route::patch(
                '/ketidakhadiran/{ketidakhadiran}/reject',
                [KetidakhadiranController::class, 'reject']
            )->name('ketidakhadiran.admin.reject');
            Route::get(
                '/ketidakhadiran/export-excel',
                [KetidakhadiranController::class, 'exportExcel']
            )->name('ketidakhadiran.admin.export.excel');
            Route::get(
                '/ketidakhadiran/export-pdf',
                [KetidakhadiranController::class, 'exportPdf']
            )->name('ketidakhadiran.admin.export.pdf');
        });
    });


    Route::middleware(['role:karyawan'])->group(function () {

        // Group Prefix Dashboard
        Route::prefix('dashboard-karyawan')->group(function () {
            Route::get(
                '/dashboard',
                [DashboardController::class, 'karyawan']
            )->name('karyawan.dashboard');
            Route::get(
                '/profile',
                [ProfileController::class, 'showKaryawan']
            )->name('profile.karyawan.show');
        });

        // Group Prefix Presensi
        Route::prefix('presensi')->group(function () {
            Route::get(
                '/presensi/masuk',
                [PresensiController::class, 'presensiMasukCam']
            )->name('presensi.masuk');
            Route::post(
                '/presensi/masuk',
                [PresensiController::class, 'presensiMasuk']
            )->name('presensi.store');
            Route::get(
                '/presensi/keluar',
                [PresensiController::class, 'presensiKeluarCam']
            )->name('presensi.keluar');
            Route::post(
                '/presensi/keluar',
                [PresensiController::class, 'presensiKeluar']
            )->name('presensi.keluar.store');
        });

        // Group Prefix Rekap Presensi
        Route::prefix('rekap-presensi')->group(function () {
            // Rekap Harian
            Route::get(
                '/rekap-harian',
                [RekapPresensiController::class, 'rekapHarianKaryawan']
            )->name('rekap-harian.karyawan.index');
            Route::get(
                '/rekap-harian/data',
                [RekapPresensiController::class, 'rekapHarianKaryawanData']
            )->name('rekap-harian.karyawan.data');
            Route::get(
                '/rekap-harian/export-excel',
                [RekapPresensiController::class, 'exportRHKExcel']
            )->name('rekap-harian.karyawan.export.excel');
            Route::get(
                '/rekap-harian/export-pdf',
                [RekapPresensiController::class, 'exportRHKPdf']
            )->name('rekap-harian.karyawan.export.pdf');

            // Rekap Bulanan
            Route::get(
                '/rekap-bulanan',
                [RekapPresensiController::class, 'rekapBulananKaryawan']
            )->name('rekap-bulanan.karyawan.index');
            Route::get(
                '/rekap-bulanan/data',
                [RekapPresensiController::class, 'rekapBulananKaryawanData']
            )->name('rekap-bulanan.karyawan.data');
            Route::get(
                '/rekap-bulanan/export-excel',
                [RekapPresensiController::class, 'exportRBKExcel']
            )->name('rekap-bulanan.karyawan.export.excel');
            Route::get(
                '/rekap-bulanan/export-pdf',
                [RekapPresensiController::class, 'exportRBKPdf']
            )->name('rekap-bulanan.karyawan.export.pdf');
        });

        // Group Prefix Ketidakhadiran
        Route::prefix('ketidakhadiran')->group(function () {
            Route::get(
                '/ketidakhadiran',
                [KetidakhadiranController::class, 'index']
            )->name('ketidakhadiran.index');
            Route::get(
                '/ketidakhadiran/data',
                [KetidakhadiranController::class, 'data']
            )->name('ketidakhadiran.data');
            Route::post(
                '/ketidakhadiran',
                [KetidakhadiranController::class, 'store']
            )->name('ketidakhadiran.store');
            Route::get(
                '/ketidakhadiran/{ketidakhadiran}/edit',
                [KetidakhadiranController::class, 'edit']
            )->name('ketidakhadiran.edit');
            Route::put(
                '/ketidakhadiran/{ketidakhadiran}',
                [KetidakhadiranController::class, 'update']
            )->name('ketidakhadiran.update');
            Route::patch(
                '/ketidakhadiran/{ketidakhadiran}',
                [KetidakhadiranController::class, 'update']
            )->name('ketidakhadiran.update');
            Route::delete(
                '/ketidakhadiran/{ketidakhadiran}',
                [KetidakhadiranController::class, 'destroy']
            )->name('ketidakhadiran.destroy');
        });
    });
});
