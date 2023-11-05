@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="text-white text-capitalize ps-3">Billing List</h6>
                            </div>
                            {{-- <div class="col-6 text-end">
                    <a class="btn bg-gradient-dark mb-0 mr-3" href="{{ route('billing.create') }}"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;<i class="fa fa-truck"></i></a>
                </div> --}}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="p-3">
                            @if (auth()->user()->role == 1)
                                <form role="form" method="get" action="{{ route('billing.list') }}"
                                    enctype="multipart/form-data">
                                @else
                                    <form role="form" method="get" action="{{ route('hydrant.billing.list') }}"
                                        enctype="multipart/form-data">
                            @endif

                            <div class="row">
                                <div class="form-group col-3 p-3">
                                    <label>From Date</label>
                                    <input type="date" class="form-control border-bottom"
                                        placeholder="Enter Customer Title..." name="from_date"
                                        value="{{ request()->get('from_date') }}" />
                                </div>
                                <div class="form-group col-3 p-3">
                                    <label>To Date</label>
                                    <input type="date" class="form-control border-bottom"
                                        placeholder="Enter Customer Title..." name="to_date"
                                        value="{{ request()->get('to_date') }}" />
                                </div>
                                <div class="form-group col-3 p-3">
                                    <label>ORDER NUMBER</label>
                                    <input type="text" class="form-control border-bottom"
                                        placeholder="Enter ORDER NUMBER..." name="order_num"
                                        value="{{ request()->get('order_num') }}" />
                                </div>
                                <div class="form-group col-3 p-3">
                                    <label>Customer Phone</label>
                                    <input type="number" class="form-control border-bottom"
                                        placeholder="Enter Customer Phone..." name="customer_phone"
                                        value="{{ request()->get('customer_phone') }}" />
                                </div>
                                <div class="form-group col-3 p-3">
                                    <label>Vehicle Types</label>
                                    <select name="vehicle_type" class="select2-multiple form-control border-bottom">
                                        <option disabled selected value="">-- Select Vehicle Type --</option>
                                        @foreach ($vehicle_type as $row)
                                            <option value="{{ $row->id }}"
                                                @if (request()->get('vehicle_type') == $row->id) selected @endif>{{ $row->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-3 p-3">
                                    <label>Order Type</label>
                                    <select name="order_type" class="select2-multiple form-control fs-14  h-50px">
                                        <option disabled selected value="">-- Select Order Type --</option>

                                        @if (auth()->user()->role == 2)
                                            @if (auth()->user()->type == 'commercial')
                                                <option value="Commercial"
                                                    @if (request()->get('order_type') == 'Commercial') selected @endif>Commercial</option>
                                            @else
                                                <option value="Online (GPS)"
                                                    @if (request()->get('order_type') == 'Online (GPS)') selected @endif>Online (GPS)</option>
                                                <option value="Gps ( billing )"
                                                    @if (request()->get('order_type') == 'Gps ( billing )') selected @endif>Gps ( billing )
                                                </option>
                                                <option value="Gps ( care off )"
                                                    @if (request()->get('order_type') == 'Gps ( care off )') selected @endif>Gps ( care off )
                                                </option>
                                                <option value="GRATIS" @if (request()->get('order_type') == 'GRATIS') selected @endif>
                                                    GRATIS</option>
                                                <option value="Pak rangers"
                                                    @if (request()->get('order_type') == 'Pak rangers') selected @endif>Pak rangers</option>
                                                <option value="P.A.F korangi creek"
                                                    @if (request()->get('order_type') == 'P.A.F korangi creek') selected @endif>P.A.F korangi creek
                                                </option>
                                                <option value="Dc quota" @if (request()->get('order_type') == 'Dc quota') selected @endif>
                                                    Dc quota</option>
                                                <option value="Govt. vehicle"
                                                    @if (request()->get('order_type') == 'Govt. vehicle') selected @endif>Govt. vehicle
                                                </option>
                                            @endif
                                        @else
                                            <option value="Commercial" @if (request()->get('order_type') == 'Commercial') selected @endif>
                                                Commercial</option>
                                            <option value="Online (GPS)"
                                                @if (request()->get('order_type') == 'Online (GPS)') selected @endif>Online (GPS)</option>
                                            <option value="Gps ( billing )"
                                                @if (request()->get('order_type') == 'Gps ( billing )') selected @endif>Gps ( billing )</option>
                                            <option value="Gps ( care off )"
                                                @if (request()->get('order_type') == 'Gps ( care off )') selected @endif>Gps ( care off )
                                            </option>
                                            <option value="GRATIS" @if (request()->get('order_type') == 'GRATIS') selected @endif>
                                                GRATIS</option>
                                            <option value="Pak rangers" @if (request()->get('order_type') == 'Pak rangers') selected @endif>
                                                Pak rangers</option>
                                            <option value="P.A.F korangi creek"
                                                @if (request()->get('order_type') == 'P.A.F korangi creek') selected @endif>P.A.F korangi creek
                                            </option>
                                            <option value="Dc quota" @if (request()->get('order_type') == 'Dc quota') selected @endif>Dc
                                                quota</option>
                                            <option value="Govt. vehicle"
                                                @if (request()->get('order_type') == 'Govt. vehicle') selected @endif>Govt. vehicle</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-3 p-3 mt-4">
                                    <label>Per Page Enteries</label>
                                    <select name="per_page" class="select2-multiple form-control fs-14  h-50px">
                                        <option value="20" @if (request()->get('per_page') == '20') selected @endif>20
                                        </option>
                                        <option value="50" @if (request()->get('per_page') == '50') selected @endif>50
                                        </option>
                                        <option value="100" @if (request()->get('per_page') == '100') selected @endif>100
                                        </option>
                                        <option value="200" @if (request()->get('per_page') == '200') selected @endif>200
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-3 p-3 mt-4">
                                    <button type="submit" class="btn bg-gradient-primary btn-lg ">Search</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="col-md-12 p-0">
                        <form id="form-bulk-status" action="{{ route('billing.status.bulk') }}" method="POST">
                            @csrf
                            <div class="col-md-2">
                                <textarea class="d-none" name="reason" id="canc-reason"></textarea>
                                <label>Select Bulk Action</label>
                                <select name="status" class="select2-multiple form-control fs-14  h-50px"
                                    id="bulk-change">
                                    <option value="" selected disabled>-- Select Status --</option>
                                    <option value="1">Closed</option>
                                    <option value='3'>Cancelled</option>
                                </select>
                            </div>
                        <table class="table table-striped table-bordered align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>

                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Order
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Vehicle </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Driver</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Hydrants</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Customer Details</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Customer Standard</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        amount</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($billing) > 0)

                                        @foreach ($billing as $key => $row)
                                            <tr>
                                                <td>
                                                    @if ($row->status != 3 && $row->status != 1)
                                                        <input type="checkbox" name="getIds[]"
                                                            value="{{ $row->id }}" />
                                                    @endif
                                                </td>
                                                <td>{{ ++$key }}</td>
                                                <td style="width: 5%;">
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $row->order->Order_Number }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="width: 5%;">
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $row->truck->name }}({{ $row->truck->company_name }})</p>
                                                    <p class="text-xs text-secondary mb-0">{{ $row->truck->truck_num }}
                                                    </p>
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ $row->truck->truckCap->name }}
                                                    </p>
                                                </td>
                                                <td style="width: 5%;">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $row->driver->name }}</p>
                                                    <p class="text-xs text-secondary mb-0">{{ $row->driver->nic }}</p>
                                                </td>
                                                <td style="width: 5%;">
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $row->order->hydrant->name }}
                                                    </p>
                                                </td>
                                                <td style="width: 20%;">
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $row->order->customer->name }}
                                                    </p>
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ $row->order->customer->location }}
                                                    </p>
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ $row->order->customer->street }}
                                                    </p>
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ $row->order->customer->address }}
                                                    </p>
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ $row->order->customer->contact_num }}</p>
                                                </td>
                                                <td style="width: 10%;">
                                                    @if ($row->order->order_type != null)
                                                        <p class="text-center font-weight-bold mb-0">
                                                            {{ $row->order->order_type }}</p>
                                                    @else
                                                        <p class="text-center font-weight-bold mb-0">
                                                            {{ $row->order->customer->standard }}</p>
                                                    @endif
                                                </td>
                                                <td style="width: 15%;">
                                                    <div class="form-group">
                                                        <select class="form-control border border-dark border-1 p-2"
                                                            id="FormControlAdminSelect-{{ $row->id }}"
                                                            @if ($row->status == 3) disabled @endif
                                                            onchange="adminstatusbilling({{ $row->id }});">
                                                            <option selected disabled value=''> -- Select Status --
                                                            </option>
                                                            <option @if ($row->status == 1) selected @endif
                                                                value='1' class="bg-success">
                                                                Completed</option>
                                                            <option @if ($row->status == 2) selected @endif
                                                                value='2' class="bg-primary">
                                                                Dispatch</option>
                                                            <option
                                                                @if ($row->status == 0) selected @else disabled @endif
                                                                value='0' class="bg-warning">
                                                                Pending</option>
                                                            <option @if ($row->status == 3) selected @endif
                                                                value='3' class="bg-danger">
                                                                Cancelled</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center" style="width: 5%;">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $row->amount }}</span>
                                                </td>
                                                <td class="align-middle" style="width: 15%;">
                                                    <div>
                                                        <a href="{{ route('billing.details', $row->id) }}"
                                                            target="_blank"><span
                                                                class="badge badge-sm bg-gradient-primary">Generate
                                                                Reciept</span></a>
                                                    </div>
                                                    <div>
                                                        <a href="{{ route('billing.edit', $row->id) }}"
                                                            class="text-secondary font-weight-bold text-xs"
                                                            data-toggle="tooltip" data-original-title="Edit user">
                                                            Edit
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                @else
                                    No Record Find...
                                @endif
                            </tbody>
                        </table>
                    </form>

                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $billing->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reasonModal">
        Launch demo modal
      </button> --}}
    <div class="modal fade" id="reasonModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Canceled Reason</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <fieldset class="border rounded-3 p-3">
                        <legend class="float-none w-auto px-3">Reason</legend>
                        <textarea id="note" class="form-control"></textarea>

                    </fieldset>
                    <span class="text-danger d-none" id="alert-field">Please fill this field first then submit ...</span>
                    {{-- <textarea id="note" class="form-control border"></textarea> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="reason-submit" data-id="">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="bulk-reasonModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Canceled Reason</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <fieldset class="border rounded-3 p-3">
                        <legend class="float-none w-auto px-3">Reason</legend>
                        <textarea id="bulk-note" class="form-control"></textarea>

                    </fieldset>
                    <span class="text-danger d-none" id="alert-field">Please fill this field first then submit ...</span>
                    {{-- <textarea id="note" class="form-control border"></textarea> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="bulk-reason-submit" data-id="">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="alert-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are You sure you want to submit this action...</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-success" id="submit-alert" data-id="">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $("#bulk-change").change(function() {
            if ($(this).val() == 3) {
                var myModal = new bootstrap.Modal(document.getElementById('bulk-reasonModal'), {
                    keyboard: false
                });
                myModal.show();

            }
            else
            {
                var myModal = new bootstrap.Modal(document.getElementById('alert-Modal'), {
                    keyboard: false
                });
                myModal.show();

            }
        });
        $("#bulk-reason-submit").click(function() {
            $("#canc-reason").val($("#bulk-note").val());
            var myModal = new bootstrap.Modal(document.getElementById('alert-Modal'), {
                    keyboard: false
                });
                myModal.show();
        });
        $("#submit-alert").click(function(){
            $("#form-bulk-status").submit();
        });
        $("#reason-submit").click(function() {
            id = $(this).attr('data-id');
            var note = $("#note").val();
            if (note == null || note == '') {
                $("#alert-field").removeClass('d-none');
            } else {
                $("#alert-field").addClass('d-none');
                console.log(id);
                adminstatusbilling(id);
            }

        });
    </script>
@endsection
