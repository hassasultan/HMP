@extends('layouts.app')

@section('content')
<style>
    #total-tanker
    {
        height: 180px;
        overflow-y: scroll;

        /* padding-top: 15px; */
    }
    .icon-lg {
        width: 40px !important;
        height: 40px !important;
    }

</style>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
setInterval(function () {
    var role = "{{ auth()->user()->role }}";
    var url = "";
    if(role == 1)
    {
        url = "{{ route('home') }}";
    }
    else
    {
        url = "{{ route('hydrant.home') }}";
    }
    console.log(url);
    $.ajax({
            url: url,
            type: "Get",
            data: {
                status:"api",
            },
        }).done(function(data) {
            console.log(data);
            google.charts.load("current", {packages:["corechart"]});
            google.charts.setOnLoadCallback(drawChart);
            let result = data['result'];
            let today_result = data['result_today'];
            console.log(today_result);
            function drawChart() {

                var data = google.visualization.arrayToDataTable(result);
                var data2 = google.visualization.arrayToDataTable(today_result);

                var options = {
                title: '',
                is3D: false,
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                var chart2 = new google.visualization.PieChart(document.getElementById('piechart_3dToday'));
                chart.draw(data, options);
                chart2.draw(data2, options);
            }
        })
        .fail(function(error) {
            console.log(error);
            errorModal(error);

        });

}, 90000);
</script>
<script type="text/javascript">
// setInterval(function () {
//     var role = "{{ auth()->user()->role }}";
//     var url = "";
//     if(role == 1)
//     {
//         url = "{{ route('home') }}";
//     }
//     else
//     {
//         url = "{{ route('hydrant.home') }}";
//     }
//     console.log(url);
//     $.ajax({
//         url: url,
//         type: "Get",
//         data: {
//             status:"api",
//         },
//     }).done(function(data) {
//         console.log(data);
//         $("#cont").html(data['contractor']);
//         $("#third").html(data['third']);
//         $("#cont-driver").html(data['contractor_driver']);
//         $("#third-driver").html(data['third_driver']);

//         $("#today-comm").html(data['today_comm']);
//         $("#today-gps").html(data['today_gps']);
//         $("#today-order").html(data['today_order']);
//         $("#total-gallon").html(data['today_gallon_count']);
//         var html = "";
//         $.each(data['hydrants'],function(index,value){
//             if(value['vehicles'].length > 0)
//             {
//                 html += "<div class='col-8' style='color:"+value['color']+"'><i class='fas fa-check-square me-2'></i>"+value['name']+"</div>";
//                 html += "<div class='col-4 text-end' style='color:"+value['color']+"'>"+value['vehicles'].length+"</div>";
//                 $("#total-tanker").html(html);
//             }
//         });
//         google.charts.load("current", {packages:["corechart"]});
//         google.charts.setOnLoadCallback(drawChart2);
//         let result2 = data['newresult'];
//         function drawChart2() {

//             var data = google.visualization.arrayToDataTable(result2);

//             var options = {
//             title: '',
//             is3D: true,
//             };

//             var chart = new google.visualization.PieChart(document.getElementById('piechart_3d2'));
//             chart.draw(data, options);
//         }
//     })
//     .fail(function(error) {
//         console.log(error);
//         errorModal(error);

//     });

// }, 90000);

  </script>
  @if (auth()->user()->role == 1)
  <header class="page-header page-header-left-inline-breadcrumb">
    <h2 class="font-weight-bold text-6">Home</h2>
    <div class="right-wrapper">
        <ol class="breadcrumbs">
            <li><span>Dashboard</span></li>
            <li><span>Home</span></li>
        </ol>
    </div>
</header>
  <div class="row dash-count">
    <div class="col-xl-2 col-sm-4 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="fa fa-truck" aria-hidden="true"></i>
                </div>
                <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Total Vehicles</p>
                <h3 class="mb-0">{{$vehicle}}</h3>
                </div>
            </div>
            <!--<hr class="dark horizontal my-0">-->
            <!--<div class="card-footer p-3">-->
            <!--  <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than lask week</p>-->
            <!--</div>-->
        </div>
    </div>
    @if (auth()->user()->role == 1)
        {{-- <div class="col-xl-2 col-sm-4 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                    <i class="fa fa-user-circle"></i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Total Drirvers</p>
                    <h3 class="mb-0">{{$driver}}</h3>
                </div>
                </div>

            </div>
        </div> --}}
    @endif
    <div class="col-xl-2 col-sm-4 mb-xl-0 mb-4">
        <div class="card">
        <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
            <i class="fa fa-building" aria-hidden="true"></i>
            </div>
            <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">Total Hydrants</p>
            <h3 class="mb-0">{{$hydCount}}</h3>
            </div>
        </div>

        </div>
    </div>
    <div class="col-xl-2 col-sm-4 mb-xl-0 mb-4">
        <div class="card">
        <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
            <i class="fa fa-user-circle" aria-hidden="true"></i>
            </div>
            <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">Total Customers</p>
            <h3 class="mb-0">{{$customer_count}}</h3>
            </div>
        </div>

        </div>
    </div>
    {{-- @foreach($hydrants as $key => $row)
    <div class="col-xl-3 col-sm-6 @if($key % 4) mt-4 @endif">
        <div class="card">
        <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape shadow-info text-center border-radius-xl mt-n4 position-absolute" style="background-color:{{ $row->color }} ">
            <i class="fa fa-building" aria-hidden="true"></i>
            </div>
            <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">{{$row->name}}</p>
            <p class="text-sm mb-0 text-capitalize">Total Vehicles</p>
            <h4 class="mb-0">{{count($row->vehicles)}}</h4>
            </div>
        </div>

        </div>
    </div>
    @endforeach --}}
</div>
<hr/>
    <div class="row p-4">
        {{-- <div class="col-12 bg-gradient-primary  text-center p-2">
            <h5 class="text-white">Total Orders</h5>
        </div> --}}
        <div class="col-6 border border-top-0 border-3 border-bottom-0 border-start-0 border-light mt-2 p-4">
            <div class="row">
                <div class="col-md-3">
                    <div class="card text-center px-3 pt-3">
                        <img src="{{ asset('assets/img/truck1JPG.JPG') }}" class="img-fluid" style="height: 80px"/>
                        <h6 style="font-size: 0.7rem">Total Registered Water Tanker (contractor)</h6>
                        <h3 id="cont" >{{ $contractor }}</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center px-3 pt-3">
                        <img src="{{ asset('assets/img/truck2.JPG') }}" class="img-fluid" style="height: 80px"/>
                        <h6  style="font-size: 0.7rem">Total Registered Water Tanker (Third Party)</h6>
                        <h3 id="third" >{{ $third }}</h3>
                    </div>
                </div>
                {{-- <div class="col-md-3">
                    <div class="card text-center px-3 pt-3">
                        <img src="{{ asset('assets/img/truck2.JPG') }}" class="img-fluid" style="height: 80px"/>
                        <h6  style="font-size: 0.7rem">Total UnRegister Registered Water Tanker (Third Party)</h6>
                        <h3 id="third" >{{ $unreg }}</h3>
                    </div>
                </div> --}}
                <div class="col-md-3">
                    <div class="card text-center p-2">
                        <img src="{{ asset('assets/img/driver1JPG.JPG') }}" class="img-fluid" style="height: 80px"/>
                        <h6  style="font-size: 0.7rem">Total Driver Registered Water Tanker (contractor)</h6>
                        <h3 id="cont-driver" >{{ $contractor_driver }}</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center p-2">
                        <img src="{{ asset('assets/img/driver2.JPG') }}" class="img-fluid" style="height: 80px"/>
                        <h6  style="font-size: 0.7rem">Total Driver Registered Water Tanker (Third Party)</h6>
                        <h3 id="third-driver" >{{ $third_driver }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row p-4">
                <div class="col-4">
                    <h6>Total Water Tanker</h6>
                    <div class="row" id="total-tanker">
                        @foreach($hydrants as $row)
                            @if(count($row->vehicles) != 0)
                                <div class="col-8" ><i class="fas fa-check-square me-2"></i>{{$row->name}}</div>
                                <div class="col-4 text-end" >{{count($row->vehicles)}}</div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-8">
                    <div id="piechart_3d2"></div>
                </div>
            </div>
        </div>
    </div>

  @else
    <div class="row dash-count">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="fa fa-truck" aria-hidden="true"></i>
                </div>
                <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Total Vehicles</p>
                <h4 class="mb-0">{{$vehicle}}</h4>
                </div>
            </div>
            <!--<hr class="dark horizontal my-0">-->
            <!--<div class="card-footer p-3">-->
            <!--  <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than lask week</p>-->
            <!--</div>-->
            </div>
        </div>
        @if (auth()->user()->role == 1)
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                    <i class="fa fa-user-circle"></i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Total Drirvers</p>
                    <h4 class="mb-0">{{$driver}}</h4>
                </div>
                </div>

            </div>
            </div>
        @endif
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                <i class="fa fa-building" aria-hidden="true"></i>
                </div>
                <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Total Hydrants</p>
                <h4 class="mb-0">{{$hydCount}}</h4>
                </div>
            </div>

            </div>
        </div>
        @foreach($hydrants as $key => $row)
        <div class="col-xl-3 col-sm-6 @if($key % 4) mt-4 @endif">
            <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape shadow-info text-center border-radius-xl mt-n4 position-absolute" >
                <i class="fa fa-building" aria-hidden="true"></i>
                </div>
                <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">{{$row->name}}</p>
                <p class="text-sm mb-0 text-capitalize">Total Vehicles</p>
                <h4 class="mb-0">{{count($row->vehicles)}}</h4>
                </div>
            </div>

            </div>
        </div>
        @endforeach
    </div>

  @endif
  <div class="row p-4">
    <div class="col-12 bg-gradient-primary  text-center p-2">
        <h5 class="text-white">Today Orders</h5>
    </div>
    <div class="col-4 border border-top-0 border-3 border-bottom-0 border-start-0 border-light mt-2 p-4">
        <div class="row">
            <div class="col-md-5">
                <div class="card text-center p-3">
                    <h6>GPS Today</h6>
                    <b class="fs-5" id="today-comm">{{ $today_gps }} </b>
                </div>
                <div class="card text-center p-3 mt-2">
                    <h6>COMM Today</h6>
                    <b class="fs-5" id="today-gps">{{ $today_comm }}</b>
                </div>
            </div>
            <div class="col-md-7 p-2 ">
                <div class="card text-center p-3 m-3">
                    <h6>DC Qouta Today</h6>
                    <b class="fs-5" id="today-comm">{{ $today_dc }}</b>
                </div>
                <div class="card text-center p-5">
                    <h6>Total Today Orders</h6>
                    <b class="fs-5" id="today-order">{{ $today_order }}</b>
                </div>
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="row p-4">
            <div class="col-4">
                <div class="row">
                    <div class="card text-center p-5">
                        <h6>Orders in Gallons Today</h6>
                        <b class="fs-5" id="total-gallon">{{ $today_gallon_count }}</b>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div id="piechart_3dToday"></div>
            </div>
        </div>
    </div>
</div>
<div class="row p-4">
    <div class="col-12 bg-gradient-primary  text-center p-2">
        <h5 class="text-white">Total Orders</h5>
    </div>
    <div class="col-4 border border-top-0 border-3 border-bottom-0 border-start-0 border-light mt-2 p-4">
        <div class="row">
            <div class="col-md-5">
                <div class="card text-center p-3">
                    <h6>GPS Total</h6>
                    <b class="fs-5">{{ $gps }}</b>
                </div>
                <div class="card text-center p-3 mt-2">
                    <h6>COMM Total</h6>
                    <b class="fs-5">{{ $comm }}</b>
                </div>
            </div>
            <div class="col-md-7 p-2">
                <div class="card text-center p-3 m-3">
                    <h6>DC Qouta Total</h6>
                    <b class="fs-5" id="today-comm">{{ $dc }}</b>
                </div>
                <div class="card text-center p-5">
                    <h6>Total Orders</h6>
                    <b class="fs-5">{{ $order }}</b>
                </div>
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="row p-4">
            <div class="col-4">
                <div class="row">
                    @foreach($hydrants as $row)
                        @if(count($row->orders) != 0)
                            <div class="col-8" ><i class="fas fa-check-square me-2"></i>{{$row->name}}</div>
                            <div class="col-4 text-end" >{{count($row->orders)}}</div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="col-8">
                <div id="piechart_3d"></div>
            </div>
        </div>
    </div>
</div>

<script>
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

@endsection
