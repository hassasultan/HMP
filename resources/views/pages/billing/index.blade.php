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
                </div>
                <div class="card-body px-0 pb-2">
                    <div class=" p-0">
                        <table id="example1" class="table table-bordered table-responsive align-items-center mb-0">
                            <thead>
                                <tr>
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
                                                <div class="d-flex px-2 py-1">
                                                    {{-- <div>
                                    <img src="{{ asset('storage/'.$row->image) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                </div> --}}
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $row->order->Order_Number }}</h6>
                                                        {{-- <p class="text-xs text-secondary mb-0">{{ $row->company_name }}</p> --}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $row->truck->name }}({{ $row->truck->company_name }})</p>
                                                <p class="text-xs text-secondary mb-0">{{ $row->truck->truck_num }}</p>
                                                <p class="text-xs text-secondary mb-0">{{ $row->truck->truckCap->name }}</p>
                                                {{-- <div class="d-flex px-2 py-1">
                                    <div>
                                        <img src="{{ asset('storage/'.$row->nic_image) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                    </div>
                                </div> --}}
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $row->driver->name }}</p>
                                                <p class="text-xs text-secondary mb-0">{{ $row->driver->nic }}</p>
                                                {{-- <div class="d-flex px-2 py-1">
                                    <div>
                                        <img src="{{ asset('storage/'.$row->nic_image) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                    </div>
                                </div> --}}
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $row->order->hydrant->name }}
                                                </p>
                                                {{-- <p class="text-xs text-secondary mb-0">{{ $row->driver->nic }}</p> --}}
                                                {{-- <div class="d-flex px-2 py-1">
                                    <div>
                                        <img src="{{ asset('storage/'.$row->nic_image) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                    </div>
                                </div> --}}
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $row->order->customer->name }}
                                                </p>
                                                <p class="text-xs text-secondary mb-0">{{ $row->order->customer->location }}
                                                </p>
                                                <p class="text-xs text-secondary mb-0">{{ $row->order->customer->street }}
                                                </p>
                                                <p class="text-xs text-secondary mb-0">{{ $row->order->customer->address }}
                                                </p>
                                                <p class="text-xs text-secondary mb-0">
                                                    {{ $row->order->customer->contact_num }}</p>
                                                {{-- <div class="d-flex px-2 py-1">
                                    <div>
                                        <img src="{{ asset('storage/'.$row->nic_image) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                    </div>
                                </div> --}}
                                            </td>
                                            <td>
                                                @if ($row->order->order_type != null)
                                                    <p class="text-center font-weight-bold mb-0">
                                                        {{ $row->order->order_type }}</p>
                                                @else
                                                    <p class="text-center font-weight-bold mb-0">
                                                        {{ $row->order->customer->standard }}</p>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control border border-dark border-1 p-2"
                                                        id="FormControlAdminSelect-{{ $row->id }}"
                                                        onchange="adminstatusbilling({{ $row->id }});">
                                                        <option @if ($row->status == 1) selected @endif
                                                            value='1' class="bg-success">
                                                            Completed</option>
                                                        <option @if ($row->status == 2) selected @endif
                                                            value='2' class="bg-primary">
                                                            Dispatch</option>
                                                        <option @if ($row->status == 0) selected @else disabled @endif
                                                            value='0' class="bg-warning">
                                                            Pending</option>
                                                        <option @if ($row->status == 3) selected @endif
                                                            value='3' class="bg-danger">
                                                            Cancelled</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $row->amount }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <div>
                                                    <a href="{{ route('billing.details', $row->id) }}" target="_blank"><span
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
                    <legend class="float-none w-auto px-3" >Reason</legend>
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

      <script>
        $("#reason-submit").click(function()
        {
            id = $(this).attr('data-id');
            var note = $("#note").val();
            if(note == null || note == '')
            {
                $("#alert-field").removeClass('d-none');
            }
            else
            {
                $("#alert-field").addClass('d-none');
                console.log(id);
                adminstatusbilling(id);
            }

        });
      </script>
@endsection
