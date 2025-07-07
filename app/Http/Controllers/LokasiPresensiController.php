<?php

namespace App\Http\Controllers;

use App\Models\LokasiPresensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LokasiPresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = LokasiPresensi::all();
        return view('admin.master_data_lokasi.index', compact('locations'));
    }

    public function data(Request $request)
    {
        Carbon::setLocale('id');

        $query = LokasiPresensi::query();

        if ($request->has('nama_lokasi') && $request->nama_lokasi != '') {
            $query->where('nama_lokasi', 'like', '%' . $request->nama_lokasi . '%');
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('latlng', fn($row) => $row->latitude . '/' . $row->longitude)
            ->addColumn('action', function ($row) {
                $deleteRoute = route('lokasi-presensi.destroy', $row->id);
                return '
                <button class="btn btn-sm btn-primary btn-edit rounded-pill" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#editLocation">
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
            })
            ->rawColumns(['latlng', 'action'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate(
                [
                    'nama_lokasi' => 'required|string|max:45',
                    'alamat_lokasi' => 'required|string',
                    'latitude' => 'required|string|max:255',
                    'longitude' => 'required|string|max:255',
                    'radius' => 'required|numeric',
                    'zona_waktu' => 'required|string|max:4',
                    'jam_masuk' => 'required|date_format:H:i',
                    'jam_pulang' => 'required|date_format:H:i',
                ]
            );

            LokasiPresensi::create(
                [
                    'nama_lokasi' => $request->nama_lokasi,
                    'alamat_lokasi' => $request->alamat_lokasi,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
                    'radius' => $request->radius,
                    'zona_waktu' => $request->zona_waktu,
                    'jam_masuk' => $request->jam_masuk,
                    'jam_pulang' => $request->jam_pulang,
                ]
            );

            return redirect()->route('lokasi-presensi.index')->with(
                'success',
                'Data lokasi presensi berhasil ditambahkan!'
            );
        } catch (\Throwable $th) {
            return back()->with(
                'error',
                'Terjadi kesalahan dalam menambahkan data lokasi presensi!'
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LokasiPresensi $lokasiPresensi)
    {
        $location = LokasiPresensi::findOrFail($lokasiPresensi->id);

        return view(
            'admin.master_data_lokasi.partials.edit-modal',
            compact('location')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LokasiPresensi $lokasiPresensi)
    {
        try {
            $request->validate(
                [
                    'nama_lokasi' => 'required|string|max:45',
                    'alamat_lokasi' => 'required|string',
                    'latitude' => 'required|string|max:255',
                    'longitude' => 'required|string|max:255',
                    'radius' => 'required|numeric',
                    'zona_waktu' => 'required|string|max:4',
                    'jam_masuk' => 'required|date_format:H:i',
                    'jam_pulang' => 'required|date_format:H:i',
                ]
            );

            LokasiPresensi::where('id', $lokasiPresensi->id)
                ->update(
                    [
                        'nama_lokasi' => $request->nama_lokasi,
                        'alamat_lokasi' => $request->alamat_lokasi,
                        'latitude' => $request->latitude,
                        'longitude' => $request->longitude,
                        'radius' => $request->radius,
                        'zona_waktu' => $request->zona_waktu,
                        'jam_masuk' => $request->jam_masuk,
                        'jam_pulang' => $request->jam_pulang,
                    ]
                );

            return redirect()->route('lokasi-presensi.index')->with(
                'success',
                'Data lokasi presensi berhasil diubah!'
            );
        } catch (\Throwable $th) {
            return back()->with(
                'error',
                'Terjadi kesalahan dalam mengubah data lokasi presensi!'
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LokasiPresensi $lokasiPresensi)
    {
        try {
            $lokasiPresensi->delete();

            return redirect()->route('lokasi-presensi.index')->with(
                'success',
                'Data lokasi presensi berhasil dihapus!'
            );
        } catch (\Throwable $th) {
            return back()->with(
                'error',
                'Terjadi kesalahan dalam menghapus data lokasi presensi!'
            );
        }
    }
}
