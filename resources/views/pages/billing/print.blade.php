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
    <style>
        .bg-white {
            width: 100%;
        }

        p {
            line-height: 0.625 !important;
        }

        @media only screen and (max-width: 600px) {
            .bg-white {
                width: 100%;
            }

        }
    </style>
</head>

<body style="background-color:rgb(158, 158, 158) !important;">
    <div id="app">
        <div class="container p-4 bg-white w-100" id="getPrint">
            <div class="bg-white border border-dark border-3  m-auto"
                style="color: #000 !important; background-image: url('{{ asset('assets/img/watermark.png') }}'); background-repeat: no-repeat;background-position: center;">
                <div class="col-12 text-center">
                    <img src="{{ asset('assets/img/unnamed.png') }}" class="img-fluid" alt="main_logo"
                        style="width: 200px;">
                    <h1 class="text-center" style="color:#000;">E-SLIP</h1>
                    <p><b>Hydrant Management Portal</b></p>
                    <h5><b>CONSUMER COPY</b></h5>
                </div>
                <div class="row text-left p-4">
                    <div class="col-6">
                        <p class="font-weight-bold">Order#</p>
                    </div>
                    <div class="col-6 ">
                        <p class="font-weight-bold">{{ wordwrap($billing->order->Order_Number,13,"<br>\n")  }}</p>
                    </div>
                    @php
                        $date = \Carbon\Carbon::parse($billing->order->created_at);
                        $date->toDateString();
                        $url = route('billing.details', $billing->id);
                    @endphp
                    <div class="col-6">
                        <p class="font-weight-bold">Customer Name:</p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold">{{ $billing->order->customer->name }}</p>
                    </div>

                    <div class="col-6">
                        <p class="font-weight-bold">Order Type:</p>
                    </div>
                    @if ($billing->order->order_type != null)
                        <div class="col-6">
                            <p class="font-weight-bold">{{ $billing->order->order_type }}</p>
                        </div>
                    @else
                        <div class="col-6">
                            <p class="font-weight-bold">{{ $billing->order->customer->standard }}</p>
                        </div>
                    @endif

                    <div class="col-6">
                        <p class="font-weight-bold">Customer Contact:</p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold">{{ $billing->order->customer->contact_num }}</p>
                    </div>

                    <div class="col-6">
                        <p class="font-weight-bold" style="line-height: 1.02 !important;">Area: </p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold" style="line-height: 1.02 !important;">
                            {{ $billing->order->customer->address }} {{ $billing->order->customer->street }}
                            {{ $billing->order->customer->location }}, gps : {{ $billing->order->customer->gps }}</p>
                    </div>

                    <div class="col-6">
                        <p class="font-weight-bold">Filling Station: </p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold">{{ $billing->order->hydrant->name }}</p>
                    </div>

                    <div class="col-6">
                        <p class="font-weight-bold">Filling time:</p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold">{{ $date->format('g:i a') }}</p>
                    </div>

                    <div class="col-6">
                        <p class="font-weight-bold">Filling date: </p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold">{{ $date->toFormattedDateString() }}</p>
                    </div>

                    <div class="col-6">
                        <p class="font-weight-bold"><b>Order expiry date:</b></p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold"><b>{{ $date->toFormattedDateString() }}</b></p>
                    </div>

                    <div class="col-6">
                        <p class="font-weight-bold">Vehicle#</p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold">{{ $billing->truck->truck_num }}</p>
                    </div>

                    <div class="col-6">
                        <p class="font-weight-bold">Capacity: </p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold">{{ $billing->order->truck_type_fun->name }}</p>
                    </div>

                    <div class="col-6">
                        <p class="font-weight-bold">Driver Name: </p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold">{{ $billing->driver->name }}</p>
                    </div>

                    <div class="col-6">
                        <p class="font-weight-bold">Driver Contact:</p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold">{{ $billing->driver->phone }}</p>
                    </div>

                    @if ($billing->order->order_type != 'Dc quota')
                        <div class="col-6">
                            <p class="font-weight-bold">Extra Per KM amount:</p>
                        </div>
                        <div class="col-6">
                            <p class="font-weight-bold"> Rs. {{ number_format($billing->km_amount) }}</p>
                        </div>

                        <div class="col-6">
                            <p class="font-weight-bold">Invoice amount:</p>
                        </div>
                        <div class="col-6">
                            <p class="font-weight-bold"> Rs.
                                {{ number_format((int) $billing->amount + (int) $billing->km_amount) }}</p>
                        </div>

                        <div class="col-6">
                            <p class="font-weight-bold">Paid:</p>
                        </div>
                        <div class="col-6">
                            <p class="font-weight-bold">Rs.0</p>
                        </div>

                        <div class="col-6">
                            <p class="font-weight-bold">Balance:</p>
                        </div>
                        <div class="col-6">
                            <p class="font-weight-bold">
                                {{ number_format((int) $billing->amount + (int) $billing->km_amount) }}</p>
                        </div>

                        <div class="col-6">
                            <p class="font-weight-bold">Payment mode:</p>
                        </div>
                        <div class="col-6">
                            <p class="font-weight-bold">COD</p>
                        </div>
                    @endif
                    <div class="col-12 text-center">
                        {!! \QrCode::size(150)->generate($url) !!}
                    </div>
                    <div class="col-12  text-center pt-4">
                        <p style="line-height: 1.2 !important">if any Complaint/Query Contact Service Care on Phone
                            99245138 - 99245140. www.kwsb.gos.pk</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container p-4 bg-white w-100" id="getPrint">
            <div class="bg-white border border-dark border-3  m-auto"
                style="color: #000 !important; background-image: url('{{ asset('assets/img/watermark.png') }}'); background-repeat: no-repeat;background-position: center;">
                <div class="col-12 text-center">
                    <img src="{{ asset('assets/img/unnamed.png') }}" class="img-fluid" alt="main_logo"
                        style="width: 200px;">
                    <h1 class="text-center" style="color:#000;">E-SLIP</h1>
                    <p><b>Hydrant Management Portal</b></p>
                    <h5><b>DRIVER COPY</b></h5>
                </div>
                <div class="row text-left p-4">
                    <div class="col-6">
                        <p class="font-weight-bold">Order#</p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold">{{ wordwrap($billing->order->Order_Number,13,"<br>\n")  }}</p>
                    </div>
                    @php
                        $date = \Carbon\Carbon::parse($billing->created_at);
                        $date->toDateString();
                        $url = route('billing.details', $billing->id);
                    @endphp
                    <div class="col-6">
                        <p class="font-weight-bold">Customer Name:</p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold">{{ $billing->order->customer->name }}</p>
                    </div>

                    <div class="col-6">
                        <p class="font-weight-bold">Order Type:</p>
                    </div>
                    @if ($billing->order->order_type != null)
                        <div class="col-6">
                            <p class="font-weight-bold">{{ $billing->order->order_type }}</p>
                        </div>
                    @else
                        <div class="col-6">
                            <p class="font-weight-bold">{{ $billing->order->customer->standard }}</p>
                        </div>
                    @endif

                    <div class="col-6">
                        <p class="font-weight-bold">Customer Contact:</p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold">{{ $billing->order->customer->contact_num }}</p>
                    </div>

                    <div class="col-6">
                        <p class="font-weight-bold" style="line-height: 1.02 !important;">Area: </p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold" style="line-height: 1.02 !important;">
                            {{ $billing->order->customer->address }} {{ $billing->order->customer->street }}
                            {{ $billing->order->customer->location }}, gps : {{ $billing->order->customer->gps }}</p>
                    </div>

                    <div class="col-6">
                        <p class="font-weight-bold">Filling Station: </p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold">{{ $billing->order->hydrant->name }}</p>
                    </div>

                    <div class="col-6">
                        <p class="font-weight-bold">Filling time:</p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold">{{ $date->format('g:i a') }}</p>
                    </div>

                    <div class="col-6">
                        <p class="font-weight-bold">Filling date: </p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold">{{ $date->toFormattedDateString() }}</p>
                    </div>

                    <div class="col-6">
                        <p class="font-weight-bold"><b>Order expiry date:</b></p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold"><b>{{ $date->toFormattedDateString() }}</b></p>
                    </div>

                    <div class="col-6">
                        <p class="font-weight-bold">Vehicle#</p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold">{{ $billing->truck->truck_num }}</p>
                    </div>

                    <div class="col-6">
                        <p class="font-weight-bold">Capacity: </p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold">{{ $billing->order->truck_type_fun->name }}</p>
                    </div>

                    <div class="col-6">
                        <p class="font-weight-bold">Driver Name: </p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold">{{ $billing->driver->name }}</p>
                    </div>

                    <div class="col-6">
                        <p class="font-weight-bold">Driver Contact:</p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold">{{ $billing->driver->phone }}</p>
                    </div>
                    @if ($billing->order->order_type != 'Dc quota')
                        <div class="col-6">
                            <p class="font-weight-bold">Extra Per KM amount:</p>
                        </div>
                        <div class="col-6">
                            <p class="font-weight-bold"> Rs. {{ number_format($billing->km_amount) }}</p>
                        </div>

                        <div class="col-6">
                            <p class="font-weight-bold">Invoice amount:</p>
                        </div>
                        <div class="col-6">
                            <p class="font-weight-bold"> Rs.
                                {{ number_format((int) $billing->amount + (int) $billing->km_amount) }}</p>
                        </div>

                        <div class="col-6">
                            <p class="font-weight-bold">Paid:</p>
                        </div>
                        <div class="col-6">
                            <p class="font-weight-bold">Rs.0</p>
                        </div>

                        <div class="col-6">
                            <p class="font-weight-bold">Balance:</p>
                        </div>
                        <div class="col-6">
                            <p class="font-weight-bold">
                                {{ number_format((int) $billing->amount + (int) $billing->km_amount) }}</p>
                        </div>

                        <div class="col-6">
                            <p class="font-weight-bold">Payment mode:</p>
                        </div>
                        <div class="col-6">
                            <p class="font-weight-bold">COD</p>
                        </div>
                    @endif
                    {!! \QrCode::size(150)->generate($url) !!}

                </div>
            </div>
        </div>
        <div class="container p-4 bg-white w-100" id="getPrint">
            <div class="bg-white border border-dark border-3  m-auto"
                style="color: #000 !important; background-image: url('{{ asset('assets/img/watermark.png') }}'); background-repeat: no-repeat;background-position: center;">
                <div class="col-12 text-center">
                    <img src="{{ asset('assets/img/unnamed.png') }}" class="img-fluid" alt="main_logo"
                        style="width: 200px;">
                    <h1 class="text-center" style="color:#000;">E-SLIP</h1>
                    <p><b>Hydrant Management Portal</b></p>
                    <h5><b>OFFICE COPY</b></h5>
                </div>
                <div class="row text-left p-4">
                    <div class="col-6">
                        <p class="font-weight-bold">Order#</p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold">{{ wordwrap($billing->order->Order_Number,13,"<br>\n")  }}</p>
                    </div>
                    @php
                        $date = \Carbon\Carbon::parse($billing->order->created_at);
                        $date->toDateString();
                        $url = route('billing.details', $billing->id);
                    @endphp
                    <div class="col-6">
                        <p class="font-weight-bold">Customer Name:</p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold">{{ $billing->order->customer->name }}</p>
                    </div>

                    <div class="col-6">
                        <p class="font-weight-bold">Order Type:</p>
                    </div>
                    @if ($billing->order->order_type != null)
                        <div class="col-6">
                            <p class="font-weight-bold">{{ $billing->order->order_type }}</p>
                        </div>
                    @else
                        <div class="col-6">
                            <p class="font-weight-bold">{{ $billing->order->customer->standard }}</p>
                        </div>
                    @endif

                    <div class="col-6">
                        <p class="font-weight-bold">Customer Contact:</p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold">{{ $billing->order->customer->contact_num }}</p>
                    </div>

                    <div class="col-6">
                        <p class="font-weight-bold" style="line-height: 1.02 !important;">Area: </p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold" style="line-height: 1.02 !important;">
                            {{ $billing->order->customer->address }} {{ $billing->order->customer->street }}
                            {{ $billing->order->customer->location }}, gps : {{ $billing->order->customer->gps }}</p>
                    </div>

                    <div class="col-6">
                        <p class="font-weight-bold">Filling Station: </p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold">{{ $billing->order->hydrant->name }}</p>
                    </div>

                    <div class="col-6">
                        <p class="font-weight-bold">Filling time:</p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold">{{ $date->format('g:i a') }}</p>
                    </div>

                    <div class="col-6">
                        <p class="font-weight-bold">Filling date: </p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold">{{ $date->toFormattedDateString() }}</p>
                    </div>

                    <div class="col-6">
                        <p class="font-weight-bold"><b>Order expiry date:</b></p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold"><b>{{ $date->toFormattedDateString() }}</b></p>
                    </div>

                    <div class="col-6">
                        <p class="font-weight-bold">Vehicle#</p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold">{{ $billing->truck->truck_num }}</p>
                    </div>

                    <div class="col-6">
                        <p class="font-weight-bold">Capacity: </p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold">{{ $billing->order->truck_type_fun->name }}</p>
                    </div>

                    <div class="col-6">
                        <p class="font-weight-bold">Driver Name: </p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold">{{ $billing->driver->name }}</p>
                    </div>

                    <div class="col-6">
                        <p class="font-weight-bold">Driver Contact:</p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold">{{ $billing->driver->phone }}</p>
                    </div>

                    @if ($billing->order->order_type != 'Dc quota')
                        <div class="col-6">
                            <p class="font-weight-bold">Extra Per KM amount:</p>
                        </div>
                        <div class="col-6">
                            <p class="font-weight-bold"> Rs. {{ number_format($billing->km_amount) }}</p>
                        </div>

                        <div class="col-6">
                            <p class="font-weight-bold">Invoice amount:</p>
                        </div>
                        <div class="col-6">
                            <p class="font-weight-bold"> Rs.
                                {{ number_format((int) $billing->amount + (int) $billing->km_amount) }}</p>
                        </div>

                        <div class="col-6">
                            <p class="font-weight-bold">Paid:</p>
                        </div>
                        <div class="col-6">
                            <p class="font-weight-bold">Rs.0</p>
                        </div>

                        <div class="col-6">
                            <p class="font-weight-bold">Balance:</p>
                        </div>
                        <div class="col-6">
                            <p class="font-weight-bold">
                                {{ number_format((int) $billing->amount + (int) $billing->km_amount) }}</p>
                        </div>

                        <div class="col-6">
                            <p class="font-weight-bold">Payment mode:</p>
                        </div>
                        <div class="col-6">
                            <p class="font-weight-bold">COD</p>
                        </div>
                    @endif
                    {!! \QrCode::size(150)->generate($url) !!}

                </div>
            </div>
        </div>
        <!--<button type="button"onclick="getPrint()" class="btn btn-primary">print</button>-->
    </div>
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
