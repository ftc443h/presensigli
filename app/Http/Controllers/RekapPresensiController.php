<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Illuminate\Http\Request;
use App\Exports\RekapBKExport;
use App\Exports\RekapHKExport;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class RekapPresensiController extends Controller
{
    /**
     * Menampilkan halaman rekap presensi admin
     *
     * @return \Illuminate\View\View
     */
    public function rekapPresensi()
    {
        return view('admin.rekap_presensi.index', [
            'active' => 'rekapPresensi'
        ]);
    }


    /**
     * Menampilkan halaman rekap presensi karyawan
     *
     * @return \Illuminate\View\View
     */
    public function rekapHarianKaryawan()
    {
        return view('karyawan.rekap_presensi.harian');
    }

    public function rekapHarianKaryawanData(Request $request)
    {
        App::setLocale('id');
        Carbon::setLocale('id');

        $idKaryawan = Auth::user()->karyawan->id;

        $query = Presensi::query()
            ->where('karyawan_id', $idKaryawan)
            ->with(['lokasiPresensi', 'karyawan'])
            ->orderBy('tanggal_masuk', 'desc');

        // Filter by date
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $start = Carbon::parse($request->start_date)->startOfDay();
            $end = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('tanggal_masuk', [$start, $end]);
        }


        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('tanggal', function ($row) {
                return Carbon::parse($row->tanggal_masuk)->translatedFormat('d F Y');
            })
            ->addColumn('jam_masuk', function ($row) {
                return Carbon::parse($row->jam_masuk)->format('H:i:s');
            })
            ->addColumn('jam_keluar', function ($row) {
                return $row->jam_keluar ? Carbon::parse($row->jam_keluar)->format('H:i:s') : '-';
            })
            ->addColumn('total_jam', function ($row) {
                if ($row->jam_masuk && $row->jam_keluar) {
                    $jamMasuk = Carbon::parse($row->jam_masuk);
                    $jamKeluar = Carbon::parse($row->jam_keluar);
                    return $jamMasuk->diff($jamKeluar)->format('%h Jam %i Menit');
                }
                return '-';
            })
            ->addColumn('terlambat', function ($row) {
                $idealMasuk = Carbon::parse($row->lokasiPresensi->jam_masuk);
                $jamMasuk = Carbon::parse($row->jam_masuk);
                return $jamMasuk->gt($idealMasuk)
                    ? $idealMasuk->diff($jamMasuk)->format('%h Jam %i Menit')
                    : '0 Jam 0 Menit';
            })
            ->rawColumns(['tanggal', 'jam_masuk', 'jam_keluar', 'total_jam', 'terlambat'])
            ->make(true);
    }

    public function exportRHKExcel(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        return Excel::download(
            new RekapHKExport($startDate, $endDate),
            'rekap_harian_' . Auth::user()->karyawan->name . '_' . Carbon::now()->format('Y-m-d_H-i-s') . '.xlsx'
        );
    }

    public function exportRHKPdf(Request $request)
    {
        App::setLocale('id');
        Carbon::setLocale('id');

        $Karyawan = Auth::user()->karyawan;
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $data = Presensi::with(['lokasiPresensi'])
            ->where('karyawan_id', $Karyawan->id)
            ->whereBetween('tanggal_masuk', [$startDate, $endDate])
            ->orderBy('tanggal_masuk', 'desc')
            ->get();

        $pdf = Pdf::loadView(
            'karyawan.rekap_presensi.exports.rekap-harian-pdf',
            compact(
                'data',
                'startDate',
                'endDate',
                'Karyawan'
            )
        )
            ->setPaper('A4', 'landscape');

        return $pdf->download(
            'rekap_harian_' . Auth::user()->karyawan->name . '_' . Carbon::now()->format('Y-m-d_H-i-s') . '.pdf'
        );
    }

    public function rekapBulananKaryawan()
    {
        return view('karyawan.rekap_presensi.bulanan');
    }

    public function rekapBulananKaryawanData(Request $request)
    {
        App::setLocale('id');
        Carbon::setLocale('id');

        $idKaryawan = Auth::user()->karyawan->id;

        $query = Presensi::query()
            ->where('karyawan_id', $idKaryawan)
            ->with(['lokasiPresensi', 'karyawan'])
            ->orderBy('tanggal_masuk', 'desc');

        // Filter by month and year
        if ($request->filled('bulan') && $request->filled('tahun')) {
            $start = Carbon::createFromDate($request->tahun, $request->bulan, 1)->startOfMonth();
            $end = Carbon::createFromDate($request->tahun, $request->bulan, 1)->endOfMonth();
            $query->whereBetween('tanggal_masuk', [$start, $end]);
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('tanggal', function ($row) {
                return Carbon::parse($row->tanggal_masuk)->translatedFormat('d F Y');
            })
            ->addColumn('jam_masuk', function ($row) {
                return $row->jam_masuk ? Carbon::parse($row->jam_masuk)->format('H:i:s') : '-';
            })
            ->addColumn('jam_keluar', function ($row) {
                return $row->jam_keluar ? Carbon::parse($row->jam_keluar)->format('H:i:s') : '-';
            })
            ->addColumn('total_jam', function ($row) {
                if ($row->jam_masuk && $row->jam_keluar) {
                    $jamMasuk = Carbon::parse($row->jam_masuk);
                    $jamKeluar = Carbon::parse($row->jam_keluar);
                    return $jamMasuk->diff($jamKeluar)->format('%h Jam %i Menit');
                }
                return '-';
            })
            ->addColumn('terlambat', function ($row) {
                if ($row->jam_masuk && $row->lokasiPresensi) {
                    $ideal = Carbon::parse($row->lokasiPresensi->jam_masuk);
                    $masuk = Carbon::parse($row->jam_masuk);
                    return $masuk->gt($ideal)
                        ? $ideal->diff($masuk)->format('%h Jam %i Menit')
                        : '0 Jam 0 Menit';
                }
                return '-';
            })
            ->rawColumns(['tanggal', 'jam_masuk', 'jam_keluar', 'total_jam', 'terlambat'])
            ->make(true);
    }
    public function exportRBKExcel(Request $request)
    {
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');

        return Excel::download(
            new RekapBKExport($bulan, $tahun),
            'rekap_bulanan_' . Auth::user()->karyawan->name . '_' . Carbon::now()->format('Y-m-d_H-i-s') . '.xlsx'
        );
    }

    public function exportRBKPdf(Request $request)
    {
        App::setLocale('id');
        Carbon::setLocale('id');

        $Karyawan = Auth::user()->karyawan;
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');

        $data = Presensi::with(['lokasiPresensi'])
            ->where('karyawan_id', $Karyawan->id)
            ->whereMonth('tanggal_masuk', $bulan)
            ->whereYear('tanggal_masuk', $tahun)
            ->orderBy('tanggal_masuk', 'desc')
            ->get();

        $pdf = Pdf::loadView(
            'karyawan.rekap_presensi.exports.rekap-bulanan-pdf',
            compact(
                'data',
                'bulan',
                'tahun',
                'Karyawan'
            )
        )
            ->setPaper('A4', 'landscape');

        return $pdf->download(
            'rekap_bulanan_' . Auth::user()->karyawan->name . '_' . Carbon::now()->format('Y-m-d_H-i-s') . '.pdf'
        );
    }
}