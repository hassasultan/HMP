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
                    <div class="col-md-6 p-2">
                        <a  href="{{ route('excelview') }}" class="btn btn-success"><i class="fa fa-file-excel-o me-2 fs-3" aria-hidden="true"></i> File</a>
                    </div>
                    {{-- <button id="export-excel" onclick="converExcel()" class="btn btn-primary">Export to Excel</button> --}}

                </div>
                <div class="card-body px-0 pb-2">
                    <div class=" p-0">
                        <table id="example1" class="table table-bordered align-items-center mb-0 display nowrap">
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
                                                    {{-- <div>
                                    <img src="{{ asset('storage/'.$row->image) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                </div> --}}
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
                                            {{-- <td class="align-middle">
                                <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                Edit
                                </a>
                            </td> --}}
                                        </tr>
                                    @endforeach
                                @else
                                    No Record Find...
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.4/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blob-polyfill/2.0.20171115/Blob.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.8/FileSaver.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/TableExport/5.2.0/js/tableexport.min.js"
        integrity="sha512-XmZS54be9JGMZjf+zk61JZaLZyjTRgs41JLSmx5QlIP5F+sSGIyzD2eJyxD4K6kGGr7AsVhaitzZ2WTfzpsQzg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function converExcel() {

            var sFileName = 'ngophi';
            $('#example1').tableExport({fileName: sFileName,
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
