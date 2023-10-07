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
                <div class="col-6 text-end">
                    <a class="btn bg-gradient-dark mb-0 mr-3" href="{{ route('billing.create') }}"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;<i class="fa fa-truck"></i></a>
                </div>
            </div>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class=" p-0">
            <table id="example1" class="table table-bordered table-responsive align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Order</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Vehicle </th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Driver</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hydrants</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Customer Details</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Customer Standard</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">amount</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                @if(count($billing) > 0)
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
                                <p class="text-xs font-weight-bold mb-0">{{ $row->truck->name }}({{ $row->truck->company_name }})</p>
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
                                <p class="text-xs font-weight-bold mb-0">{{ $row->order->hydrant->name }}</p>
                                {{-- <p class="text-xs text-secondary mb-0">{{ $row->driver->nic }}</p> --}}
                                {{-- <div class="d-flex px-2 py-1">
                                    <div>
                                        <img src="{{ asset('storage/'.$row->nic_image) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                    </div>
                                </div> --}}
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">{{ $row->order->customer->name }}</p>
                                <p class="text-xs text-secondary mb-0">{{ $row->order->customer->location }}</p>
                                <p class="text-xs text-secondary mb-0">{{ $row->order->customer->street }}</p>
                                <p class="text-xs text-secondary mb-0">{{ $row->order->customer->address }}</p>
                                <p class="text-xs text-secondary mb-0">{{ $row->order->customer->contact_num }}</p>
                                {{-- <div class="d-flex px-2 py-1">
                                    <div>
                                        <img src="{{ asset('storage/'.$row->nic_image) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                    </div>
                                </div> --}}
                            </td>
                            <td>
                                <p class="text-center font-weight-bold mb-0">{{ $row->order->customer->standard }}</p>
                            </td>
                            <td>
                                <div class="form-group">
                                    <select class="form-control border border-dark border-1 p-2"
                                        id="FormControlAdminSelect-{{ $row->id }}"
                                        onchange="adminstatusbilling({{ $row->id }});">
                                        <option @if ($row->status == 1) selected @endif value='1'  class="bg-success">
                                            Completed</option>
                                        <option @if ($row->status == 2) selected @endif value='2' class="bg-danger">
                                            Dispatch</option>
                                        <option @if ($row->status == 0) selected @endif value='0' class="bg-danger">
                                            Pending</option>
                                    </select>
                                </div>
                            </td>
                            <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold">{{ $row->amount }}</span>
                            </td>
                            <td class="align-middle">
                                <div>
                                    <a href="{{ route('billing.details',$row->id) }}" target="_blank"><span class="badge badge-sm bg-gradient-primary">Generate Reciept</span></a>
                                </div>
                                <div>
                                    <a href="{{ route('billing.edit',$row->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
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

@endsection
