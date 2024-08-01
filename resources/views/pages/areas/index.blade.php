@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="text-white text-capitalize ps-3">Areas List</h6>
                </div>
                <div class="col-6 text-end">
                    <a class="btn bg-gradient-dark mb-0 mr-3" href="{{ route('areas.create') }}"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add Area</a>
                </div>
            </div>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="p-0">
            <table id="example1" class="table table-bordered align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hydrant</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Block</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Sector</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total KM</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Extra KM</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                @if(count($areas) > 0)
                    @foreach ($areas as $area)
                        <tr>
                            <td>
                                <div class="d-flex px-2 py-1">
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{ $area->hydrant->name }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">{{ $area->name }}</p>
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">{{ $area->block }}</p>
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">{{ $area->sector }}</p>
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">{{ $area->total_km }}</p>
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">{{ $area->extra_km }}</p>
                            </td>
                            <td class="align-middle">
                                <a href="{{ route('areas.edit',$area->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit Area">
                                Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr><td colspan="5">No records found...</td></tr>
                @endif
              </tbody>
            </table>
            {{ $areas->links() }}
          </div>
        </div>
      </div>
    </div>
</div>

@endsection
