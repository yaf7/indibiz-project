@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<div class="col-md-8 col-lg-6 col-xl-5">
    <div class="auth-card">
        <div class="auth-header">
            <h3>{{ __('Buat Akun Baru') }}</h3>
            <p>Bergabunglah dengan kami hari ini</p>
        </div>

        <div class="auth-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group mb-4">
                    <label for="name" class="form-label">{{ __('Nama Lengkap') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light border-right-0"><i class="fas fa-user text-muted"></i></span>
                        </div>
                        <input id="name" type="text" class="form-control border-left-0 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Masukkan nama Anda">
                    </div>
                    @error('name')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label for="email" class="form-label">{{ __('Alamat Email') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light border-right-0"><i class="fas fa-envelope text-muted"></i></span>
                        </div>
                        <input id="email" type="email" class="form-control border-left-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Masukkan email Anda">
                    </div>
                    @error('email')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light border-right-0"><i class="fas fa-lock text-muted"></i></span>
                                </div>
                                <input id="password" type="password" class="form-control border-left-0 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Buat password">
                            </div>
                            @error('password')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label for="password-confirm" class="form-label">{{ __('Konfirmasi Password') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light border-right-0"><i class="fas fa-lock text-muted"></i></span>
                                </div>
                                <input id="password-confirm" type="password" class="form-control border-left-0" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2 mt-2">
                    <button type="submit" class="btn btn-auth w-100">
                        <i class="fas fa-user-plus mr-2"></i> {{ __('Daftar Sekarang') }}
                    </button>
                </div>
                
                <div class="text-center mt-4">
                    <span class="text-muted">Sudah punya akun?</span>
                    <a class="auth-link ml-1" href="{{ route('login') }}">
                        {{ __('Login di sini') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
