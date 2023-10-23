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

</head>

<body>
    <style>
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: sans-serif;
            color: #000;
        }

        p {
            color: #000;
        }
        .border
        {
            border: 1px solid #CCC;
        }
        .container
        {
            margin: 0 auto;
        }
        .w-50
        {
            width:50%;
        }
        .p-0
        {
            padding: 0px !important;
        }
        .text-center
        {
            text-align: center;
        }
        .col-2
        {
            width: 16.66667%;
        }
        .col-8
        {
            width: 66.66667%;
        }
        .row {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            display: flex;
            flex-wrap: wrap;
            margin-top: calc(-1 * var(--bs-gutter-y));
            margin-right: calc(-.5 * var(--bs-gutter-x));
            margin-left: calc(-.5 * var(--bs-gutter-x));
        }
        .m-0
        {
            margin: 0px !important;
        }
    </style>
    <div id="app">
        <div class="container">
            <table class="border" style="width:100%;">
                <thead>
                    <tr class="border">
                        <td class="border"></td>
                        <td>
                            <tr class="border"><h2>KWSB-OTS</h2></tr>
                            <tr class="border"><h6>Hydrant Request Summary</h6></tr>
                            <tr class="border"><h6>For {{ $dateS }} - {{ $dateE }}</h6></tr>
                        </td>
                        <td class="border"></td>
                    </tr>
                </thead>
            </table>
            <div class="p-0 border" style=" margin:0 auto;">
                <div class="row m-0 p-0">
                    <div class="col-2 border" style="border: 1px solid #CCC;"></div>
                    <div class="col-8 border p-0 text-center">
                        <div class="col-12 border p-2">
                            <h2>KWSB-OTS</h2>
                        </div>
                        <div class="col-12 border p-2">
                            <h6>Hydrant Request Summary</h6>
                        </div>
                        <div class="col-12 border p-2">
                            <h6>For {{ $dateS }} - {{ $dateE }}</h6>
                        </div>
                    </div>
                    <div class="col-2 border"></div>
                    <div class="col-2 border">
                        <h6>Hydrant</h6>
                    </div>
                    <div class="col-2 border">
                        <h6>Pending</h6>
                    </div>
                    <div class="col-2 border">
                        <h6>Dispatched</h6>
                    </div>
                    <div class="col-2 border">
                        <h6>Closed</h6>
                    </div>
                    <div class="col-2 border">
                        <h6>Cancelled</h6>
                    </div>
                    <div class="col-2 border">
                        <h6>Total</h6>
                    </div>
                    @foreach ($hydrants as $row)
                    @php
                        $pending =  App\Models\Orders::with('billing')->whereHas('billing', fn ($query) => $query->where('status', 0))->where('hydrant_id',$row->id)->count();
                        $close =  App\Models\Orders::with('billing')->whereHas('billing', fn ($query) => $query->where('status', 1))->where('hydrant_id',$row->id)->count();
                        $dispatch =  App\Models\Orders::with('billing')->whereHas('billing', fn ($query) => $query->where('status', 2))->where('hydrant_id',$row->id)->count();
                        $cancelled =  App\Models\Orders::with('billing')->whereHas('billing', fn ($query) => $query->where('status', 3))->where('hydrant_id',$row->id)->count();
                        $total =  App\Models\Orders::with('billing')->whereHas('billing')->where('hydrant_id',$row->id)->count();
                    @endphp
                        <div class="col-2 border">
                            <p>{{ $row->name }}</p>
                        </div>
                        <div class="col-2 border">
                            <p>{{ $pending }}</p>
                        </div>
                        <div class="col-2 border">
                            <p>{{ $dispatch }}</p>
                        </div>
                        <div class="col-2 border">
                            <p>{{ $close }}</p>
                        </div>
                        <div class="col-2 border">
                            <p>{{ $cancelled }}</p>
                        </div>
                        <div class="col-2 border">
                            <p>{{ $total }}</p>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('generate.report.hydrant.orders') }}">
        <input type="hidden" name="download" value="pdf"/>
        <button type="submit" class="btn btn-primary">Download PDF</button>
    </form>
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
    </body>

    </html>