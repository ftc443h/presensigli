<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showAdmin()
    {
        $admin = Auth::user();

        return view(
            'admin.dashboard.profile',
            compact('admin')
        );
    }


    public function showKaryawan()
    {
        $karyawan = Auth::user();

        return view(
            'karyawan.dashboard.profile',
            compact('karyawan')
        );
    }
}
