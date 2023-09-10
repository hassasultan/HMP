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
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.0.0')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"
        integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}

</head>
<body style="background-color:rgb(158, 158, 158) !important;">
    <div id="app">
        <div class="container p-4 bg-white w-100 text-center">
                <h2>KW&SC</h2>
                <p class="border-bottom">VEHICLE REGISTRATION FORM 2022</p>
                <div class="table">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <!--<tr class="p-0">-->
                                <th class="w-100 pl-0 pr-0 mr-0">
                                    Owner's Details
                                </th>
                            <!--</tr>-->
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="row text-start">
                                        <div class="col-md-6" style="border-right:1px solid #000;">
                                            Hydrant: {{$driver->hydrant->name}}
                                        </div>
                                        <div class="col-md-6"style="border-left:1px solid #000;">
                                            Contractor: {{$driver->hydrant          ->contractor_name}}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row text-start">
                                        <div class="col-md-6" style="border-right:1px solid #000;">
                                            Focal Person: {{$driver->hydrant->person}}
                                        </div>
                                        <div class="col-md-6" style="border-left:1px solid #000;">
                                            Contact#: {{$driver->hydrant->contact}}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row text-start">
                                        <div class="col-md-4 " style="border-right:1px solid #000;">
                                            <input type="checkbox" @if($driver->owned_by == 1) checked @endif disabled /> Vehicle owner by contractor
                                        </div>
                                        <div class="col-md-4" style="border-right:1px solid #000;">
                                            <input type="checkbox" @if($driver->owned_by == 0) checked @endif disabled /> vehicle owned by third party
                                        </div>
                                        <div class="col-md-4">

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="col-md-4 text-start">
                                        Alternate Hydrant:{{$driver->hydrant->alternate}}
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered border-2">
                        <thead class="table-dark border-2">
                            <!--<tr class="p-0">-->
                                <th class="w-100 pl-0 pr-0 mr-0">
                                    <div class="row">
                                        <div class="col-md-6 text-end">
                                            Vehicle's Details
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <a class="btn bg-gradient-primary" style="margin-bottom: 0rem !important; line-height:0.667 !important;"><i class="fas fa-map-marker-alt" style="font-size:0.8rem; "></i></a>
                                        </div>
                                    </div>
                                </th>
                            <!--</tr>-->
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="row text-start">
                                        <div class="col-md-6 text-start" style="border-right:1px solid #000;">
                                            Vehicle Reg#: {{$driver->truck_num}}
                                        </div>
                                        <div class="col-md-3 text-start" style="border-left:1px solid #000;">
                                            Chassis#: {{$driver->chassis_num}}
                                        </div>
                                        <div class="col-md-3 text-start" style="border-left:1px solid #000;">
                                            Engine#: {{$driver->engine_num}}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row text-start">
                                        <div class="col-md-9" style="border-right:1px solid #000;">
                                            Make: {{$driver->company_name}}
                                        </div>
                                        <div class="col-md-3" style="border-left:1px solid #000;">
                                            Model: {{$driver->model}}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row text-start">
                                        <div class="col-md-6" style="border-right:1px solid #000;">
                                            Tanker Capacity: {{$driver->truckCap->name}}
                                        </div>
                                        <div class="col-md-3" style="border-left:1px solid #000;">
                                            Cabin Color: {{$driver->cabin_color}}
                                        </div>
                                        <div class="col-md-3" style="border-left:1px solid #000;">
                                            Tank color: {{$driver->tanker_color}}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-4"></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row text-start">
                                        <div class="col-md-6" style="border-right:1px solid #000;">
                                            Reg Paper Image: <img class="w-50" src="{{ asset('public/storage/'.$driver->paper_image) }}"/>
                                        </div>
                                        <div class="col-md-6" style="border-left:1px solid #000;">
                                            Capacity: {{$driver->truckCap->name}}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row text-center">
                                        <h6>Vehicle Image</h6>
                                        <img class="m-auto img-fluid" src="{{ asset('public/storage/'.$driver->vehicle_image) }}"/>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    @foreach($driver->drivers as $key => $row)
                        <table class="table table-bordered">
                            <thead class="table-dark">
                                <!--<tr class="p-0">-->
                                    <th class="w-100 pl-0 pr-0 mr-0">
                                        Driver's {{++$key}} Details
                                    </th>
                                <!--</tr>-->
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="row  text-start">
                                            <div class="col-md-6" style="border-right:1px solid #000;">
                                                Name: {{$row->name}}
                                            </div>
                                            <div class="col-md-6"style="border-left:1px solid #000;">
                                                Phone#: {{$row->phone}}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="row text-start">
                                            <div class="col-md-6" style="border-right:1px solid #000;">
                                                Nic#: {{$row->nic}}
                                            </div>
                                            <div class="col-md-6" style="border-left:1px solid #000;">
                                                Nic Image#: <img class="w-50" src="{{ asset('public/storage/'.$row->nic_image) }}"/>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="row text-start">
                                            <div class="col-md-6" style="border-right:1px solid #000;">
                                                Profile Image#: <img class="w-50" src="{{ asset('public/storage/'.$row->image) }}"/>
                                            </div>
                                            <div class="col-md-6" style="border-left:1px solid #000;">
                                                License Image#: <img class="w-50" src="{{ asset('public/storage/'.$row->license_image) }}"/>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @endforeach
                </div>
        </div>
    </div>
<!--   Core JS Files   -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/core/popper.min.js')}}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
<script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
<script src="{{ asset('assets/js/plugins/chartjs.min.js')}}"></script>
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
