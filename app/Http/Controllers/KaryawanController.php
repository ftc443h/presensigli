<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\LokasiPresensi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = User::with(['karyawan'])->get();
        $nip = Karyawan::orderBy('nip', 'desc')->limit(1)->value('nip');
        $positions = Jabatan::all();
        $locations = LokasiPresensi::all();

        return view(
            'admin.karyawan.index',
            compact('employees', 'nip', 'positions', 'locations')
        );
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
                    'nip' => 'required|string|max:50',
                    'name' => 'required|string|max:255',
                    'jenis_kelamin' => 'required|string',
                    'alamat' => 'required|string',
                    'no_hp' => 'required|string|max:20',
                    'jabatan' => 'required|string|max:45',
                    'lokasi_presensi' => 'required|string|max:65',
                    'foto' => 'required|mimes:png,jpg,jpeg|max:2048',
                    'username' => 'required|string|max:45',
                    'email' => 'required|string|max:45',
                    'password' => 'required|string|max:255',
                    'role' => 'required|string',
                    'status' => 'required|string',
                ]
            );

            // take foto path
            $fotoPath = null;
            if ($request->hasFile('foto')) {
                $fileName = time() . '_' . $request->file('foto')->getClientOriginalName();
                $fotoPath = $request->file('foto')->storeAs('karyawan', $fileName, 'public');
            }

            $karyawan = Karyawan::create(
                [
                    'nip' => $request->nip,
                    'name' => $request->name,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'alamat' => $request->alamat,
                    'no_hp' => $request->no_hp,
                    'jabatan' => $request->jabatan,
                    'lokasi_presensi' => $request->lokasi_presensi,
                    'foto' => $fotoPath,
                ]
            );

            User::create(
                [
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => $request->role,
                    'status' => $request->status,
                    'karyawan_id' => $karyawan->id,
                ]
            );

            return redirect()->route('karyawan.index')->with(
                'success',
                'Data karyawan berhasil ditambahkan!'
            );
        } catch (\Throwable $th) {
            return back()->with(
                'error',
                'Terjadi kesalahan dalam menambahkan data karyawan!' . $th->getMessage()
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Karyawan $karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Karyawan $karyawan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        try {
            $request->validate(
                [
                    'nip' => 'required|string|max:50',
                    'name' => 'required|string|max:255',
                    'jenis_kelamin' => 'required|string',
                    'alamat' => 'required|string',
                    'no_hp' => 'required|string|max:20',
                    'jabatan' => 'required|string|max:45',
                    'lokasi_presensi' => 'required|string|max:65',
                    'foto' => 'nullable|mimes:png,jpg,jpeg|max:2048',
                    'username' => 'required|string|max:45',
                    'email' => 'required|string|max:45',
                    'password' => 'nullable|string|max:255',
                    'role' => 'required|string',
                    'status' => 'required|string',
                ]
            );

            // take foto path
            $fotoPath = $karyawan->foto;
            if ($request->hasFile('foto')) {
                if ($fotoPath && file_exists(
                    storage_path('app/public/' . $fotoPath)
                )) {
                    unlink(
                        storage_path('app/public/' . $fotoPath)
                    );
                }

                $fileName = time() . '_' . $request->file('foto')->getClientOriginalName();
                $fotoPath = $request->file('foto')->storeAs('karyawan', $fileName, 'public');
            }

            Karyawan::where('id', $karyawan->id)
                ->update(
                    [
                        'nip' => $request->nip,
                        'name' => $request->name,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'alamat' => $request->alamat,
                        'no_hp' => $request->no_hp,
                        'jabatan' => $request->jabatan,
                        'lokasi_presensi' => $request->lokasi_presensi,
                        'foto' => $fotoPath,
                    ]
                );

            // persiapkan data user
            $dataUser = [
                'username' => $request->username,
                'email' => $request->email,
                'role' => $request->role,
                'status' => $request->status,
            ];

            // jika password tidak kosong, tambahkan ke data update
            if (!empty($request->password)) {
                $dataUser['password'] = Hash::make($request->password);
            }

            User::where('karyawan_id', $karyawan->id)->update($dataUser);

            return redirect()->route('karyawan.index')->with(
                'success',
                'Data karyawan berhasil diubah!'
            );
        } catch (\Throwable $th) {
            return back()->with(
                'error',
                'Terjadi kesalahan dalam mengubah data karyawan!' . $th->getMessage()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karyawan $karyawan)
    {
        try {
            $filePath = storage_path('app/public/' . $karyawan->foto);

            if (file_exists($filePath)) {
                unlink($filePath);
                Log::info('File successfully deleted using unlink.');
            } else {
                Log::warning(
                    'File does not exist at:',
                    ['path' => $filePath]
                );
            }

            User::where('karyawan_id', $karyawan->id)->delete();

            $karyawan->delete();

            return redirect()->route('karyawan.index')->with(
                'success',
                'Data karyawan berhasil dihapus!'
            );
        } catch (\Throwable $th) {
            return back()->with(
                'error',
                'Terjadi kesalahan dalam menghapus data karyawan!' . $th->getMessage()
            );
        }
    }
}
