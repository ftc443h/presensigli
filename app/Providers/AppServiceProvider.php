<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('otp', function ($request) {
            $email = $request->email ?? $request->session()->get('otp_email') ?? $request->ip();
            return Limit::perMinute(5)->by($email)->response(function () use ($request) {
                return redirect()->back()->withErrors([
                    'otp' => 'Terlalu banyak permintaan OTP. Silakan coba lagi nanti.',
                ]);
            });
        });
    }
}
