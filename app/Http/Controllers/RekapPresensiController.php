<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RekapPresensiController extends Controller
{
    public function rekapPresensi()
    {
        return view('admin.rekap_presensi.index', [
            'active' => 'rekapPresensi'
        ]);
    }
}
