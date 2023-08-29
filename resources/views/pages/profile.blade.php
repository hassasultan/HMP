@extends('layouts.app')
@section('content')
<section>
    <div class="container p-4">
        <div class="col-8 m-auto">
            <div class="card">
                @php
                    $user = auth()->user();
                @endphp
                <div class="card-header">
                    <i class="fas fa-user-cog me-2 fs-4"></i>{{ $user->name }}
                </div>
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-envelope  me-2 fs-4"></i>{{ $user->email }}</h5>
                    <p class="card-text">Update Your Password, your auto genrated password is <span class="text-danger">12345678</span>.</p>
                    <form method="POST" action="{{ route('user.profile.update') }}" class="mt-3">
                        @csrf
                        <div class="row mb-3">
                            <label for="old_password" class="col-md-4 col-form-label text-md-end">{{ __('Old Password') }}</label>

                            <div class="col-md-6">
                                <input id="old_password" type="password" class="form-control border border-2 p-2  @error('old_password') is-invalid @enderror" name="old_password" required autocomplete="old-password">

                                @if (session($key ?? 'error'))

                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{!! session($key ?? 'error') !!}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('New Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control border border-2 p-2  @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @if (session($key ?? 'error'))

                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{!! session($key ?? 'error') !!}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control border border-2 p-2 " name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if (session($key ?? 'success'))
        <div class="toast-container position-fixed p-3 top-0 end-0" id="toastPlacement" data-original-class="toast-container position-absolute p-3" style="z-index: 2 !important;">
            <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                <img src="{{ asset('assets/images/Fainal_.png') }}" class="rounded me-2" style="max-width: 50px;" alt="...">
                {{-- <img style="max-width: 80px;" src="{{ asset('assets/images/Fainal_.png') }}" class="img-fluid"
                                alt="electon6-store"> --}}
                <strong class="me-auto">Bootstrap</strong>
                {{-- <small>11 mins ago</small> --}}
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {!! session($key ?? 'success') !!}
                </div>
            </div>
        </div>
    @endif


</section>
@endsection
