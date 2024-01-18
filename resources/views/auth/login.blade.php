@extends('layouts.login')

@section('title','Login')

@section('content')
  
  <main class="login-container">
    <div class="container">
      <div class="row page-login d-flex align-items-center">
        <div class="section-left col-12 col-md-6">
          <h1 class="mb-4">
            Sistem Informasi Perpustakaan <br> SMK Widya Dirgantara
          </h1>
          <img src="frontend/images/library-login-image.jpg" class="w-75 d-none d-sm-flex">
        </div>
        <div class="section-right col-12 col-md-4">
          <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="text-center">
                        <img src="{{ url('frontend/images/logo.png') }}" class="w-50 mb-4">
                    </div>
                    <div class="form-group">
                        <label for="">Email Address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    <div class="form-group form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label">Remember Me</label>
                    </div>
                    <button type="submit" class="btn btn-login btn-block">
                    Sign In
                    </button>
                    @if (Route::has('password.request'))
                    <p class="text-center mt-4">
                      <a class="btn btn-link" href="{{ route('password.request') }}">Saya Lupa Password</a>
                    </p>
                    @endif
                    <p style="text-align: center">Belum punya akun? Klik <a href="{{ url('/register') }}">Disini</a> untuk mendaftar</p>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection