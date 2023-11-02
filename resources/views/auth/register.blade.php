@extends('layouts.login')

@section('content')

<main class="login-container">
  <div class="container">
    <div class="row page-login d-flex align-items-center">
      <div class="section-left col-12 col-md-6">
        <h1 class="mb-4">
          Registrasi Akun Sistem Informasi Perpustakaan
        </h1>
        <img src="frontend/images/registration-image.jpg" class="w-75 d-none d-sm-flex">
      </div>
      <div class="section-right col-12 col-md-4">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                  @csrf
                  <div class="text-center">
                      <img src="{{ url('frontend/images/logo.png') }}" class="w-50 mb-4">
                  </div>
                    <div class="form-group">
                        <label for="name">{{ __('Name') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                    <button type="submit" class="btn btn-login btn-block">
                        {{ __('Register') }}
                    </button>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
