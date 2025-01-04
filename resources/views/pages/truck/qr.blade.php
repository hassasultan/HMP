<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"
        integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}

</head>

<body>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .card-container {
            width: 800px;
            height: 690px;
            border: 3px solid #41419a;
            /* Outer blue border */
            margin: 0 auto;
            position: relative;
        }

        /* Inner double border */
        .card-container::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            bottom: 20px;
            border: 3px solid #41419a;
            /* Inner blue border */
            z-index: 1;
        }

        /* Border text */
        .border-text {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            display: flex;
            /*justify-content: space-between;*/
            align-items: center;
            font-size: 12px;
            font-weight: bold;
            color: #212529;
        }

        .left {}

        .horizontal span {
            padding: 0 5px;
        }

        .horizontal {
            margin-left: 27px;
        }

        .vertical {
            margin-top: 20px;
        }

        .vertical span {
            padding: 5px 0;
        }

        .border-text.vertical {
            position: absolute;
            writing-mode: vertical-rl;
            transform: rotate(180deg);
            top: 0;
            bottom: 0;
            left: -771px;
        }

        .border-text.vertical.right {
            left: auto;
            right: 0px;
            transform: none;
        }

        .content {
            position: relative;
            z-index: 2;
            padding: 30px 15px;
            text-align: center;
        }

        .qr-code {
            width: 120px;
            height: 120px;
            display: inline-block;
            margin-bottom: 10px;
        }

        .logo {
            width: 100px;
            margin: 0 auto;
        }

        /* .seal {
            width: 80px;
            margin-top: 10px;
        } */

        .id-number {
            font-size: 22px;
            font-weight: bold;
            margin-top: 5px;
            color: #000;
        }

        .authorized-text h6{
            font-size: 51px;
            font-weight: bold;
            color: #000;
            /* margin-top: 15px; */
        }
        .authorized-text h6 span
        {
            font-size:  41px;
            font-weight: 100;
        }

        .contractor-text {
            font-size: 48px;
            color: #000;
        }
        .seal
        {
            font-size:  15px;
            color: #000;
            text-decoration: underline;
            text-align: left !important;
            padding-left: 4.8rem;
        }
        h2
        {
            color: #000;
            text-decoration: underline;
        }
    </style>
    <div id="app" style="background: {{ $driver->hydrant->color }};">
        <div class="card-container">
            <!-- Horizontal Top Border Text -->
            <div class="border-text horizontal">
                <span>KW&SC</span>
                <span>HMC</span>
                <span>KW&SC</span>
                <span>HMC</span>
                <span>KW&SC</span>
                <span>HMC</span>
                <span>KW&SC</span>
                <span>HMC</span>
                <span>KW&SC</span>
                <span>HMC</span>
                <span>KW&SC</span>
                <span>HMC</span>
                <span>KW&SC</span>
                <span>HMC</span>
                <span>KW&SC</span>
                <span>HMC</span>
            </div>

            <!-- Vertical Left Border Text -->
            <div class="border-text vertical left">
                <span>KW&SC</span>
                <span>HMC</span>
                <span>KW&SC</span>
                <span>HMC</span>
                <span>KW&SC</span>
                <span>HMC</span>
                <span>KW&SC</span>
                <span>HMC</span>
                <span>KW&SC</span>
                <span>HMC</span>
                <span>KW&SC</span>
                <span>HMC</span>
                <span>KW&SC</span>
                <span>HMC</span>
                <span>KW&SC</span>
                <span>HMC</span>
                <span>KW&SC</span>
                {{-- <span>HMC</span> --}}

            </div>

            <!-- Vertical Right Border Text -->
            <div class="border-text vertical right">
                <span>KW&SC</span>
                <span>HMC</span>
                <span>KW&SC</span>
                <span>HMC</span>
                <span>KW&SC</span>
                <span>HMC</span>
                <span>KW&SC</span>
                <span>HMC</span>
                <span>KW&SC</span>
                <span>HMC</span>
                <span>KW&SC</span>
                <span>HMC</span>
                <span>KW&SC</span>
                <span>HMC</span>
                {{-- <span>KW&SC</span>
                <span>HMC</span>
                <span>KW&SC</span>
                <span>HMC</span> --}}

            </div>

            <!-- Horizontal Bottom Border Text -->
            <div class="border-text horizontal" style="top: auto; bottom: 0;">
                <span>KW&SC</span>
                <span>HMC</span>
                <span>KW&SC</span>
                <span>HMC</span>
                <span>KW&SC</span>
                <span>HMC</span>
                <span>KW&SC</span>
                <span>HMC</span>
                <span>KW&SC</span>
                <span>HMC</span>
                <span>KW&SC</span>
                <span>HMC</span>
                <span>KW&SC</span>
                <span>HMC</span>
                <span>KW&SC</span>
                <span>HMC</span>
            </div>

            <div class="content">
                <h2>Hydrant {{ $driver->hydrant->name }}</h2>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-8 p-4">
                            <div class="img">
                                {!! \QrCode::size(350)->backgroundColor(0,0,0,0)->generate($url) !!}
                            </div>
                            <div class="authorized-text"><h6>AUTHORIZED</h6> </div>
                            <div class="contractor-text">@if ($driver->owned_by != 1) SUB-CONTRACTOR @else CONTRACTOR @endif
                            </div>
                            <div class="seal">
                                VALID TILL :
                                {{-- <img src="https://via.placeholder.com/80" alt="Seal" class="seal"> --}}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="img">
                                <img src="{{ asset('assets/img/unnamed.png') }}" class="img-fluid" alt="main_logo">
                            </div>
                            <!-- ID Number -->
                            <div class="id-number">{{ $driver->truck_num }}</div>

                            <!-- Authorized Text -->

                            <div class="img">
                                {{-- <img src="https://via.placeholder.com/80" alt="Seal" class="seal"> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- QR Code -->

                <!-- Logo -->


                <!-- Seal -->
            </div>
        </div>
        {{-- <div class="container p-4  w-100 text-center" id="getPrint" style="background: {{ $driver->hydrant->color }};">
            <div class=" m-auto">
                <div class="row">
                    <div class="col-6" style="border-right: 2px dashed #000;">
                        <div class="col-6" style="text-align:left !important;">
                            <img src="{{ asset('assets/img/unnamed.png') }}" class="img-fluid" alt="main_logo">
                        </div>
                        <div class="col-12" style="text-align:left !important;">
                            <h5 style="font-size: 3.7rem;">Authorized</h5>
                            <p  style="font-size: 2.9rem;"><span class="bg-dark text-white">@if ($driver->owned_by != 1) Sub-Contractor @else Contractor @endif </span></p>
                            <h5  style="font-size: 3.7rem;">Vehicle</h5>
                        </div>
                    </div>
                    <div class="col-6">
                        {!! \QrCode::size(450)->backgroundColor(0,0,0,0)->generate($url) !!}
                    </div>
                    <div class="col-12 text-center">
                      <p>{{ $driver->truck_num }}</p>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    {{-- <button type="button"onclick="getPrint()" class="btn btn-primary">print</button> --}}

    <!--   Core JS Files   -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- select2 -->
    <script>
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

        function getPrint() {
            var elem = document.getElementById('getPrint');
            var print_area = window.open();
            print_area.document.write('<html>');
            print_area.document.write(
                '<link rel="dns-prefetch" href="//fonts.gstatic.com"><link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"><link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" /><link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" /><link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" /><link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet"><link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.0.0') }}" rel="stylesheet" /><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" /><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw=="crossorigin="anonymous" referrerpolicy="no-referrer" /><link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />'
            );
            print_area.document.write('<body>');
            print_area.document.write(elem.innerHTML);
            print_area.document.write('</body></html>');
            // print_area.focus();
            print_area.print();
            // print_area.close();
        }
        var ctx = document.getElementById("chart-bars").getContext("2d");

        new Chart(ctx, {
            type: "bar",
            data: {
                labels: ["M", "T", "W", "T", "F", "S", "S"],
                datasets: [{
                    label: "Sales",
                    tension: 0.4,
                    borderWidth: 0,
                    borderRadius: 4,
                    borderSkipped: false,
                    backgroundColor: "rgba(255, 255, 255, .8)",
                    data: [50, 20, 10, 22, 50, 10, 40],
                    maxBarThickness: 6
                }, ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: 'rgba(255, 255, 255, .2)'
                        },
                        ticks: {
                            suggestedMin: 0,
                            suggestedMax: 500,
                            beginAtZero: true,
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                            color: "#fff"
                        },
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: 'rgba(255, 255, 255, .2)'
                        },
                        ticks: {
                            display: true,
                            color: '#f8f9fa',
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });


        var ctx2 = document.getElementById("chart-line").getContext("2d");

        new Chart(ctx2, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Mobile apps",
                    tension: 0,
                    borderWidth: 0,
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(255, 255, 255, .8)",
                    pointBorderColor: "transparent",
                    borderColor: "rgba(255, 255, 255, .8)",
                    borderColor: "rgba(255, 255, 255, .8)",
                    borderWidth: 4,
                    backgroundColor: "transparent",
                    fill: true,
                    data: [50, 40, 300, 320, 500, 350, 200, 230, 500],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: 'rgba(255, 255, 255, .2)'
                        },
                        ticks: {
                            display: true,
                            color: '#f8f9fa',
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#f8f9fa',
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });

        var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");

        new Chart(ctx3, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Mobile apps",
                    tension: 0,
                    borderWidth: 0,
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(255, 255, 255, .8)",
                    pointBorderColor: "transparent",
                    borderColor: "rgba(255, 255, 255, .8)",
                    borderWidth: 4,
                    backgroundColor: "transparent",
                    fill: true,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: 'rgba(255, 255, 255, .2)'
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#f8f9fa',
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#f8f9fa',
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
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
