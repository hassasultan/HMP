<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'KWSC - Portal') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/unnamed.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/unnamed.png') }}">
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.0.0') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"
        integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<style>
    .form-control-sm {
        border: 1px solid #000 !important;

    }

    #example1_filter {
        position: relative;
        float: right;
        margin-right: 10px;
    }

    #example2_filter {
        position: relative;
        float: right;
        margin-right: 10px;
    }

    #example3_filter {
        position: relative;
        float: right;
        margin-right: 10px;
    }

    @keyframes rotate {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }


    @-webkit-keyframes rotate {
        from {
            -webkit-transform: rotate(0deg);
        }

        to {
            -webkit-transform: rotate(360deg);
        }
    }

    .load {
        width: 100px;
        height: 100px;
        margin: 110px auto 0;
        border: solid 10px #3f4298;
        border-radius: 50%;
        border-right-color: transparent;
        border-bottom-color: transparent;
        -webkit-transition: all 0.5s ease-in;
        -webkit-animation-name: rotate;
        -webkit-animation-duration: 1.0s;
        -webkit-animation-iteration-count: infinite;
        -webkit-animation-timing-function: linear;

        transition: all 0.5s ease-in;
        animation-name: rotate;
        animation-duration: 1.0s;
        animation-iteration-count: infinite;
        animation-timing-function: linear;
    }
</style>

<body>
    <div id="app">
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}
        @include('layouts.include.sidebar')
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            @include('layouts.include.header')
            <div class="container-fluid py-4">
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
                @if (Session::get('success', false))
                    <?php $data = Session::get('success'); ?>
                    @if (is_array($data))
                        @foreach ($data as $msg)
                            <div class="alert alert-success" role="alert">
                                <i class="fa fa-check"></i>
                                {{ $msg }}
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-success" role="alert">
                            <i class="fa fa-check"></i>
                            {{ $data }}
                        </div>
                    @endif
                @endif
                @yield('content')
                @include('layouts.include.footer')
            </div>
        </main>
        <div class="fixed-plugin">
            <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
                <i class="material-icons py-2">settings</i>
            </a>
            <div class="card shadow-lg">
                <div class="card-header pb-0 pt-3">
                    <div class="float-start">
                        <h5 class="mt-3 mb-0">Water Pump Ui</h5>
                        <p>See our dashboard options.</p>
                    </div>
                    <div class="float-end mt-4">
                        <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                            <i class="material-icons">clear</i>
                        </button>
                    </div>
                    <!-- End Toggle Button -->
                </div>
                <hr class="horizontal dark my-1">
                <div class="card-body pt-sm-3 pt-0">
                    <!-- Sidebar Backgrounds -->
                    <div>
                        <h6 class="mb-0">Sidebar Colors</h6>
                    </div>
                    <a href="javascript:void(0)" class="switch-trigger background-color">
                        <div class="badge-colors my-2 text-start">
                            <span class="badge filter bg-gradient-primary active" data-color="primary"
                                onclick="sidebarColor(this)"></span>
                            <span class="badge filter bg-gradient-dark" data-color="dark"
                                onclick="sidebarColor(this)"></span>
                            <span class="badge filter bg-gradient-info" data-color="info"
                                onclick="sidebarColor(this)"></span>
                            <span class="badge filter bg-gradient-success" data-color="success"
                                onclick="sidebarColor(this)"></span>
                            <span class="badge filter bg-gradient-warning" data-color="warning"
                                onclick="sidebarColor(this)"></span>
                            <span class="badge filter bg-gradient-danger" data-color="danger"
                                onclick="sidebarColor(this)"></span>
                        </div>
                    </a>
                    <!-- Sidenav Type -->
                    <div class="mt-3">
                        <h6 class="mb-0">Sidenav Type</h6>
                        <p class="text-sm">Choose between 2 different sidenav types.</p>
                    </div>
                    <div class="d-flex">
                        <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark"
                            onclick="sidebarType(this)">Dark</button>
                        <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent"
                            onclick="sidebarType(this)">Transparent</button>
                        <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-white"
                            onclick="sidebarType(this)">White</button>
                    </div>
                    <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
                    <!-- Navbar Fixed -->
                    <div class="mt-3 d-flex">
                        <h6 class="mb-0">Navbar Fixed</h6>
                        <div class="form-check form-switch ps-0 ms-auto my-auto">
                            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed"
                                onclick="navbarFixed(this)">
                        </div>
                    </div>
                    <hr class="horizontal dark my-3">
                    <div class="mt-2 d-flex">
                        <h6 class="mb-0">Light / Dark</h6>
                        <div class="form-check form-switch ps-0 ms-auto my-auto">
                            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version"
                                onclick="darkMode(this)">
                        </div>
                    </div>
                    <hr class="horizontal dark my-sm-4">
                    {{-- <a class="btn btn-outline-dark w-100" href="">View documentation</a> --}}
                    {{-- <div class="w-100 text-center">
                  <a class="github-button" href="https://github.com/creativetimofficial/material-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/material-dashboard on GitHub">Star</a>
                  <h6 class="mt-3">Thank you for sharing!</h6>
                  <a href="https://twitter.com/intent/tweet?text=Check%20Material%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
                    <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
                  </a>
                  <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/material-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
                    <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
                  </a>
                </div> --}}
                </div>
            </div>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <!--<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>-->
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert.js') }}"></script>

    <script src="{{ asset('assets/js/summernote.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script> --}}
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    @section('scripts')

    @show

    <!-- select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- select2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const searchLogicDriver = function() {

            $("#driver-id").append("");
            // console.log($('#search-cast .select2-selection__rendered input[type=search]').length);

            formData = {
                value: $(this).val(),
            }
            $.ajax({
                    type: "GET",
                    url: "{{ route('search.driver.billing') }}",
                    data: formData,
                    dataType: "json",
                    encode: true,
                }).done(function(data) {
                    $("#driver-id").html("");

                    html = '';
                    $.each(data, function(index, value) {
                        html += '<option value="' + value.id + '">' + value.name + '-' + value.phone +
                            '</option>';
                    });
                    $("#driver-id").append(html);
                    this.value = "";
                })
                .fail(function(error) {
                    console.log(error);
                });

        }
        const searchLogicTruck = function() {

            $("#vehicle-id").append("");

            // console.log($('#search-cast .select2-selection__rendered input[type=search]').length);

            formData = {
                value: $(this).val(),
            }
            $.ajax({
                    type: "GET",
                    url: "{{ route('search.truck.billing') }}",
                    data: formData,
                    dataType: "json",
                    encode: true,
                }).done(function(data) {
                    // console.log(data);
                    $("#vehicle-id").html("");

                    html = '';
                    $.each(data, function(index, value) {
                        html += '<option value="' + value.id + '">'+ value['hydrant']['name']+ '-' + value['truck_cap']['name'] + '-' + value.name + ':' + value.truck_num + ' ' + value.company_name +
                            '</option>';
                    });
                    $("#vehicle-id").append(html);
                    this.value = "";
                })
                .fail(function(error) {
                    console.log(error);
                });

        }
        const getInterval = setInterval(() => {
            // console.log("check");

            if ($('.select2-search input[type=search]').length) {
                if ($('.select2-search input[type=search]').attr('aria-controls') == "select2-driver-id-results") {
                    $('.select2-search input[type=search]').unbind("keydown", searchLogicDriver);
                    $('.select2-search input[type=search]').on("keydown", searchLogicDriver);
                }
                if ($('.select2-search input[type=search]').attr('aria-controls') == "select2-vehicle-id-results") {
                    $('.select2-search input[type=search]').unbind("keydown", searchLogicTruck);
                    $('.select2-search input[type=search]').on("keydown", searchLogicTruck);
                }

            }
        }, 1000);

        function errorModal(error) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: error,
                footer: ''
            })
        }

        function successModal(message) {
            Swal.fire(
                'Thank You!',
                message,
                'success'
            )
        }

        function driverActivatedStatus(id) {


            var id = id;
            var status = $('#FormControlDriverSelect-' + id).val();
            console.log(status);
            $.ajax({
                    url: "{{ route('change.driver.active.status') }}",
                    type: "Get",
                    data: {
                        id: id,
                        status: status,
                    },
                }).done(function(data) {
                    console.log(data);
                    successModal("Status Has been Changed Successfully...");
                })
                .fail(function(error) {
                    console.log(error);
                    errorModal(error);

                });


        }

        function adminstatus(id) {


            var id = id;
            var status = $('#FormControlAdminSelect-' + id).val();
            console.log(status);
            $.ajax({
                    url: "{{ route('change.tanker.status') }}",
                    type: "Get",
                    data: {
                        id: id,
                        status: status,
                    },
                }).done(function(data) {
                    console.log(data);
                    successModal("Status Has been Changed Successfully...");
                })
                .fail(function(error) {
                    console.log(error);
                    errorModal(error);

                });


        }

        function adminstatuscustomer(id) {

            var id = id;
            var status = $('#FormControlAdminSelect-' + id).val();
            console.log(status);
            $.ajax({
                    url: "{{ route('change.customer.status') }}",
                    type: "Get",
                    data: {
                        id: id,
                        status: status,
                    },
                }).done(function(data) {
                    console.log(data);
                    successModal("Status Has been Changed Successfully...");
                })
                .fail(function(error) {
                    console.log(error);
                    errorModal(error);

                });


        }

        function adminstatusbilling(id) {

            var id = id;
            var note = null;
            var myModal = new bootstrap.Modal(document.getElementById('reasonModal'), {
                keyboard: false
            });
            var status = $('#FormControlAdminSelect-' + id).val();
            if (status == 3) {
                if ($('#note').val() == null || $('#note').val() == '') {
                    $('#reason-submit').attr('data-id', id);
                    myModal.show();
                    return false;
                } else {
                    note = $("#note").val();
                }
            }
            console.log(note);
            $.ajax({
                    url: "{{ route('billing.change.status') }}",
                    type: "Get",
                    data: {
                        id: id,
                        status: status,
                        note: note,
                    },
                }).done(function(data) {
                    console.log(data);
                    if (status == 3) {
                        $("#note").val('');
                        myModal.hide();
                    }
                    if (data['error']) {
                        errorModal(data['error']);
                    } else {
                        successModal(data['message']);
                    }
                })
                .fail(function(error) {
                    console.log(error['responseJSON']['error']);
                    errorModal(error['responseJSON']['error']);

                });


        }

        function adminstatusdriver(id) {

            var id = id;
            var status = $('#FormControlAdminSelect-' + id).val();
            console.log(status);
            $.ajax({
                    url: "{{ route('change.driver.status') }}",
                    type: "Get",
                    data: {
                        id: id,
                        status: status,
                    },
                }).done(function(data) {
                    console.log(data);
                    successModal("Status Has been Changed Successfully...");
                })
                .fail(function(error) {
                    console.log(error);
                    errorModal(error);

                });


        }

        $(document).ready(function() {
            // Select2 Multiple
            $('.select2-multiple').select2({
                placeholder: "Select",
                allowClear: true
            });

            $('.select2-multiple2').select2({
                placeholder: "Select",
                allowClear: true
            });

        });
        $(function() {
            $("#example1").DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "sorting": false,
                "info": true,
                "autoWidth": false,
                "responsive": true,

            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,

            });

        });
    </script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/js/material-dashboard.min.js?v=3.0.0') }}"></script>
</body>

</html>
