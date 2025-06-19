<?php

namespace App\Http\Controllers;

use App\Models\LokasiPresensi;
use Illuminate\Http\Request;

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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
     * Display the specified resource.
     */
    public function show(LokasiPresensi $lokasiPresensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LokasiPresensi $lokasiPresensi)
    {
        //
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
