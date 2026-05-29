@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="col-md-8 col-lg-6 col-xl-4">
    <div class="auth-card">
        <div class="auth-header">
            <h3>{{ __('Selamat Datang') }}</h3>
            <p>Silakan masuk ke akun Anda</p>
        </div>

        <div class="auth-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group mb-4">
                    <label for="email" class="form-label">{{ __('Alamat Email') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light border-right-0"><i class="fas fa-envelope text-muted"></i></span>
                        </div>
                        <input id="email" type="email" class="form-control border-left-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Masukkan email Anda">
                    </div>
                    @error('email')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light border-right-0"><i class="fas fa-lock text-muted"></i></span>
                        </div>
                        <input id="password" type="password" class="form-control border-left-0 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Masukkan password Anda">
                    </div>
                    @error('password')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label text-muted" for="remember">{{ __('Ingat Saya') }}</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a class="auth-link small" href="{{ route('password.request') }}">
                            {{ __('Lupa Password?') }}
                        </a>
                    @endif
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-auth w-100">
                        <i class="fas fa-sign-in-alt mr-2"></i> {{ __('Login Sekarang') }}
                    </button>
                </div>

                <div class="text-center mt-4">
                    <span class="text-muted">Belum punya akun?</span>
                    <a class="auth-link ml-1" href="{{ route('register') }}">
                        {{ __('Daftar Sekarang') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
