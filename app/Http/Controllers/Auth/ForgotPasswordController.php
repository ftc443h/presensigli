<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Mail\OtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\RateLimiter;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    // use SendsPasswordResetEmails;

    /**
     * Show the form for requesting a password reset link.
     */
    public function showRequestForm()
    {
        return view('auth.passwords.email');
    }

    /**
     * Handle a request to send an OTP for password reset.
     */
    public function sendOTP(Request $request)
    {
        // Validate the request data
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        if (RateLimiter::tooManyAttempts($key = 'otp:' . $user->email, 3)) {
            return back()->withErrors(
                ['email' => 'Terlalu banyak permintaan. Silakan coba lagi nanti.']
            );
        }

        // Increment the rate limit
        RateLimiter::hit($key, 60 * 5); // 5 minutes

        // Generate a random OTP
        $otp = rand(100000, 999999);
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            ['token' => $otp, 'created_at' => now()]
        );

        // Send the OTP to the user's email
        // Here you would typically use a mail service to send the OTP
        Mail::to($user->email)->send(new OtpMail($otp));


        Session::put('otp_email', $user->email);

        return redirect()->route('auth.passwords.verify-otp')
            ->with('status', 'OTP telah dikirim ke email Anda.');
    }

    /**
     * Show the form for verifying the OTP.
     */
    public function showVerifyForm()
    {
        // Check if the user has an OTP email session
        if (!Session::has('otp_email')) {
            return redirect()->route('auth.passwords.request')
                ->withErrors(['email' => 'Anda harus meminta OTP terlebih dahulu.']);
        }

        // Show the OTP verification form
        return view('auth.passwords.verify-otp');
    }

    /**
     * Handle the OTP verification.
     */
    public function verifyOTP(Request $request)
    {
        // Validate the OTP
        $request->validate(['otp' => 'required|digits:6']);

        $email = Session::get('otp_email');
        $token = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->where('token', $request->otp)
            ->first();

        if (!$token) {
            return back()->withErrors(['otp' => 'OTP tidak valid atau telah kadaluwarsa.']);
        }

        // OTP is valid, proceed to reset password
        Session::put('otp_verified', true);

        return redirect()->route('auth.passwords.reset');
    }

    /**
     * Resend the OTP to the user's email.
     */
    public function resendOTP()
    {
        // Check if the user has an OTP email session
        if (!Session::has('otp_email')) {
            return redirect()->route('auth.passwords.request')
                ->withErrors(
                    ['email' => 'Sesi Anda tidak ditemukan. Silakan minta OTP kembali.']
                );
        }

        $email = Session::get('otp_email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Pengguna tidak ditemukan.']);
        }

        // Check rate limit for resending OTP
        if (RateLimiter::tooManyAttempts($key = 'otp:' . $user->email, 3)) {
            return back()->withErrors(
                ['email' => 'Terlalu banyak permintaan. Silakan coba lagi nanti.']
            );
        }

        // Increment the rate limit
        RateLimiter::hit($key, 60 * 5); // 5 minutes

        // Generate a new OTP
        $otp = rand(100000, 999999);
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            ['token' => $otp, 'created_at' => now()]
        );

        // Send the new OTP to the user's email
        Mail::to($user->email)->send(new OtpMail($otp));

        return back()->with('status', 'OTP baru telah dikirim ke email Anda.');
    }

    /**
     * Show the form for resetting the password.
     */
    public function showResetForm()
    {
        // Check if the OTP has been verified
        if (!Session::get('otp_verified')) {
            return redirect()->route('auth.passwords.request')
                ->withErrors(['otp' => 'Anda harus memverifikasi OTP terlebih dahulu.']);
        }

        // Show the password reset form
        return view('auth.passwords.reset');
    }

    /**
     * Handle the password reset.
     */
    public function resetPassword(Request $request)
    {
        // Validate the new password
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $email = Session::get('otp_email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('auth.passwords.request')
                ->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();

        // Optionally, delete the OTP token from the database
        DB::table('password_reset_tokens')->where('email', $email)->delete();

        // Clear the session data
        Session::forget(['otp_email', 'otp_verified']);

        return redirect()->route('login')
            ->with('status', 'Password Anda telah berhasil direset.');
    }
}
