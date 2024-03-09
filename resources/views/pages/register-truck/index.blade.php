@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="text-white text-capitalize ps-3">Registered Truck List</h6>
                            </div>
                            <div class="col-6 text-end">
                                <a class="btn bg-gradient-dark mb-0 mr-3" href="{{ route('register-truck.create') }}"><i
                                        class="material-icons text-sm">add</i>&nbsp;&nbsp;<i class="fa fa-truck"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="p-0">
                        <table id="example1" class="table table-bordered align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Truck
                                        Details</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Status</th>
                                    <!--<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Owned</th>-->
                                    <!--<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Expiry</th>-->
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($regTrucks) > 0)
                                    @foreach ($regTrucks as $key => $row)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    {{-- <div>
                                    <img src="{{ asset('storage/'.$row->image) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                </div> --}}
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $row->truck->name }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $row->truck->truck_num }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($row->status == 1)
                                                    <span class="badge badge-sm bg-success">Active</p>
                                                    @else
                                                        <span class="badge badge-sm bg-danger">DeActive</p>
                                                @endif
                                            </td>
                                            {{-- <td>
                                @if ($row->owned == 1)
                                <p class="text-xs font-weight-bold mb-0">Self Owned</p>
                                @else
                                <p class="text-xs font-weight-bold mb-0">Owned By COntractors</p>
                                @endif
                            </td> --}}

                                            <td class="align-middle text-center">
                                                {{-- <span class="text-secondary text-xs font-weight-bold">{{ $row->expiry }}</span> --}}
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('reg.truck.del', $row->id) }}"
                                                    class="text-danger font-weight-bold text-xs" data-toggle="tooltip"
                                                    data-original-title="Delete user">
                                                    <span class="fas fa-trash"></span>
                                                    {{-- delete --}}
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
