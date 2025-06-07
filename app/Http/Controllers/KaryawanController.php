<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function karyawan()
    {
        return view('admin.karyawan.index', [
            'active' => 'karyawan' ]);
    }
}
