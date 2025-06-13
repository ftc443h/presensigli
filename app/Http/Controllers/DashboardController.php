<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // $user = Auth::user();
        return view('admin.dashboard.index');
    }

    public function karyawan()
    {
        // $user = Auth::user();
        return view('karyawan.dashboard.index');
    }
}
