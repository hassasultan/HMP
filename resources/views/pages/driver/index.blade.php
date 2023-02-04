@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="text-white text-capitalize ps-3">Drivers List</h6>
                </div>
                <div class="col-6 text-end">
                    <a class="btn bg-gradient-dark mb-0 mr-3" href="{{ route('driver.create') }}"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;<i class="fa fa-user"></i></a>
                </div>
            </div>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class=" p-0">
            <table id="example1" class="table table-bordered align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Driver</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NIC</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Water Tanker</th>
                  {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th> --}}
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Expiry</th>
                  <th class="text-secondary opacity-7">Active</th>

                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                @if(count($driver) > 0)
                    @foreach ($driver as $key => $row)
                        <tr>
                            <td>
                                <div class="d-flex px-2 py-1">
                                <div>
                                    <img src="{{ asset('public/storage/'.$row->image) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">{{ $row->name }}</h6>
                                    <p class="text-xs text-secondary mb-0">{{ $row->phone }}</p>
                                </div>
                                </div>
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">{{ $row->nic }}</p>
                                <div class="d-flex px-2 py-1">
                                    <div>
                                        <img src="{{ asset('public/storage/'.$row->nic_image) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="{{route('vehicle.details',$row->truck->id)}}" target="_blank">
                                    <p class="text-xs font-weight-bold mb-0">{{ $row->truck->truck_num }}</p>
                                    <p class=" mt-2">
                                        <span class="p-2" style="background-color: {{ $row->truck->hydrant->color }};"></span>
                                    </p>
                                </a>
                            </td>
                            {{-- <td class="align-middle text-center text-sm">
                                <div class="form-group">
                                    <select class="form-control border border-dark border-1 p-2"
                                        id="FormControlDriverSelect-{{ $row->id }}"
                                        onchange="driverActivatedStatus({{ $row->id }});">
                                        <option @if ($row->status == 1) selected @endif value='1'>
                                            In-Active</option>
                                        <option @if ($row->status == 0) selected @endif value='0'>
                                            De-Active</option>
                                    </select>
                                </div>

                            </td> --}}
                            <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold">{{ $row->expiry }}</span>
                            </td>
                            <td>
                                <div class="form-group">
                                    <select class="form-control border border-dark border-1 p-2"
                                        id="FormControlAdminSelect-{{ $row->id }}"
                                        onchange="adminstatusdriver({{ $row->id }});">
                                        <option @if ($row->black_list == 1) selected @endif value='1'>
                                            Yes</option>
                                        <option @if ($row->black_list == 0) selected @endif value='0'>
                                            No</option>
                                    </select>
                                </div>
                            </td>

                            <td class="align-middle">

                                {{-- {!! \QrCode::size(250)->generate('www.google.com'); !!} --}}
                                <a href="{{ route('driver.edit',$row->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
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
