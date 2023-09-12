<!doctype html>
<html class="modern fixed has-top-menu has-left-sidebar-half">
<head>
    {{-- @include('.admin.includes.head') --}}
    <!-- Basic -->
<meta charset="UTF-8">

<title>KWSC - Portal</title>
<link rel="icon" type="image/x-icon" href="{{ asset('/assets/img/unnamed.png') }}">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<!-- Web Fonts  -->
<link href="https://fonts.googleapis.com/css?family=Poppins:100,300,400,600,700,800,900" rel="stylesheet" type="text/css">

<!-- Vendor CSS -->
<link rel="stylesheet" href={{ asset('public/assets/vendor/bootstrap/css/bootstrap.css') }} />
{{-- <link rel="stylesheet" href={{ asset('public/assets/vendor/animate/animate.compat.css') }} /> --}}
{{-- <link rel="stylesheet" href={{ asset('public/assets/vendor/font-awesome/css/all.min.css') }} /> --}}
<link rel="stylesheet" href={{ asset('public/assets/vendor/boxicons/css/boxicons.min.css') }} />
{{-- <link rel="stylesheet" href={{ asset('public/assets/vendor/magnific-popup/magnific-popup.css') }} />
<link rel="stylesheet" href={{ asset('public/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') }} />
<link rel="stylesheet" href={{ asset('public/assets/vendor/morris/morris.css') }} /> --}}
<link rel="stylesheet" href={{ asset('public/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css') }} />
{{-- <link rel="stylesheet" href={{ asset('public/assets/vendor/datatables/media/css/dataTables.bootstrap5.css') }} /> --}}

<!-- Theme CSS -->
<link rel="stylesheet" href={{ asset('public/assets/css/theme.css') }} />
<link rel="stylesheet" type="text/css" href={{ asset('public/assets/css/vendors.css') }}  />
<link rel="stylesheet" type="text/css" href={{ asset('public/assets/css/style.css') }}  />

<!-- Theme Layout -->
<link rel="stylesheet" href={{ asset('public/assets/css/layouts/modern.css') }} />

<!-- Skin CSS -->
<link rel="stylesheet" href={{ asset('public/assets/css/skins/default.css') }} />

<!-- Theme Custom CSS -->
<link rel="stylesheet" href={{ asset('public/assets/css/custom.css') }} />

<!-- Head Libs -->
<script src={{ asset('public/assets/vendor/modernizr/modernizr.js') }}></script>

</head>
<body style="background-image:url({{ asset('/assets/img/login-bg.png') }});">
<!-- start: page -->
<section class="body-sign">
    <div class="center-sign">
        <div class="panel card-sign">
            <div class="col-md-12">
                <a href="home" class="logo text-center">
                    <img src="{{ asset('/assets/img/unnamed.png') }}" class="img-fluid" style="width: 200px;" alt="KWSC Admin" />
                </a>
            </div>
            <div class="card-body">
                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible">
                        {{ session('success') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <label>Email</label>
                        <div class="input-group">
                            <input name="email" type="text" class="form-control  @error('email') is-invalid @enderror" />
                            <span class="input-group-text">
										<i class="bx bx-user text-4"></i>
                            </span>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="clearfix">
                            <label class="float-left">Password</label>
                            <a href="forgot-password" class="float-end">Lost Password?</a>
                        </div>
                        <div class="input-group">
                            <input name="password" type="password" class="form-control  @error('password') is-invalid @enderror" />
                            <span class="input-group-text">
										<i class="bx bx-lock text-4"></i>
                            </span>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-8">
                            <div class="checkbox-custom checkbox-default">
                                <input id="RememberMe" name="rememberme" type="checkbox"/>
                                <label for="RememberMe">Remember Me</label>
                            </div>
                        </div>
                        <div class="col-sm-4 text-end">
                            <button type="" class="btn btn-primary mt-2">Sign In</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

        <p class="text-center text-muted mt-3 mb-3"><a href="http://hmp.esspl.com.pk:8081/login">KWSC</a> &copy; Copyright 2023. All Rights Reserved.</p>
    </div>
</section>
<!-- end: page -->
{{-- <footer class="row">
    @include('.admin.includes.footer')
</footer> --}}
</body>
</html>
