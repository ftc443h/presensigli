<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class KaryawanController extends Controller
{
    public function karyawan()
    {
        return view('admin.karyawan.index', [
            'active' => 'karyawan'
        ]);
    }

    public function dataKaryawan(Request $request)
    {
        $data = DB::table('karyawan')->select([
            'id',
            'foto',
            'name',
            'jabatan',
            'jenis_kelamin',
            'alamat',
            'created_at',
            'updated_at'
        ]);

        $dataTable = DataTables::of($data)
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && $request->input('search.value') != '') {
                    $search = $request->input('search.value');
                    $query->where(function ($q) use ($search) {
                        $q
                            ->where('name', 'LIKE', "%{$search}%")
                            ->orWhere('jabatan', 'LIKE', "%{$search}%")
                            ->orWhere('jenis_kelamin', 'LIKE', "%{$search}%")
                            ->orWhere('alamat', 'LIKE', "%{$search}%");
                    });
                }
            })
            ->smart(false);

        return $dataTable->make(true);
    }

    public function fotoKaryawan($filename)
    {
        $path = storage_path('app/private/private/images/' . $filename);

        if (!File::exists($path)) {
            abort(404, 'File not found');
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        return response($file, 200)->header('Content-Type', $type);
    }

    public function insertKaryawan(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'jabatan' => 'required',
            'foto' => 'required|image|mimes:jpg,png,gif,svg|min:2|max:280',
        ]);

        if (!empty($request->foto)) {
            $fotoKaryawan = 'fotoKaryawan_' . uniqid() . '.' . $request->foto->extension();
            $request->file('foto')->storeAs('private/images', $fotoKaryawan, 'local');
        } else {
            $fotoKaryawan = '';
        }

        try {
            DB::table('karyawan')->insert([
                'name' => $request->name,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'jabatan' => $request->jabatan,
                'foto' => $fotoKaryawan,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return back()->with('success', 'Data Karyawan Berhasil Kesimpan ✅');
        } catch (\Exception $e) {
            return back()->with('error', 'Data Karyawan Gagal Kesimpan ❌' . $e->getMessage());
        }
    }

    public function getEditKaryawan($id)
    {
        $getEditKaryawan = DB::table('karyawan')->where('id', $id)->first();

        return response()->json($getEditKaryawan);
    }

    public function updateKaryawan(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'jabatan' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:1024',
        ]);

        $karyawan = DB::table('karyawan')->where('id', $id)->first();

        $fotoOld = $karyawan->foto;
        $fotoBaru = $fotoOld;

        if ($request->hasFile('foto')) {
            if ($fotoOld && file_exists(storage_path('app/private/images/' . $fotoOld))) {
                unlink(storage_path('app/private/images/' . $fotoOld));
            }

            $fotoBaru = 'fotoKaryawan_' . uniqid() . '.' . $request->foto->extension();
            $request->file('foto')->storeAs('private/images', $fotoBaru);
        }

        DB::table('karyawan')->where('id', $id)->update([
            'name' => $request->name,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'jabatan' => $request->jabatan,
            'foto' => $fotoBaru,
        ]);

        return redirect()->back()->with('success', 'Data karyawan berhasil diperbarui.');
    }
}
