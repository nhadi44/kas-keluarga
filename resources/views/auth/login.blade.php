@extends('layouts.auth.default')
@section('title', 'Login')
@section('content')
    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <div class="auth-logo">
                    <a href="index.html" class="d-flex align-items-center gap-3">
                        <img src="/assets/icons/android-chrome-512x512.png" alt="Logo">
                        <h3 class="m-0">Kas Keluarga</h3>
                    </a>
                </div>
                <h1 class="auth-title">Masuk.</h1>
                <p class="auth-subtitle mb-5">
                    Masuk dengan akun yang sudah terdaftar
                </p>

                <form id="login_form">
                    @csrf
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-xl" placeholder="Username" name="username"
                            id="username">
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-xl" placeholder="Password" name="password"
                            id="password">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" id="btn_login">Masuk</button>
                </form>
                <div class="text-center mt-5 text-lg fs-4">
                    <p class="text-gray-600">Belum mempunyai akun? <a href="{{ route('register.index') }}"
                            class="font-bold">Daftar disini</a>.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
            <div id="auth-right">
                <img src="/assets/images/auth.jpg" alt="auth-login" width="100%" height="100%" />
            </div>
        </div>
    </div>
@endsection

@push('scrips')
    <script type="module" src="/assets/js/form/login.js"></script>
    <script type="module" src="/assets/js/helpers/form_validation.js"></script>
@endpush
