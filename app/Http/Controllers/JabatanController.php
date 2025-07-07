<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Carbon\Carbon;
use FontLib\Table\Type\name;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jabatans = Jabatan::all();
        return view('admin.master_data.index', compact('jabatans'));
    }

    public function data(Request $request)
    {
        Carbon::setLocale('id');

        $query = Jabatan::query();

        if ($request->has('name') && $request->name != '') {
            $query->where('jabatan', 'like', '%' . $request->name . '%');
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $deleteRoute = route('jabatan.destroy', $row->id);
                return '
                    <button class="btn btn-sm btn-primary btn-edit rounded-pill" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#editJobTitle">
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
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        try {
            $request->validate([
                'jabatan' => 'required|string|max:45'
            ]);

            Jabatan::create([
                'jabatan' => $request->jabatan
            ]);

            return redirect()->route('jabatan.index')->with(
                'success', 
                'Data jabatan berhasil ditambahkan!'
            );
        } catch (\Throwable $th) {
            return back()->with(
                'error', 
                'Terjadi kesalahan dalam menambahkan data jabatan!'
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jabatan $jabatan)
    {
        $position = Jabatan::findOrFail($jabatan->id);

        return view(
            'admin.master_data.partials.edit-modal',
            compact('position')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        
        try {
            $request->validate([
                'jabatan' => 'required|string|max:45'
            ]);

            Jabatan::where('id', $jabatan->id)
            ->update([
                'jabatan' => $request->jabatan
            ]);

            return redirect()->route('jabatan.index')->with(
                'success', 
                'Data jabatan berhasil diubah!'
            );
        } catch (\Throwable $th) {
            return back()->with(
                'error', 
                'Terjadi kesalahan dalam mengubah data jabatan!'
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jabatan $jabatan)
    {
        try {
            $jabatan->delete();

            return redirect()->route('jabatan.index')->with(
                'success', 
                'Data jabatan berhasil dihapus!'
            );
        } catch (\Throwable $th) {
            return back()->with(
                'error', 
                'Terjadi kesalahan dalam menghapus data jabatan!'
            );
        }
    }
}
