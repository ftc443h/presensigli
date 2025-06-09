<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/dashboard/dashboard';

    protected function redirectTo()
    {
        $user = Auth::user();
        return $user->role === 'admin' ? '/dashboard/dashboard' : '/karyawan/dashboard';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Override untuk memungkinkan login pakai email atau username.
     */

    public function username()
    {
        $login = request()->input('username');

        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        request()->merge([$field => $login]);

        return $field;
    }

    /**
     * for response from check credential
     */
    protected function credentials(Request $request)
    {
        return [
            $this->username() => $request->input('username'),
            'password' => $request->input('password'),
            'status' => 'active',
        ];
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $user = User::where($this->username(), $request->input('username'))->first();

        if (!$user) {
            throw ValidationException::withMessages([
                $this->username() => ['Username atau email tidak ditemukan.'],
            ]);
        }

        if (!Hash::check($request->input('password'), $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['Password Anda salah, silakan coba lagi.'],
            ]);
        }
        
        if ($user->status !== 'active') {
            throw ValidationException::withMessages([
                $this->username() => ['Akun Anda tidak aktif atau diblokir.'],
            ]);
        }
        
        
        throw ValidationException::withMessages([
            $this->username() => ['Gagal login. Silakan coba lagi.'],
        ]);
    }
}
