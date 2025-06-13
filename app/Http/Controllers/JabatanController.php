<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $user = Auth::user();
        $jabatans = Jabatan::all();
        return view('admin.jabatan.index', compact('jabatans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jabatan.create');
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
     * Display the specified resource.
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jabatan $jabatan)
    {
        return view('admin.jabatan.edit', compact('jabatan'));
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
