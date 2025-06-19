<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = User::where('status', 'active')->count();
        return view('admin.dashboard.index', compact('user'));
    }

    public function karyawan()
    {
        // $user = Auth::user();
        return view('karyawan.dashboard.index');
    }
}
