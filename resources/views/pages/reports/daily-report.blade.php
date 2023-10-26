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
        {{-- <iframe id="txtArea1" style="display:none"></iframe>
    <button id="btnExport" onclick="fnExcelReport();"> EXPORT </button> --}}
    <button id="btnExport" onclick="exportReportToExcel(this)" class="btn btn-success"><i class="fa fa-file-excel-o me-2 fs-3" aria-hidden="true"></i> FILE</button>
        <div class="container p-4 bg-white  text-center " id="getPrint">
            <div class="bg-white m-auto">
                <div class="row">
                    <div class="col-7 text-start" style=" padding-top:2.4rem;">
                        <h5 class="fs-1">HYDRANT MANGEMENT PORTAL</h5>
                        <p style="font-size: 1.2rem"><span style="font-weight: bold;">Order Reports (In Order
                                Type)</span>
                        </p>
                        <h5 style="font-size: 0.8rem"><span style="font-weight: bold;">DATE FROM:
                            </span>{{ $startDate }} <span style="font-weight: bold;">TO: </span>{{ $endDate }}
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
                                <thead id="headerTable">
                                    <tr style="background-color:#5b9bd5; color: #FFF !important;">
                                        <th>Date</th>
                                        <th>Commercial</th>
                                        <th>Online (GPS)</th>
                                        <th>Gps ( billing )</th>
                                        <th>Gps ( care off )</th>
                                        <th>GRATIS</th>
                                        <th>Pak rangers</th>
                                        <th>P.A.F korangi creek</th>
                                        <th>Dc quota</th>
                                        <th>Govt. vehicle</th>
                                        <th>Total Orders</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totals = [
                                            'Commercial' => 0,
                                            'Online (GPS)' => 0,
                                            'Gps ( billing )' => 0,
                                            'Gps ( care off )' => 0,
                                            'GRATIS' => 0,
                                            'Pak rangers' => 0,
                                            'P.A.F korangi creek' => 0,
                                            'Dc quota' => 0,
                                            'Govt. vehicle' => 0,
                                            'Total Orders' => 0,
                                        ];
                                    @endphp
                                    @foreach ($reportData as $data)
                                        <tr>
                                            <td>{{ date('d-m-Y', strtotime($data->order_date)) }}</td>
                                            <td>{{ $data->Commercial }}</td>
                                            <td>{{ $data->{"Online (GPS)"} }}</td>
                                            <td>{{ $data->{"Gps ( billing )"} }}</td>
                                            <td>{{ $data->{"Gps ( care off )"} }}</td>
                                            <td>{{ $data->GRATIS }}</td>
                                            <td>{{ $data->{"Pak rangers"} }}</td>
                                            <td>{{ $data->{"P.A.F korangi creek"} }}</td>
                                            <td>{{ $data->{"Dc quota"} }}</td>
                                            <td>{{ $data->{"Govt. vehicle"} }}</td>
                                            <td>{{ optional($data)->order_count }}</td>
                                        </tr>
                                        @php
                                            // Calculate column totals
                                            $totals['Commercial'] = ($totals['Commercial'] ?? 0) + $data->Commercial;
                                            $totals['Online (GPS)'] = ($totals['Online (GPS)'] ?? 0) + $data->{"Online (GPS)"};
                                            $totals['Gps ( billing )'] = ($totals['Gps ( billing )'] ?? 0) + $data->{"Gps ( billing )"};
                                            $totals['Gps ( care off )'] = ($totals['Gps ( care off )'] ?? 0) + $data->{"Gps ( care off )"};
                                            $totals['GRATIS'] = ($totals['GRATIS'] ?? 0) + $data->GRATIS;
                                            $totals['Pak rangers'] = ($totals['Pak rangers'] ?? 0) + $data->{"Pak rangers"};
                                            $totals['P.A.F korangi creek'] = ($totals['P.A.F korangi creek'] ?? 0) + $data->{"P.A.F korangi creek"};
                                            $totals['Dc quota'] = ($totals['Dc quota'] ?? 0) + $data->{"Dc quota"};
                                            $totals['Govt. vehicle'] = ($totals['Govt. vehicle'] ?? 0) + $data->{"Govt. vehicle"};
                                            $totals['Total Orders'] = ($totals['Total Orders'] ?? 0) + optional($data)->order_count;
                                        @endphp
                                    @endforeach
                                    <tr>
                                        <td><strong>Total</strong></td>
                                        <td><strong>{{ $totals['Commercial'] }}</strong></td>
                                        <td><strong>{{ $totals['Online (GPS)'] }}</strong></td>
                                        <td><strong>{{ $totals['Gps ( billing )'] }}</strong></td>
                                        <td><strong>{{ $totals['Gps ( care off )'] }}</strong></td>
                                        <td><strong>{{ $totals['GRATIS'] }}</strong></td>
                                        <td><strong>{{ $totals['Pak rangers'] }}</strong></td>
                                        <td><strong>{{ $totals['P.A.F korangi creek'] }}</strong></td>
                                        <td><strong>{{ $totals['Dc quota'] }}</strong></td>
                                        <td><strong>{{ $totals['Govt. vehicle'] }}</strong></td>
                                        <td><strong>{{ $totals['Total Orders'] }}</strong></td>
                                    </tr>
                                </tbody>
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
        function exportReportToExcel()
        {
            let table = document.getElementsByTagName("table"); // you can use document.getElementById('tableId') as well by providing id to the table tag
            TableToExcel.convert(table[0], { // html code may contain multiple tables so here we are refering to 1st table tag
                name: `export.xlsx`, // fileName you could use any name
                sheet: {
                name: 'Sheet 1' // sheetName
                }
            });
        }
        function fnExcelReport()
        {
            var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
            var textRange; var j=0;
            tab = document.getElementById('headerTable'); // id of table

            for(j = 0 ; j < tab.rows.length ; j++)
            {
                tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
                //tab_text=tab_text+"</tr>";
            }

            tab_text=tab_text+"</table>";
            tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
            tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
            tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

            var ua = window.navigator.userAgent;
            var msie = ua.indexOf("MSIE ");

            if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
            {
                txtArea1.document.open("txt/html","replace");
                txtArea1.document.write(tab_text);
                txtArea1.document.close();
                txtArea1.focus();
                sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
            }
            else                 //other browser not tested on IE 11
                sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));

            return (sa);
        }

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
