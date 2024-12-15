@extends('layouts.auth')

@section('title', 'Login')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('asset/library/bootstrap-social/bootstrap-social.css') }}">
@endpush

@section('main')
    <div class="wrapper wrapper-login">
        <div class="container container-login animated fadeIn">
            <h3 class="text-center">Sistem Informasi Manajemen Bank Sampah Desa Rendole Pati</h3>
            <div class="login-form">
                <div class="form-sub">
                    <form method="POST" action="{{ route('login.post') }}" class="needs-validation" novalidate="">
                        @csrf
                        <div class="form-floating form-floating-custom mb-3">
                            <input id="username" type="username" class="form-control" name="username" tabindex="1"
                                required autofocus>
                            <label for="username">Username</label>
                        </div>
                        <div class="invalid-feedback">
                            Silakan isi alamat email Anda
                        </div>
                        <div class="form-floating form-floating-custom mb-3">
                            <input id="password" type="password" class="form-control" name="password" tabindex="2"
                                required>
                            <label for="password">Password</label>
                            <div class="show-password">
                                <i class="icon-eye"></i>
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            Mohon isi kata sandi Anda
                        </div>
                </div>
                <div class="form-action mb-3">
                    <button type="submit" class="btn btn-primary w-100">Masuk</button>
                </div>
            </div>
        </div>
        </form>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
