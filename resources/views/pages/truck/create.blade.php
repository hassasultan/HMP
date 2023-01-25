@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="text-white text-capitalize ps-3">Add Vehicle</h6>
                </div>
            </div>
          </div>
        </div>
        <div class="card-body px-4 pb-2">
            <h5>Give Vehicle Informarion...</h5>
            <form role="form" method="POST" action="{{ route('truck.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-12 p-3">
                            <label>Vehicle Owned By Contractor</label>
                        <select name="owned_by"
                            class="form-control border border-dark border-1 p-2" required>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                        </select>
                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Vehicle Registration Number</label>
                        <input type="text" class="form-control border-bottom border-1 border-dark" placeholder="Enter Vehicle Number..." name="truck_num" value="{{ old('truck_num') }}" required/>

                    </div>
                    <div class="form-group col-12">
                        <label>Vehicle Owner Name</label>
                        <input type="text" class="form-control border-bottom" placeholder="Enter Owner  Name..." name="name" value="{{ old('name') }}" required/>

                    </div>

                    <div class="form-group col-12">
                        <label>Vehicle Maker's Name</label>
                        <input type="text" class="form-control border-bottom" placeholder="Enter Vehicle Maker's Name..." name="company_name" value="{{ old('company_name') }}" required/>
                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Vehicle Model</label>
                        <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Model..." name="model" value="{{ old('model') }}" required/>

                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Vehicle Cabin Color</label>
                        <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="cabin_color" value="{{ old('cabin_color') }}" required/>

                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Vehicle Tank color</label>
                        <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="tanker_color" value="{{ old('tanker_color') }}" required/>

                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Chassis#</label>
                        <input type="text" class="form-control border-bottom border-1 border-dark" placeholder="Enter Vehicle Chassis Number..." name="chassis_num" value="{{ old('chassis_num') }}" required/>

                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Engine#</label>
                        <input type="text" class="form-control border-bottom border-1 border-dark" placeholder="Enter Vehicle Engine Number..." name="engine_num" value="{{ old('engine_num') }}" required/>

                    </div>

                    <div class="form-group col-12 p-3">
                            <label>Vehicle/Tanker Capacity</label>
                        <select name="truck_type"
                            class="select2-multiple form-control fs-14  h-50px" required>
                            @foreach ($driver as $col)
                                <option value="{{ $col->id }}">{{ $col->name }}</option>
                                {{-- <option value="{{ $col->number }}">{{ $col->name }}</option> --}}
                            @endforeach
                        </select>
                    </div>
                    @if (auth()->user()->role == 1)
                        <div class="form-group col-12 p-3">
                                <label>Hydrants</label>
                            <select name="hydrant_id"
                                class="select2-multiple form-control fs-14  h-50px" required>
                                @foreach ($hydrant as $col)
                                    <option value="{{ $col->id }}">{{ $col->name }}</option>
                                    {{-- <option value="{{ $col->number }}">{{ $col->name }}</option> --}}
                                @endforeach
                            </select>
                        </div>
                    @endif



                    <div class="form-group form-file-upload form-file-simple col-12 p-3">
                        <label>Vehicle Document Copy</label>
                        <input type="file" class="form-control border-bottom inputFileHidden border-1 border-dark" name="paper_image" required>
                    </div>

                    <div class="form-group form-file-upload form-file-simple col-12 p-3">
                        <label>Vehicle Image</label>
                        <input type="file" class="form-control border-bottom inputFileHidden border-1 border-dark" name="vehicle_image" required>
                    </div>

                    <div class="form-group form-file-upload form-file-simple col-12 p-3">
                        <label>Vehicle Fitness Certificate</label>
                        <input type="file" class="form-control border-bottom inputFileHidden border-1 border-dark" name="vehicle_fitness" required>
                    </div>



                    <div class="text-center">
                        <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-20 mt-4 mb-0">Create</button>
                      </div>
                  </div>

            </form>
        </div>
    </div>
  </div>
</div>


@endsection
