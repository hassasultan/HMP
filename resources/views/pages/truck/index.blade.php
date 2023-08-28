@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="text-white text-capitalize ps-3">Water Tanker List</h6>
                </div>
                @if (auth()->user()->role == 1)
                    <div class="col-6 text-end">
                        <a class="btn bg-gradient-dark mb-0 mr-3" href="{{ route('truck.create') }}"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;<i class="fa fa-truck"></i></a>
                    </div>
                @endif
            </div>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="p-0">
            <table id="example1" class="table table-bordered align-items-center mb-0">
              <thead>
                <tr>
                  <!--<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Vehicle</th>-->
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Model/Number </th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Water Tanker Document Copy</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hydrant</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Owned By</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Expiry</th>
                  <th class="text-secondary opacity-7">Active</th>
                  <th class="text-secondary opacity-7">Form View</th>
                  <th class="text-secondary opacity-7">Action</th>
                </tr>
              </thead>
              <tbody>
                @if(count($truck) > 0)
                    @foreach ($truck as $key => $row)
                        <tr>
                            {{--<td>
                                <div class="d-flex px-2 py-1">
                                <div>
                                    <img src="{{ asset('storage/'.$row->image) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">{{ $row->name }}</h6>
                                    <p class="text-xs text-secondary mb-0">{{ $row->company_name }}</p>
                                </div>
                                </div>
                            </td>--}}
                            <td>
                                <p class="text-xs font-weight-bold mb-0">{{ $row->truck_num }}</p>
                                <p class="text-xs text-secondary mb-0">{{ $row->model }}</p>
                                @if($row->vehicle_image != NULL)
                                <div class="d-flex px-2 py-1">
                                    <div>
                                        <img src="{{ asset('public/storage/'.$row->vehicle_image) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                    </div>
                                </div>
                                @endif
                            </td>
                            <td class="align-middle text-center text-sm">
                                 <div class="align-middle text-center d-flex px-2 py-1">
                                    <div class="align-middle text-center">
                                        <img src="{{ asset('public/storage/'.$row->paper_image) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                    </div>
                                </div>
                                {{-- @if ($row->status == 1)
                                    <span class="badge badge-sm bg-gradient-success">Active</span>
                                @else
                                    <span class="badge badge-sm bg-gradient-danger">De-Active</span>
                                @endif --}}
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">{{ $row->hydrant->name }}</p>
                                <p class="text-xs text-secondary mb-0">{{ $row->hydrant->contact }}</p>
                                <p class=" mt-2">
                                    <span class="p-2" style="background-color: {{ $row->hydrant->color }};"></span>
                                </p>
                                {{-- <div class="d-flex px-2 py-1">
                                    <div>
                                        <img src="{{ asset('storage/'.$row->nic_image) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                    </div>
                                </div> --}}
                            </td>
                            <td>
                                @if ($row->owned_by == 1)
                                    <p class="text-center font-weight-bold mb-0">Contractor</p>
                                @else
                                    <p class="text-center font-weight-bold mb-0">Third Party</p>
                                @endif
                            </td>
                            <td class="align-middle text-center">
                                <a href="{{ route('generate.qr',$row->id) }}"><span class="badge badge-sm bg-gradient-primary">Generate QrCode</span></a>
                                <!--<span class="text-secondary text-xs font-weight-bold">{{ $row->expiry }}</span>-->
                            </td>
                            <td>
                                <div class="form-group">
                                    <select class="form-control border border-dark border-1 p-2"
                                        id="FormControlAdminSelect-{{ $row->id }}"
                                        onchange="adminstatus({{ $row->id }});">
                                        <option @if ($row->black_list == 1) selected @endif value='1'>
                                            Yes</option>
                                        <option @if ($row->black_list == 0) selected @endif value='0'>
                                            No</option>
                                    </select>
                                </div>
                            </td>
                            <td class="align-middle">
                                <a href="{{route('vehicle.details',$row->id)}}" class="text-secondary m-2 font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Info Vehicle" target="_blank">
                                    Form View
                                <!--<i class="fa fa-info-circle" aria-hidden="true"></i>-->
                                </a>
                            </td>
                            <td class="align-middle">
                                <a href="{{ route('truck.edit',$row->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
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
