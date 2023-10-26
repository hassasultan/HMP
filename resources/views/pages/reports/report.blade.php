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
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #000;
        }

        p {
            color: #000;
        }
    </style>
    <div id="app">
        <button id="btnExport" onclick="exportReportToExcel(this)" class="btn btn-success"><i class="fa fa-file-excel-o me-2 fs-3" aria-hidden="true"></i></button>

        <div class="container p-4 bg-white  text-center " id="getPrint">
            <div class="bg-white m-auto">
                <div class="row">
                    <div class="col-7 text-start" style=" padding-top:2.4rem;">
                        <h5 class="fs-1">HYDRANT MANGEMENT PORTAL</h5>
                        <p style="font-size: 1.2rem"><span style="font-weight: bold;">Daily Report (In Gallons)</span>
                        </p>
                        <h5 style="font-size: 0.8rem"><span style="font-weight: bold;">DATE FROM:
                            </span>{{ $dateS }} <span style="font-weight: bold;">TO: </span>{{ $dateE }}
                        </h5>
                        <h5 style="font-size: 0.8rem"><span style="font-weight: bold;">Hydrants:</span>
                            {{ $hydrants_name }}</h5>
                    </div>
                    <div class="col-5">
                        <img src="{{ asset('assets/img/unnamed.png') }}" class="img-fluid" alt="main_logo"
                            style="width: 200px;">
                    </div>
                    <div class="col-12 mt-2">


                        <div class="table mt-4">
                            <table class="table  table-striped">
                                <thead>
                                    <tr style="background-color:#5b9bd5; color: #FFF !important;">
                                        <th>Date</th>
                                        @foreach ($hydrants as $row)
                                            <th width="10px">{{ $row->name }}</th>
                                        @endforeach
                                        {{-- @foreach (array_unique(array_column($complaints->toArray(), 'type_id')) as $complaintTypeId)
                                            <th>{{ $complaints->firstWhere('type_id', $complaintTypeId)->type->title }}</th>
                                        @endforeach --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($report as $key => $row)
                                        <tr>
                                            <td>{{ date('d-m-Y', strtotime($row['Date']))  }}</td>
                                            @foreach ($hydrants as $hydrant)
                                                <td>{{ $row[0][$hydrant->name] }}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach

                                    {{-- @foreach ($complaints->groupBy('date') as $date => $complaintsByDate)
                                        <tr>
                                            <td>{{ $date }}</td>
                                            @foreach ($complaints->pluck('type')->unique('id') as $complaintType)
                                                @php
                                                    $count = $complaintsByDate->where('type_id', $complaintType->id)->sum('num_complaints');
                                                @endphp
                                                <td>{{ $count ?? 0 }}</td>
                                            @endforeach

                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td><strong>Total</strong></td>
                                        @foreach (array_unique(array_column($complaints->toArray(), 'type_id')) as $complaintTypeId)
                                        <td><b>{{ $complaints->where('type_id', $complaintTypeId)->sum('num_complaints') }}</b></td>
                                        @endforeach
                                    </tr> --}}
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>Total</td>
                                        @foreach ($hydrants as $hydrant)
                <td>
                    {{-- Calculate and display the total for each column --}}
                    <?php
                    $columnTotal = 0;
                    foreach ($report as $row) {
                        $columnTotal += $row[0][$hydrant->name];
                    }
                    echo $columnTotal;
                    ?>
                </td>
            @endforeach
                                    </tr>
                                </tfoot>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- @foreach (array_unique(array_column($complaintsByDate->toArray(), 'type_id')) as $complaintTypeId)
        <td>{{ $complaintsByDate->where('type_id', $complaintTypeId)->sum('num_complaints') }}</td>
    @endforeach --}}
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
    <script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>

    <script>
        function exportReportToExcel() {
            let table = document.getElementsByTagName(
            "table"); // you can use document.getElementById('tableId') as well by providing id to the table tag
            TableToExcel.convert(table[
            0], { // html code may contain multiple tables so here we are refering to 1st table tag
                name: `export.xlsx`, // fileName you could use any name
                sheet: {
                    name: 'Sheet 1' // sheetName
                }
            });
        };

        function getPrint() {
            var elem = document.getElementById('getPrint');
            var print_area = window.open();
            print_area.document.write('<html>');
            print_area.document.write(
                '<link rel="dns-prefetch" href="//fonts.gstatic.com"><link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"><link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" /><link href="{{ asset("assets/css/nucleo-icons.css") }}" rel="stylesheet" /><link href="{{ asset("assets/css/nucleo-svg.css") }}" rel="stylesheet" /><link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet"><link id="pagestyle" href="{{ asset("assets/css/material-dashboard.css?v=3.0.0") }}" rel="stylesheet" /><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" /><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw=="crossorigin="anonymous" referrerpolicy="no-referrer" /><link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />'
            );
            print_area.document.write('<body>');
            print_area.document.write(elem.innerHTML);
            print_area.document.write('</body></html>');
            // print_area.focus();
            print_area.print();
            // print_area.close();
        }
</script>
    <script src="{{ asset('assets/js/material-dashboard.min.js?v=3.0.0') }}"></script>
</body>

</html>
