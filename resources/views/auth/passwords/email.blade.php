@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <div class="row g-0">
                        {{-- Ilustrasi --}}
                        <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center bg-light">
                            <img src="{{ asset('images/request-otp-illustration.png') }}" alt="Request OTP Illustration"
                                class="img-fluid p-4" style="max-height: 320px;">
                        </div>

                        {{-- Form --}}
                        <div class="col-md-6">
                            <div class="card-header bg-white text-center border-0 mt-5">
                                <h5 class="mb-0 fw-bold">
                                    {{ __('Forgot your password?') }}
                                </h5> &nbsp;
                                <small class="text-muted">
                                    {{ __('We’ll send you a One-Time Password (OTP) to reset it.') }}
                                </small>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('auth.passwords.email') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">
                                            {{ __('Email Address') }}
                                        </label>
                                        <input id="email" type="email"
                                            class="form-control" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    </div>
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Send OTP') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <p class="text-center mt-3 small text-muted">
                                <i class="bi bi-lock-fill me-1"></i>
                                {{ __('Your information is secure and protected.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
