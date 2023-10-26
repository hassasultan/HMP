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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>


</head>

<body>

    <div id="app">

        {{-- <button id="btnExport" onclick="exportReportToExcel(this)" class="btn btn-success"><i class="fa fa-file-excel-o me-2 fs-3" aria-hidden="true"></i> FILE</button> --}}
        <div class="container" id="pdf-content">
            {{-- <table class="border" style="width:100%;">
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
            </table> --}}
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
                            $pending = App\Models\Orders::with('billing')
                                ->whereHas('billing', fn($query) => $query->where('status', 0))
                                ->where('hydrant_id', $row->id)
                                ->count();
                            $close = App\Models\Orders::with('billing')
                                ->whereHas('billing', fn($query) => $query->where('status', 1))
                                ->where('hydrant_id', $row->id)
                                ->count();
                            $dispatch = App\Models\Orders::with('billing')
                                ->whereHas('billing', fn($query) => $query->where('status', 2))
                                ->where('hydrant_id', $row->id)
                                ->count();
                            $cancelled = App\Models\Orders::with('billing')
                                ->whereHas('billing', fn($query) => $query->where('status', 3))
                                ->where('hydrant_id', $row->id)
                                ->count();
                            $total = App\Models\Orders::with('billing')
                                ->whereHas('billing')
                                ->where('hydrant_id', $row->id)
                                ->count();
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

    {{-- <button type="submit" class="btn btn-primary">Download PDF</button> --}}
    <button type="button" id="convert" class="btn btn-primary">print</button>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>


    <script>
        function exportReportToExcel() {
            let table = document.getElementById("pdf-content"); // you can use document.getElementById('tableId') as well by providing id to the table tag
            TableToExcel.convert(table[
            0], { // html code may contain multiple tables so here we are refering to 1st table tag
                name: `export.xlsx`, // fileName you could use any name
                sheet: {
                    name: 'Sheet 1' // sheetName
                }
            });
        }
        document.getElementById('convert').addEventListener('click', function() {
            const element = document.getElementById('pdf-content');
            html2pdf()
                .from(element)
                .save('my-pdf-document.pdf');
        });
    </script>

</body>

</html>
