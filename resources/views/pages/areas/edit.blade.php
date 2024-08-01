@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="text-white text-capitalize ps-3">Edit Area</h6>
                </div>
            </div>
          </div>
        </div>
        <div class="card-body px-4 pb-2">
            <h5>Update Area Information...</h5>
            <form role="form" method="POST" action="{{ route('areas.update', $area->id) }}">
                @csrf
                @method('PUT')
                <div class="row">

                    <div class="form-group col-12">
                        <label>Hydrant</label>
                        <select name="hydrant_id" class="form-control border-bottom" required>
                            <option value="">Select Hydrant</option>
                            @foreach($hydrants as $hydrant)
                                <option value="{{ $hydrant->id }}" @if($hydrant->id == $area->hydrant_id) selected @endif>{{ $hydrant->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label>Name</label>
                        <input type="text" class="form-control border-bottom" placeholder="Enter Area Name..." name="name" value="{{ old('name', $area->name) }}" required/>
                    </div>
                    <div class="form-group col-12">
                        <label>Block</label>
                        <input type="text" class="form-control border-bottom" placeholder="Enter Area Block..." name="block" value="{{ old('block', $area->block) }}" />
                    </div>
                    <div class="form-group col-12">
                        <label>Sector</label>
                        <input type="text" class="form-control border-bottom" placeholder="Enter Area Sector..." name="sector" value="{{ old('sector', $area->sector) }}" />
                    </div>
                    <div class="form-group col-12">
                        <label>Total KM</label>
                        <input type="number" step="0.01" class="form-control border-bottom" placeholder="Enter Total KM..." name="total_km" value="{{ old('total_km', $area->total_km) }}" required/>
                    </div>
                    <div class="form-group col-12">
                        <label>Extra KM</label>
                        <input type="number" step="0.01" class="form-control border-bottom" placeholder="Enter Extra KM..." name="extra_km" value="{{ old('extra_km', $area->extra_km) }}" required/>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-20 mt-4 mb-0">Update</button>
                    </div>
                  </div>
            </form>
        </div>
    </div>
  </div>
</div>

@endsection
