<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Illuminate\Http\Request;
use App\Exports\RekapBExport;
use App\Exports\RekapHExport;
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
     * Menampilkan halaman rekap harian admin
     *
     * @return \Illuminate\View\View
     */
    public function rekapHarian()
    {
        return view('admin.rekap_presensi.harian');
    }

    /**
     * Get rekap harian data for DataTables
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function rekapHarianData(Request $request)
    {
        App::setLocale('id');
        Carbon::setLocale('id');

        $query = Presensi::query()
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
            ->addColumn('nip', fn($row) => $row->karyawan->nip)
            ->addColumn('nama', fn($row) => $row->karyawan->name)
            ->addColumn('tanggal', fn($row) => Carbon::parse($row->tanggal_masuk)->translatedFormat('d F Y'))
            ->addColumn('jam_masuk', fn($row) => $row->jam_masuk ? Carbon::parse($row->jam_masuk)->format('H:i:s') : '-')
            ->addColumn('jam_keluar', fn($row) => $row->jam_keluar ? Carbon::parse($row->jam_keluar)->format('H:i:s') : '-')
            ->addColumn('total_jam', function ($row) {
                return ($row->jam_masuk && $row->jam_keluar)
                    ? Carbon::parse($row->jam_masuk)->diff(Carbon::parse($row->jam_keluar))->format('%h Jam %i Menit')
                    : '-';
            })
            ->addColumn('terlambat', function ($row) {
                if ($row->jam_masuk && $row->lokasiPresensi) {
                    $ideal = Carbon::parse($row->lokasiPresensi->jam_masuk);
                    $masuk = Carbon::parse($row->jam_masuk);
                    return $masuk->gt($ideal)
                        ? $ideal->diff($masuk)->format('%h Jam %i Menit')
                        : '<span class="badge bg-success">On Time</span>';
                }
                return '-';
            })
            ->rawColumns(['nip', 'nama', 'tanggal', 'jam_masuk', 'jam_keluar', 'total_jam', 'terlambat'])
            ->make(true);
    }

    /**
     * Export rekap harian to Excel
     *
     * @param Request $request
     * 
     */
    public function exportRHExcel(Request $request)
    {
        $startDate = $request->query('start_date') ?? Carbon::now()->startOfMonth()->format('Y-m-d');
        $endDate = $request->query('end_date') ?? Carbon::now()->endOfDay()->format('Y-m-d');

        return Excel::download(
            new RekapHExport($startDate, $endDate),
            'rekap_harian_' . Carbon::now()->format('Y-m-d_H-i-s') . '.xlsx'
        );
    }

    /**
     * Export rekap harian to PDF
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function exportRHPdf(Request $request)
    {
        App::setLocale('id');
        Carbon::setLocale('id');

        $startDate = $request->query('start_date') ?? Carbon::now()->startOfMonth()->format('Y-m-d');
        $endDate = $request->query('end_date') ?? Carbon::now()->endOfDay()->format('Y-m-d');

        $data = Presensi::with(['lokasiPresensi', 'karyawan'])
            ->whereBetween('tanggal_masuk', [$startDate, $endDate])
            ->orderBy('tanggal_masuk', 'desc')
            ->get();

        $pdf = Pdf::loadView(
            'admin.rekap_presensi.exports.rekap-harian-pdf',
            compact('data', 'startDate', 'endDate')
        )
            ->setPaper('A4', 'landscape');

        return $pdf->download(
            'rekap_harian_' . Carbon::now()->format('Y-m-d_H-i-s') . '.pdf'
        );
    }

    /**
     * Menampilkan halaman rekap bulanan admin
     *
     * @return \Illuminate\View\View
     */
    public function rekapBulanan()
    {
        return view('admin.rekap_presensi.bulanan');
    }

    /**
     * Get rekap bulanan data for DataTables
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function rekapBulananData(Request $request)
    {
        App::setLocale('id');
        Carbon::setLocale('id');

        $query = Presensi::query()
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
            ->addColumn('nip', fn($row) => $row->karyawan->nip)
            ->addColumn('nama', fn($row) => $row->karyawan->name)
            ->addColumn('tanggal', fn($row) => Carbon::parse($row->tanggal_masuk)->translatedFormat('d F Y'))
            ->addColumn('jam_masuk', fn($row) => $row->jam_masuk ? Carbon::parse($row->jam_masuk)->format('H:i:s') : '-')
            ->addColumn('jam_keluar', fn($row) => $row->jam_keluar ? Carbon::parse($row->jam_keluar)->format('H:i:s') : '-')
            ->addColumn('total_jam', function ($row) {
                return ($row->jam_masuk && $row->jam_keluar)
                    ? Carbon::parse($row->jam_masuk)->diff(Carbon::parse($row->jam_keluar))->format('%h Jam %i Menit')
                    : '-';
            })
            ->addColumn('terlambat', function ($row) {
                if ($row->jam_masuk && $row->lokasiPresensi) {
                    $ideal = Carbon::parse($row->lokasiPresensi->jam_masuk);
                    $masuk = Carbon::parse($row->jam_masuk);
                    return $masuk->gt($ideal)
                        ? $ideal->diff($masuk)->format('%h Jam %i Menit')
                        : '<span class="badge bg-success">On Time</span>';
                }
                return '-';
            })
            ->rawColumns(['nip', 'nama', 'tanggal', 'jam_masuk', 'jam_keluar', 'total_jam', 'terlambat'])
            ->make(true);
    }

    /**
     * Export rekap bulanan to Excel
     *
     * @param Request $request
     * 
     */
    public function exportRBExcel(Request $request)
    {
        $bulan = $request->query('bulan') ?? Carbon::now()->month;
        $tahun = $request->query('tahun') ?? Carbon::now()->year;

        return Excel::download(
            new RekapBExport($bulan, $tahun),
            'rekap_bulanan_' . Carbon::now()->format('Y-m-d_H-i-s') . '.xlsx'
        );
    }

    /**
     * Export rekap bulanan to PDF
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */ 
    public function exportRBPdf(Request $request)
    {
        App::setLocale('id');
        Carbon::setLocale('id');

        $bulan = $request->query('bulan') ?? Carbon::now()->month;
        $tahun = $request->query('tahun') ?? Carbon::now()->year;

        $data = Presensi::with(['lokasiPresensi', 'karyawan'])
            ->whereMonth('tanggal_masuk', $bulan)
            ->whereYear('tanggal_masuk', $tahun)
            ->orderBy('tanggal_masuk', 'desc')
            ->get();

        $pdf = Pdf::loadView(
            'admin.rekap_presensi.exports.rekap-bulanan-pdf',
            compact('data', 'bulan', 'tahun')
        )
            ->setPaper('A4', 'landscape');

        return $pdf->download(
            'rekap_bulanan_' . Carbon::now()->format('Y-m-d_H-i-s') . '.pdf'
        );
    }


    /**
     * Menampilkan halaman rekap harian karyawan
     *
     * @return \Illuminate\View\View
     */
    public function rekapHarianKaryawan()
    {
        return view('karyawan.rekap_presensi.harian');
    }

    /**
     * Get rekap harian karyawan data for DataTables
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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
                    : '<span class="badge bg-success">On Time</span>';
            })
            ->rawColumns(['tanggal', 'jam_masuk', 'jam_keluar', 'total_jam', 'terlambat'])
            ->make(true);
    }

    /**
     * Export rekap harian karyawan to Excel
     *
     * @param Request $request
     * 
     */
    public function exportRHKExcel(Request $request)
    {
        $startDate = $request->query('start_date') ?? Carbon::now()->startOfMonth()->format('Y-m-d');
        $endDate = $request->query('end_date') ?? Carbon::now()->endOfDay()->format('Y-m-d');

        return Excel::download(
            new RekapHKExport($startDate, $endDate),
            'rekap_harian_' . Auth::user()->karyawan->name . '_' . Carbon::now()->format('Y-m-d_H-i-s') . '.xlsx'
        );
    }

    /**
     * Export rekap harian karyawan to PDF
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function exportRHKPdf(Request $request)
    {
        App::setLocale('id');
        Carbon::setLocale('id');

        $Karyawan = Auth::user()->karyawan;
        $startDate = $request->query('start_date') ?? Carbon::now()->startOfMonth()->format('Y-m-d');
        $endDate = $request->query('end_date') ?? Carbon::now()->endOfDay()->format('Y-m-d');

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

    /**
     * Menampilkan halaman rekap bulanan karyawan
     *
     * @return \Illuminate\View\View
     */
    public function rekapBulananKaryawan()
    {
        return view('karyawan.rekap_presensi.bulanan');
    }

    /**
     * Get rekap bulanan karyawan data for DataTables
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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
                        : '<span class="badge bg-success">On Time</span>';
                }
                return '-';
            })
            ->rawColumns(['tanggal', 'jam_masuk', 'jam_keluar', 'total_jam', 'terlambat'])
            ->make(true);
    }

    /**
     * Export rekap bulanan karyawan to Excel
     *
     * @param Request $request
     * 
     */
    public function exportRBKExcel(Request $request)
    {
        $bulan = $request->query('bulan') ?? Carbon::now()->month;
        $tahun = $request->query('tahun') ?? Carbon::now()->year;

        return Excel::download(
            new RekapBKExport($bulan, $tahun),
            'rekap_bulanan_' . Auth::user()->karyawan->name . '_' . Carbon::now()->format('Y-m-d_H-i-s') . '.xlsx'
        );
    }

    /**
     * Export rekap bulanan karyawan to PDF
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function exportRBKPdf(Request $request)
    {
        App::setLocale('id');
        Carbon::setLocale('id');

        $Karyawan = Auth::user()->karyawan;
        $bulan = $request->query('bulan') ?? Carbon::now()->month;
        $tahun = $request->query('tahun') ?? Carbon::now()->year;

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
