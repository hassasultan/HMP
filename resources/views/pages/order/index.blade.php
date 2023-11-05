@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="text-white text-capitalize ps-3">Order List</h6>
                            </div>
                            <div class="col-6 text-end">
                                <a class="btn bg-gradient-dark mb-0 mr-3" href="{{ route('order.create') }}"><i
                                        class="material-icons text-sm">add</i>&nbsp;&nbsp;<i class="fa fa-truck"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="p-3">
                            @if (auth()->user()->role == 1)
                                <form role="form" method="get" action="{{ route('order.list') }}" enctype="multipart/form-data">
                            @else
                                <form role="form" method="get" action="{{ route('hydrant.order.list') }}" enctype="multipart/form-data">
                            @endif

                                <div class="row">
                                    <div class="form-group col-3 p-3">
                                        <label>From Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="from_date"
                                            value="{{ request()->get('from_date') }}"  />
                                    </div>
                                    <div class="form-group col-3 p-3">
                                        <label>To Date</label>
                                        <input type="date" class="form-control border-bottom"
                                            placeholder="Enter Customer Title..." name="to_date" value="{{ request()->get('to_date') }}"
                                             />
                                    </div>
                                    <div class="form-group col-3 p-3">
                                        <label>ORDER NUMBER</label>
                                        <input type="text" class="form-control border-bottom"
                                            placeholder="Enter ORDER NUMBER..." name="order_num" value="{{ request()->get('order_num') }}"
                                             />
                                    </div>
                                    <div class="form-group col-3 p-3">
                                        <label>Customer Phone</label>
                                        <input type="number" class="form-control border-bottom"
                                            placeholder="Enter Customer Phone..." name="customer_phone" value="{{ request()->get('customer_phone') }}"
                                             />
                                    </div>
                                    <div class="form-group col-3 p-3">
                                        <label>Vehicle Types</label>
                                        <select name="vehicle_type"
                                            class="select2-multiple form-control border-bottom">
                                            <option disabled selected value="">-- Select Vehicle Type --</option>
                                            @foreach ($vehicle_type as $row)
                                                <option value="{{ $row->id }}" @if(request()->get('vehicle_type') == $row->id) selected @endif>{{ $row->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-3 p-3">
                                        <label>Order Type</label>
                                        <select name="order_type" class="select2-multiple form-control fs-14  h-50px">
                                            <option disabled selected value="">-- Select Order Type --</option>

                                            @if (auth()->user()->role == 2)
                                                @if (auth()->user()->type == 'commercial')
                                                    <option value="Commercial" @if(request()->get('order_type') == "Commercial") selected @endif>Commercial</option>
                                                @else
                                                    <option value="Online (GPS)" @if(request()->get('order_type') == "Online (GPS)") selected @endif>Online (GPS)</option>
                                                    <option value="Gps ( billing )" @if(request()->get('order_type') == "Gps ( billing )") selected @endif>Gps ( billing )</option>
                                                    <option value="Gps ( care off )" @if(request()->get('order_type') == "Gps ( care off )") selected @endif>Gps ( care off )</option>
                                                    <option value="GRATIS" @if(request()->get('order_type') == "GRATIS") selected @endif>GRATIS</option>
                                                    <option value="Pak rangers" @if(request()->get('order_type') == "Pak rangers") selected @endif>Pak rangers</option>
                                                    <option value="P.A.F korangi creek" @if(request()->get('order_type') == "P.A.F korangi creek") selected @endif>P.A.F korangi creek</option>
                                                    <option value="Dc quota" @if(request()->get('order_type') == "Dc quota") selected @endif>Dc quota</option>
                                                    <option value="Govt. vehicle" @if(request()->get('order_type') == "Govt. vehicle") selected @endif>Govt. vehicle</option>
                                                @endif
                                            @else
                                                <option value="Commercial" @if(request()->get('order_type') == "Commercial") selected @endif>Commercial</option>
                                                <option value="Online (GPS)" @if(request()->get('order_type') == "Online (GPS)") selected @endif>Online (GPS)</option>
                                                <option value="Gps ( billing )" @if(request()->get('order_type') == "Gps ( billing )") selected @endif>Gps ( billing )</option>
                                                <option value="Gps ( care off )" @if(request()->get('order_type') == "Gps ( care off )") selected @endif>Gps ( care off )</option>
                                                <option value="GRATIS" @if(request()->get('order_type') == "GRATIS") selected @endif>GRATIS</option>
                                                <option value="Pak rangers" @if(request()->get('order_type') == "Pak rangers") selected @endif>Pak rangers</option>
                                                <option value="P.A.F korangi creek" @if(request()->get('order_type') == "P.A.F korangi creek") selected @endif>P.A.F korangi creek</option>
                                                <option value="Dc quota" @if(request()->get('order_type') == "Dc quota") selected @endif>Dc quota</option>
                                                <option value="Govt. vehicle" @if(request()->get('order_type') == "Govt. vehicle") selected @endif>Govt. vehicle</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group col-3 p-3 mt-4">
                                    <label>Per Page Enteries</label>

                                        <select name="page" class="select2-multiple form-control fs-14  h-50px">
                                            <option value="20" @if(request()->get('page') == "20") selected @endif>20</option>
                                            <option value="50" @if(request()->get('page') == "50") selected @endif>50</option>
                                            <option value="100" @if(request()->get('page') == "100") selected @endif>100</option>
                                            <option value="200" @if(request()->get('page') == "200") selected @endif>200</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-3 p-3 mt-4">
                                        <button type="submit" class="btn bg-gradient-primary btn-lg ">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6 p-2">
                        @if (auth()->user()->role == 1)
                                <form role="form" method="get" action="{{ route('order.list') }}" enctype="multipart/form-data">
                            @else
                                <form role="form" method="get" action="{{ route('hydrant.order.list') }}" enctype="multipart/form-data">
                            @endif
                            <input type="hidden" name="report" value="1"/>
                            <button type="submit" class="btn btn-success"><i class="fa fa-file-excel-o me-2 fs-3"
                                    aria-hidden="true"></i> File</button>
                        </form>
                    </div>
                    {{-- <button id="export-excel" onclick="converExcel()" class="btn btn-primary">Export to Excel</button> --}}

                </div>
                <div class="card-body px-0 pb-2">
                    <div class=" p-0">
                        <table  class="table table-striped table-bordered align-items-center mb-0 display nowrap">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Order
                                        Number</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Customer Details </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Hydrant</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Customer Standard</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Customer Alternate Number </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Vehicle Type </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Generate Bill </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Created_at</th>
                                    {{-- <th class="text-secondary opacity-7"></th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($order) > 0)
                                    @foreach ($order as $key => $row)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $row->Order_Number }}</h6>
                                                        {{-- <p class="text-xs text-secondary mb-0">{{ $row->company_name }}</p> --}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $row->customer->name }}</p>
                                                <p class="text-xs text-secondary mb-0">{{ $row->customer->contact_num }}</p>
                                                <p class="text-xs text-secondary mb-0">{{ $row->customer->address }}</p>
                                            </td>
                                            <td>
                                                <p class="text-center font-weight-bold mb-0">{{ $row->hydrant->name }}
                                                </p>
                                            </td>
                                            <td>
                                                @if ($row->order_type != null)
                                                    <p class="text-center font-weight-bold mb-0">
                                                        {{ $row->order_type }}</p>
                                                @else
                                                    <p class="text-center font-weight-bold mb-0">
                                                        {{ $row->customer->standard }}</p>
                                                @endif
                                            </td>
                                            <td>
                                                <p class="text-xs text-secondary mb-0">{{ $row->contact_num }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $row->truck_type_fun->name }}
                                                </p>
                                            </td>

                                            <td class="align-middle text-center">
                                                @if ($row->billing != null)
                                                    <span class="badge bg-gradient-primary">Already generated</span>
                                                @else
                                                    <a class="btn bg-gradient-dark mb-0 mr-3"
                                                        href="{{ route('billing.create', $row->id) }}"><i
                                                            class="material-icons text-sm">add</i>&nbsp;&nbsp;<i
                                                            class="fa fa-truck"></i></a>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $row->created_at }}</span>
                                            </td>

                                        </tr>
                                    @endforeach
                                @else
                                    No Record Find...
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $order->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
        integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.4/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blob-polyfill/2.0.20171115/Blob.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.8/FileSaver.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/TableExport/5.2.0/js/tableexport.min.js"
        integrity="sha512-XmZS54be9JGMZjf+zk61JZaLZyjTRgs41JLSmx5QlIP5F+sSGIyzD2eJyxD4K6kGGr7AsVhaitzZ2WTfzpsQzg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function converExcel() {

            var sFileName = 'ngophi';
            $('#example1').tableExport({
                fileName: sFileName,
                type: 'xlsx'
            });


            // Your code that uses TableExport
            // var tableExport = TableExport(document.getElementById('example1'));
            // console.log(tableExport);
            // // Call the convert function
            // tableExport.convert({
            //     format: 'xlsx', // Format for the export
            //     filename: 'my-excel-file', // File name
            // });
        }
    </script>

@endsection
