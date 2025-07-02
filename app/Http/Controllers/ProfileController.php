<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display the admin profile.
     *
     * @return \Illuminate\View\View
     */
    public function showAdmin()
    {
        $admin = Auth::user();

        return view(
            'admin.dashboard.profile',
            compact('admin')
        );
    }

    /**
     * Show the form for editing the admin password.
     *
     * @return \Illuminate\View\View
     */
    public function editPasswordAdmin()
    {
        return view('admin.auth.change-password');
    }

    /**
     * Update the admin password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePasswordAdmin(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with(
                'error',
                'Maaf, Password lama Anda tidak sesuai.'
            );
        }

        User::where('id', $user->id)
            ->update([
                'password' => Hash::make($request->new_password),
            ]);



        return back()->with(
            'success',
            'Password Anda berhasil diubah.'
        );
    }



    /**
     * Display the karyawan profile.
     *
     * @return \Illuminate\View\View
     */
    public function showKaryawan()
    {
        $karyawan = Auth::user();

        return view(
            'karyawan.dashboard.profile',
            compact('karyawan')
        );
    }

    /**
     * Show the form for editing the karyawan password.
     *
     * @return \Illuminate\View\View
     */
    public function editPasswordKaryawan()
    {
        return view('karyawan.auth.change-password');
    }

    /**
     * Update the karyawan password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePasswordKaryawan(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]); 

        $user = Auth::user();   

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with(
                'error',
                'Maaf, Password lama Anda tidak sesuai.'
            );
        }

        User::where('id', $user->id)
            ->update([
                'password' => Hash::make($request->new_password),
            ]);

        return back()->with(
            'success',
            'Password Anda berhasil diubah.'
        );
    }
}
