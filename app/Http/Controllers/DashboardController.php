<?php

namespace App\Http\Controllers;

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
        $user = User::where('status', 'active')->count();
        return view('admin.dashboard.index', compact('user'));
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
