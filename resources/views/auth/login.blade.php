@extends('auth.guest')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="row">
    <div class="col-lg-4 col-md-8 col-12 mx-auto">
      <div class="card z-index-0 fadeIn3 fadeInBottom">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
            <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Sign in</h4>
            <div class="row mt-3">
              {{-- <div class="col-2 text-center ms-auto">
                <a class="btn btn-link px-3" href="javascript:;">
                  <i class="fa fa-facebook text-white text-lg"></i>
                </a>
              </div>
              <div class="col-2 text-center px-1">
                <a class="btn btn-link px-3" href="javascript:;">
                  <i class="fa fa-github text-white text-lg"></i>
                </a>
              </div>
              <div class="col-2 text-center me-auto">
                <a class="btn btn-link px-3" href="javascript:;">
                  <i class="fa fa-google text-white text-lg"></i>
                </a>
              </div> --}}
            </div>
          </div>
        </div>
        <div class="card-body">
          <form role="form" class="text-start" method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-group input-group-outline my-3">
              <label class="form-label">Email</label>
              <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group input-group-outline mb-3">
              <label class="form-label">Password</label>
              <input type="password"  id="password" class="form-control  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-check form-switch d-flex align-items-center mb-3">
              <input class="form-check-input" type="checkbox" id="rememberMe">
              <label class="form-check-label mb-0 ms-2" for="rememberMe">Remember me</label>
            </div>
            <div class="text-center">
              <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Sign in</button>
            </div>
            {{-- <p class="mt-4 text-sm text-center">
              Don't have an account?
              <a href="../pages/sign-up.html" class="text-primary text-gradient font-weight-bold">Sign up</a>
            </p> --}}
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
