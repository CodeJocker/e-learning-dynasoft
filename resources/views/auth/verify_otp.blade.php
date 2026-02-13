@extends('layouts.auth')

@section('title', 'Verify OTP')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Email Verification</h4>
    </div>
    <div class="card-body">
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <p class="text-muted">
            We've sent a 6-digit OTP to your email address. Please enter it below to verify your account.
        </p>

        <form method="POST" action="{{ route('student.verify.otp.submit') }}">
            @csrf

            <div class="mb-3">
                <label for="otp" class="form-label">OTP Code</label>
                <input type="text" 
                       class="form-control @error('otp') is-invalid @enderror" 
                       id="otp" 
                       name="otp" 
                       value="{{ old('otp') }}" 
                       placeholder="Enter 6-digit OTP" 
                       maxlength="6" 
                       required 
                       autofocus>
                @error('otp')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">
                    Verify OTP
                </button>
            </div>
        </form>

        <form method="POST" action="{{ route('student.resend.otp') }}" class="mt-3">
            @csrf
            <div class="d-grid">
                <button type="submit" class="btn btn-link">
                    Didn't receive the OTP? Resend
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
