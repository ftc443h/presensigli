<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\LokasiPresensi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

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

    public function data(Request $request)
    {
        Carbon::setLocale('id');

        $query = Karyawan::with(['user'])->select('karyawan.*');

        if ($request->has('name') && $request->name != '') {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('photo', function ($row) {
                if ($row->foto != '') {
                    return '<img src="' . asset('storage/' . $row->foto) . '" width="40" height="40" class="rounded-circle">';
                }
                return '<img src="' . asset('admin/assets/img/avatars/000m.jpg') . '" width="40" height="40" class="rounded-circle">';
            })
            ->addColumn('username', fn($row) => $row->user->username ?? '-')
            ->addColumn('action', function ($row) {
                $deleteRoute = route('karyawan.destroy', $row->id);
                return '
                <button class="btn btn-sm btn-primary btn-edit rounded-pill" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#editEmployee">
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
            ->rawColumns(['photo', 'username', 'action'])
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
     * Show the form for editing the specified resource.
     */
    public function edit(Karyawan $karyawan)
    {
        $employee = Karyawan::with(['user'])->findOrFail($karyawan->id);
        $positions = Jabatan::all();
        $locations = LokasiPresensi::all();

        return view(
            'admin.karyawan.partials.edit-modal',
            compact('employee', 'positions', 'locations')
        );
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
