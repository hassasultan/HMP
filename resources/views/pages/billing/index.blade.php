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
            <table id="example1" class="table table-bordered align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Order</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Vehicle </th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Driver</th>
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
                                <p class="text-xs font-weight-bold mb-0">{{ $row->truck->name }}</p>
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
                            <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold">{{ $row->amount }}</span>
                            </td>
                            <td class="align-middle">
                                <a href="{{ route('billing.details',$row->id) }}"><span class="badge badge-sm bg-gradient-primary">Generate Reciept</span></a>
                                <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                Edit
                                </a>
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
