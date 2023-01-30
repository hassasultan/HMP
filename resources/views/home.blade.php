@extends('layouts.app')

@section('content')
<style>
    .dash-count
    {
        height: 300px;
        overflow-y: scroll;
        padding-top: 15px;
    }
</style>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {

    var data = google.visualization.arrayToDataTable({{ Js::from($result) }});

    var options = {
      title: '',
      is3D: false,
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
    chart.draw(data, options);
  }
</script>
<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {

      var data = google.visualization.arrayToDataTable({{ Js::from($result2) }});

      var options = {
        title: '',
        is3D: true,
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart_3d2'));
      chart.draw(data, options);
    }
  </script>
  @if (auth()->user()->role == 1)
    <div class="row p-4">
        {{-- <div class="col-12 bg-gradient-primary  text-center p-2">
            <h5 class="text-white">Total Orders</h5>
        </div> --}}
        <div class="col-6 border border-top-0 border-3 border-bottom-0 border-start-0 border-light mt-2 p-4">
            <div class="row">
                <div class="col-md-3">
                    <div class="card text-center p-3">
                        <img src="{{ asset('assets/img/truck1JPG.JPG') }}" class="img-fluid" style="height: 80px"/>
                        <h6 style="font-size: 0.7rem">Total Registered Water Tanker (contractor)</h6>
                        <b id="cont">{{ $order }}</b>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center p-3">
                        <img src="{{ asset('assets/img/truck2.JPG') }}" class="img-fluid" style="height: 80px"/>
                        <h6  style="font-size: 0.7rem">Total Registered Water Tanker (Third Party)</h6>
                        <b id="third">{{ $order }}</b>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center p-3">
                        <img src="{{ asset('assets/img/driver1JPG.JPG') }}" class="img-fluid" style="height: 80px"/>
                        <h6  style="font-size: 0.7rem">Total Driver Registered Water Tanker (contractor)</h6>
                        <b id="cont-driver">{{ $order }}</b>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center p-3">
                        <img src="{{ asset('assets/img/driver2.JPG') }}" class="img-fluid" style="height: 80px"/>
                        <h6  style="font-size: 0.7rem">Total Driver Registered Water Tanker (contractor)</h6>
                        <b id="third-driver">{{ $order }}</b>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row p-4">
                <div class="col-4">
                    <div class="row">
                        <h6>Total Water Tanker</h6>
                        @foreach($hydrants as $row)
                            @if(count($row->vehicles) != 0)
                                <div class="col-8" style="color:{{ $row->color }}"><i class="fas fa-check-square me-2"></i>{{$row->name}}</div>
                                <div class="col-4 text-end" style="color:{{ $row->color }}">{{count($row->vehicles)}}</div>
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
        @endforeach
    </div>

  @endif
<div class="row p-4">
    <div class="col-12 bg-gradient-primary  text-center p-2">
        <h5 class="text-white">Total Orders</h5>
    </div>
    <div class="col-4 border border-top-0 border-3 border-bottom-0 border-start-0 border-light mt-2 p-4">
        <div class="row">
            <div class="col-md-5">
                <div class="card text-center p-3">
                    <h6>GPS Today</h6>
                    <b>{{ $order }}</b>
                </div>
                <div class="card text-center p-3 mt-2">
                    <h6>COMM Today</h6>
                    <b>{{ $order }}</b>
                </div>
            </div>
            <div class="col-md-7 p-2 mt-3">
                <div class="card text-center p-5">
                    <h6>Total Orders</h6>
                    <b>{{ $order }}</b>
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
                            <div class="col-8" style="color:{{ $row->color }}"><i class="fas fa-check-square me-2"></i>{{$row->name}}</div>
                            <div class="col-4 text-end" style="color:{{ $row->color }}">{{count($row->orders)}}</div>
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

@endsection
