<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exports\AbsenceExport;
use App\Models\Ketidakhadiran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class KetidakhadiranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Carbon::setLocale('id');

        $idKaryawan = Auth::user()->karyawan->id;

        $absences = Ketidakhadiran::where('karyawan_id', $idKaryawan)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view(
            'karyawan.ketidakhadiran.index',
            compact('absences')
        );
    }

    public function data(Request $request)
    {
        Carbon::setLocale('id');

        $idKaryawan = Auth::user()->karyawan->id;

        $query = Ketidakhadiran::where('karyawan_id', $idKaryawan)
            ->orderBy('tanggal', 'desc');

        if ($request->has('tanggal') && $request->tanggal != '') {
            $query->whereDate('tanggal', $request->tanggal);
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('tanggal', fn($row) => Carbon::parse($row->tanggal)->translatedFormat('d F Y'))
            ->addColumn('keterangan', fn($row) => $row->keterangan)
            ->addColumn('deskripsi', fn($row) => $row->deskripsi ?? '-')
            ->addColumn('file', function ($row) {
                if ($row->file) {
                    $url = asset('storage/' . $row->file);
                    return "<a href='$url' class='btn btn-sm btn-success' download>Download</a>";
                }
                return '<span class="text-muted">No File</span>';
            })
            ->addColumn('status_pengajuan', function ($row) {
                return match ($row->status_pengajuan) {
                    'pending' => '<span class="badge bg-warning text-dark badge-pill">PENDING</span>',
                    'approved' => '<span class="badge bg-success badge-pill">APPROVED</span>',
                    'rejected' => '<span class="badge bg-danger badge-pill">REJECTED</span>',
                    default => '<span class="badge bg-secondary badge-pill">UNKNOWN</span>',
                };
            })
            ->addColumn('action', function ($row) {
                if ($row->status_pengajuan == 'pending') {
                    $deleteRoute = route('ketidakhadiran.destroy', $row->id);
                    return '
                        <button class="btn btn-sm btn-primary btn-edit rounded-pill" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#editAbsenceModal">
                            <span class="text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                    <path
                                        d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                    <path d="M16 5l3 3" />
                                </svg>
                            </span>
                            Edit
                        </button>
                        <form action="' . $deleteRoute . '" method="POST" class="d-inline delete-form">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit"
                                class="btn btn-sm btn-danger rounded-pill text-bg-danger btn-delete">
                                <span class="text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M4 7l16 0" />
                                        <path d="M10 11l0 6" />
                                        <path d="M14 11l0 6" />
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    </svg>
                                </span>
                                Hapus
                            </button>
                        </form>
                    ';
                }
                return '<span class="text-muted">No Action</span>';
            })
            ->rawColumns(['file', 'status_pengajuan', 'action'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'keterangan' => 'required|string|max:50',
                'tanggal' => 'required|date',
                'deskripsi' => 'nullable|string|max:255',
                'file' => 'nullable|mimes:png,jpg,jpeg,pdf|max:2048',
            ]);

            // take file path
            $filePath = null;
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filePath = $file->storeAs(
                    'ketidakhadiran',
                    time() . '_' . $file->getClientOriginalName(),
                    'public'
                );
            }

            Ketidakhadiran::create([
                'keterangan' => $request->keterangan,
                'tanggal' => $request->tanggal,
                'deskripsi' => $request->deskripsi,
                'file' => $filePath,
                'status_pengajuan' => 'pending',
                'karyawan_id' => Auth::user()->karyawan->id,
            ]);

            return redirect()->route('ketidakhadiran.index')->with(
                'success',
                'Pengajuan ketidakhadiran berhasil dikirim.'
            );
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error',
                'Terjadi kesalahan saat mengirim pengajuan ketidakhadiran: ' . $th->getMessage()
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ketidakhadiran $ketidakhadiran)
    {
        $absence = Ketidakhadiran::findOrFail($ketidakhadiran->id);

        return view(
            'karyawan.ketidakhadiran.partials.edit-modal',
            compact('absence')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ketidakhadiran $ketidakhadiran)
    {
        try {
            $request->validate([
                'keterangan' => 'required|string|max:50',
                'tanggal' => 'required|date',
                'deskripsi' => 'nullable|string|max:255',
                'file' => 'nullable|mimes:png,jpg,jpeg,pdf|max:2048',
            ]);

            // take file path
            $filePath = $ketidakhadiran->file;
            if ($request->hasFile('file')) {
                if ($filePath && file_exists(
                    storage_path('app/public/' . $filePath)
                )) {
                    unlink(
                        storage_path('app/public/' . $filePath)
                    );
                }
                $file = $request->file('file');
                $filePath = $file->storeAs(
                    'ketidakhadiran',
                    time() . '_' . $file->getClientOriginalName(),
                    'public'
                );
            }

            $ketidakhadiran->update([
                'keterangan' => $request->keterangan,
                'tanggal' => $request->tanggal,
                'deskripsi' => $request->deskripsi,
                'file' => $filePath,
            ]);

            return redirect()->route('ketidakhadiran.index')->with(
                'success',
                'Pengajuan ketidakhadiran berhasil diubah.'
            );
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error',
                'Terjadi kesalahan saat mengubah pengajuan ketidakhadiran: ' . $th->getMessage()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ketidakhadiran $ketidakhadiran)
    {
        try {
            // Delete file if exists
            if ($ketidakhadiran->file && file_exists(
                storage_path('app/public/' . $ketidakhadiran->file)
            )) {
                unlink(
                    storage_path('app/public/' . $ketidakhadiran->file)
                );
            }

            $ketidakhadiran->delete();

            return redirect()->route('ketidakhadiran.index')->with(
                'success',
                'Pengajuan ketidakhadiran berhasil dihapus.'
            );
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error',
                'Terjadi kesalahan saat menghapus pengajuan ketidakhadiran: ' . $th->getMessage()
            );
        }
    }


    /**
     * Display a listing of the resource for admin.
     */
    public function adminIndex()
    {
        return view('admin.ketidakhadiran.index');
    }

    public function adminData(Request $request)
    {
        Carbon::setLocale('id');

        $query = Ketidakhadiran::with(['karyawan'])
            ->orderBy('tanggal', 'desc');

        if ($request->has('keterangan') && $request->keterangan != '') {
            $query->where('status_pengajuan', $request->keterangan);
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('name', fn($row) => $row->karyawan->name ?? '')
            ->addColumn('tanggal', fn($row) => Carbon::parse($row->tanggal)->translatedFormat('d F Y'))
            ->addColumn('keterangan', fn($row) => $row->keterangan)
            ->addColumn('deskripsi', fn($row) => $row->deskripsi ?? '-')
            ->addColumn('file', function ($row) {
                if ($row->file) {
                    $url = asset('storage/' . $row->file);
                    return "<a href='$url' class='btn btn-sm btn-success' download>Download</a>";
                }
                return '<span class="text-muted">No File</span>';
            })
            ->addColumn('status_pengajuan', function ($row) {
                return match ($row->status_pengajuan) {
                    'pending' => '<span class="badge bg-warning text-dark badge-pill">Pending</span>',
                    'approved' => '<span class="badge bg-success text-light badge-pill">Approved</span>',
                    'rejected' => '<span class="badge bg-danger text-light badge-pill">Rejected</span>',
                    default => '<span class="badge bg-secondary badge-pill">Unknown</span>',
                };
            })
            ->addColumn('action', function ($row) {
                if ($row->status_pengajuan == 'pending') {
                    $approveRoute = route('ketidakhadiran.admin.approve', $row->id);
                    $rejectRoute = route('ketidakhadiran.admin.reject', $row->id);
                    return '
                        <form action="' . $approveRoute . '" method="POST" class="d-inline">
                            ' . csrf_field() . '
                            ' . method_field('PUT') . '
                            <button type="submit" class="btn btn-sm btn-success rounded-pill">APPROVED</button>
                        </form>
                        <form action="' . $rejectRoute . '" method="POST" class="d-inline">
                            ' . csrf_field() . '
                            ' . method_field('PUT') . '
                            <button type="submit" class="btn btn-sm btn-danger rounded-pill">REJECTED</button>
                        </form>
                    ';
                }
                return '<span class="text-muted">No Action</span>';
            })
            ->rawColumns(['file', 'status_pengajuan', 'action'])
            ->make(true);
    }

    /**
     * Approve the specified resource.
     */
    public function approve(Ketidakhadiran $ketidakhadiran)
    {
        try {
            $ketidakhadiran->update(['status_pengajuan' => 'approved']);

            return redirect()->route('ketidakhadiran.admin.index')->with(
                'success',
                'Pengajuan ketidakhadiran berhasil disetujui.'
            );
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error',
                'Terjadi kesalahan saat menyetujui pengajuan ketidakhadiran: ' . $th->getMessage()
            );
        }
    }

    /**
     * Reject the specified resource.
     */
    public function reject(Ketidakhadiran $ketidakhadiran)
    {
        try {
            $ketidakhadiran->update(['status_pengajuan' => 'rejected']);

            return redirect()->route('ketidakhadiran.admin.index')->with(
                'success',
                'Pengajuan ketidakhadiran berhasil ditolak.'
            );
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error',
                'Terjadi kesalahan saat menolak pengajuan ketidakhadiran: ' . $th->getMessage()
            );
        }
    }

    /**
     * Export data to Excel.
     */
    public function exportExcel(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        if (!$startDate || !$endDate) {
            return redirect()->back()->with('error', 'Tanggal mulai dan akhir harus diisi.');
        }

        return Excel::download(
            new AbsenceExport($startDate, $endDate),
            'absence_' . $startDate . '_to_' . $endDate . '.xlsx'
        );
    }

    /**
     * Export data to PDF.
     */
    public function exportPdf(Request $request)
    {
        App::setLocale('id');
        Carbon::setLocale('id');

        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
        if (!$startDate || !$endDate) {
            return redirect()->back()->with('error', 'Tanggal mulai dan akhir harus diisi.');
        }

        $data = Ketidakhadiran::with('karyawan')
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->orderBy('tanggal', 'desc')
            ->get();

        $pdf = Pdf::loadView(
            'admin.ketidakhadiran.absence-pdf',
            compact('data', 'startDate', 'endDate')
        )->setPaper('A4', 'landscape');

        return $pdf->download(
            'absence_' . $startDate . '_to_' . $endDate . '.pdf'
        );
    }
}
