@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <div class="row g-0">
                        {{-- Ilustrasi --}}
                        <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center bg-light">
                            <img src="{{ asset('images/otp-illustration.png') }}" alt="OTP Illustration" class="img-fluid p-4"
                                style="max-height: 320px;">
                        </div>

                        {{-- Form --}}
                        <div class="col-md-6">
                            <div class="card-body mt-5">
                                <h5 class="card-title text-center mb-4">
                                    {{ __('Verify OTP for Password Reset') }}
                                </h5>

                                <form method="POST" action="{{ route('auth.passwords.verify') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="otp" class="form-label">{{ __('OTP') }}</label>
                                        <input id="otp" type="text" class="form-control" name="otp" required
                                            autofocus>
                                    </div>

                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Verify OTP') }}
                                        </button>
                                    </div>
                                </form>

                                {{-- Resend OTP --}}
                                <div class="col-md-12 text-center mt-3">
                                    <button type="button" class="btn btn-link text-decoration-none"
                                        onclick="event.preventDefault(); document.getElementById('resend-otp-form').submit();">
                                        {{ __('Didn\'t receive the OTP? Resend') }}
                                    </button>
                                    <form id="resend-otp-form" action="{{ route('auth.passwords.resend-otp') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
