<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RekapPresensiController;
use App\Http\Controllers\KetidakhadiranController;
use App\Http\Controllers\LokasiPresensiController;
use App\Http\Controllers\Auth\ForgotPasswordController;

Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

Route::get(
    '/forgot-password',
    [ForgotPasswordController::class, 'showRequestForm']
)->name('auth.passwords.request');
Route::post(
    '/forgot-password',
    [ForgotPasswordController::class, 'sendOTP']
)->name('auth.passwords.email')
    ->middleware('throttle:otp');
Route::post(
    '/resend-otp',
    [ForgotPasswordController::class, 'resendOTP']
)->name('auth.passwords.resend-otp')
    ->middleware('throttle:otp');

Route::get(
    '/verify-otp',
    [ForgotPasswordController::class, 'showVerifyForm']
)->name('auth.passwords.verify-otp');
Route::post(
    '/verify-otp',
    [ForgotPasswordController::class, 'verifyOTP']
)->name('auth.passwords.verify');

Route::get(
    '/reset-password',
    [ForgotPasswordController::class, 'showResetForm']
)->name('auth.passwords.reset');
Route::post(
    '/reset-password',
    [ForgotPasswordController::class, 'resetPassword']
)->name('auth.passwords.update');


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
            Route::get(
                '/profile/edit-password',
                [ProfileController::class, 'editPasswordAdmin']
            )->name('profile.admin.edit-password');
            Route::put(
                '/profile/update-password',
                [ProfileController::class, 'updatePasswordAdmin']
            )->name('profile.admin.update-password');
            Route::patch(
                '/profile/update-password',
                [ProfileController::class, 'updatePasswordAdmin']
            )->name('profile.admin.update-password');
        });

        // Group Prefix Presensi
        Route::prefix('presensi')->group(function () {
            Route::get(
                '/presensi-admin',
                [PresensiController::class, 'presensiAdmin']
            )->name('presensi-admin.index');
            Route::get(
                '/presensi-admin/masuk-cam',
                [PresensiController::class, 'presensiMasukCamAdmin']
            )->name('presensi-admin.masuk');
            Route::post(
                '/presensi-admin/masuk',
                [PresensiController::class, 'presensiMasukAdmin']
            )->name('presensi-admin.store');
            Route::get(
                '/presensi-admin/keluar-cam',
                [PresensiController::class, 'presensiKeluarCamAdmin']
            )->name('presensi-admin.keluar');
            Route::post(
                '/presensi-admin/keluar',
                [PresensiController::class, 'presensiKeluarAdmin']
            )->name('presensi-admin.keluar.store');
        });


        // Group Prefix Karyawan
        Route::prefix('karyawan')->group(function () {
            Route::get(
                '/karyawan',
                [KaryawanController::class, 'index']
            )->name('karyawan.index');
            Route::get(
                '/karyawan/data',
                [KaryawanController::class, 'data']
            )->name('karyawan.data');
            Route::post(
                '/karyawan',
                [KaryawanController::class, 'store']
            )->name('karyawan.store');
            Route::get(
                '/karyawan/{karyawan}/edit',
                [KaryawanController::class, 'edit']
            )->name('karyawan.edit');
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
            Route::get(
                '/jabatan/data',
                [JabatanController::class, 'data']
            )->name('jabatan.data');
            Route::post(
                '/jabatan',
                [JabatanController::class, 'store']
            )->name('jabatan.store');
            Route::get(
                '/jabatan/{jabatan}/edit',
                [JabatanController::class, 'edit']
            )->name('jabatan.edit');
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
            Route::get(
                '/lokasi-presensi/data',
                [LokasiPresensiController::class, 'data']
            )->name('lokasi-presensi.data');
            Route::post(
                '/lokasi-presensi',
                [LokasiPresensiController::class, 'store']
            )->name('lokasi-presensi.store');
            Route::get(
                '/lokasi-presensi/{lokasiPresensi}/edit',
                [LokasiPresensiController::class, 'edit']
            )->name('lokasi-presensi.edit');
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
            Route::get(
                '/profile/edit-password',
                [ProfileController::class, 'editPasswordKaryawan']
            )->name('profile.karyawan.edit-password');
            Route::put(
                '/profile/update-password',
                [ProfileController::class, 'updatePasswordKaryawan']
            )->name('profile.karyawan.update-password');
            Route::patch(
                '/profile/update-password',
                [ProfileController::class, 'updatePasswordKaryawan']
            )->name('profile.karyawan.update-password');
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
