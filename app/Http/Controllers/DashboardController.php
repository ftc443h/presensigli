<?php

namespace App\Http\Controllers;

use App\Models\Ketidakhadiran;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Presensi;
use Illuminate\Http\Request;
use App\Models\LokasiPresensi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        Carbon::setLocale('id');

        // Ambil semua karyawan yang statusnya aktif dan memiliki karyawan_id
        $idEmployees = User::where('status', 'active')
            ->whereNotNull('karyawan_id')
            ->pluck('karyawan_id');

        // Ambil tanggal hari ini
        $today = Carbon::today()->toDateString();

        // Hitung jumlah karyawan yang active
        $user = $idEmployees->count();

        // Hadir -> Hitung jumlah karyawan yang hadir hari ini
        $hadir = Presensi::whereIn('karyawan_id', $idEmployees)
            ->whereDate('tanggal_masuk', $today)
            ->distinct('karyawan_id')
            ->count('karyawan_id');

        // Sakit, Izin, Cuti -> Hitung jumlah karyawan yang sakit, izin, atau cuti hari ini
        $sakit = Ketidakhadiran::whereIn('karyawan_id', $idEmployees)
            ->where('keterangan', 'Sakit')
            ->whereDate('tanggal', $today)
            ->count();

        $izin = Ketidakhadiran::whereIn('karyawan_id', $idEmployees)
            ->where('keterangan', 'Izin')
            ->whereDate('tanggal', $today)
            ->count();

        $cuti = Ketidakhadiran::whereIn('karyawan_id', $idEmployees)
            ->where('keterangan', 'Cuti')
            ->whereDate('tanggal', $today)
            ->count();

        $total_tidak_hadir_resmi = $sakit + $izin + $cuti;

        // Alpa -> Hitung jumlah karyawan yang tidak hadir resmi hari ini
        $alpa = $user - ($hadir + $total_tidak_hadir_resmi);



        return view(
            'admin.dashboard.index',
            compact(
                'user',
                'hadir',
                'sakit',
                'izin',
                'cuti',
                'alpa'
            )
        );
    }

    public function karyawan()
    {
        $idKaryawan = Auth::user()->karyawan->id;
        $today = now()->format('Y-m-d');

        $lokasi = LokasiPresensi::where(
            'nama_lokasi',
            Auth::user()->karyawan->lokasi_presensi
        )->firstOrFail();

        // Atur timezone sesuai zona waktu lokasi
        switch (strtoupper($lokasi->zona_waktu)) {
            case 'WITA':
                date_default_timezone_set('Asia/Makassar');
                break;
            case 'WIT':
                date_default_timezone_set('Asia/Jayapura');
                break;
            default:
                date_default_timezone_set('Asia/Jakarta');
                break;
        }

        // Cek apakah karyawan sudah melakukan presensi hari ini
        $cekPresensi = Presensi::where('karyawan_id', $idKaryawan)
            ->where('tanggal_masuk', $today)
            ->first();

        return view(
            'karyawan.dashboard.index',
            compact('cekPresensi', 'lokasi')
        );
    }
}
