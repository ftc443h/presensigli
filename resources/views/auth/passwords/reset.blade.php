@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <div class="row g-0">
                        {{-- Ilustrasi Kiri --}}
                        <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center bg-light">
                            <img src="{{ asset('images/reset-password-illustration.png') }}" alt="Reset Password Illustration"
                                class="img-fluid p-4" style="max-height: 320px;">
                        </div>

                        {{-- Form Reset Password --}}
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title text-center mb-4">{{ __('Reset Password') }}</h5>

                                <form method="POST" action="{{ route('auth.passwords.update') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">{{ __('New Password') }}</label>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="password-confirm"
                                            class="form-label">{{ __('Confirm New Password') }}</label>
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password">
                                    </div>

                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Reset Password') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
