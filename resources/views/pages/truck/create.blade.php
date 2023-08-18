@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="text-white text-capitalize ps-3">Add Water Tanker</h6>
                </div>
            </div>
          </div>
        </div>
        <div class="card-body px-4 pb-2">
            <h5>Give Water Tanker Informarion...</h5>
            <form role="form" method="POST" action="{{ route('truck.store') }}" enctype="multipart/form-data">
                @csrf
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
                <div class="card border-3 p-3 m-2">
                    <div class="row">
                        <h6 class="mt-3">Give Basic Water Tanker Informarion...</h6>
                        <div class="form-group col-6 p-3">
                                <label>Vehicle Owned By Contractor</label>
                            <select name="owned_by"
                                class="form-control border border-dark border-1 p-2" required>
                                    <option value="1">Contractor</option>
                                    <option value="0">Third Party</option>
                            </select>
                        </div>
                        <div class="form-group col-6 p-3">
                            <label>Vehicle Registration Number</label>
                            <input type="text" class="form-control border-bottom border-1 border-dark" placeholder="Enter Vehicle Number..." name="truck_num" value="{{ old('truck_num') }}" required/>

                        </div>
                        <div class="form-group col-6 p-3">
                            <label>Registration Region</label>
                            <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="reg_region" value="{{ old('reg_region') }}" required/>
                        </div>
                        <div class="form-group col-6 p-3">
                            <label>Book Number</label>
                            <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="book_num" value="{{ old('book_num') }}" required/>
                        </div>
                        <div class="form-group col-6">
                            <label>Vehicle Owner Name</label>
                            <input type="text" class="form-control border-bottom" placeholder="Enter Owner  Name..." name="name" value="{{ old('name') }}" required/>

                        </div>
                        <div class="form-group col-6 p-3">
                            <label>Father Name</label>
                            <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="father_name" value="{{ old('father_name') }}" required/>
                        </div>
                        <div class="form-group col-6 p-3">
                            <label>Owner Address</label>
                            <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="owner_address" value="{{ old('owner_address') }}" required/>
                        </div>
                        <div class="form-group col-6 p-3">
                            <label>Owner CNIC</label>
                            <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="owner_cnic" value="{{ old('owner_cnic') }}" required/>
                        </div>
                        <div class="form-group col-6 p-3">
                            <label>Registration Date</label>
                            <input type="date" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="reg_date" value="{{ old('reg_date') }}" required/>
                        </div>
                        <div class="form-group col-6 p-3">
                            <label>Class of Type</label>
                            <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="class_of_type" value="{{ old('class_of_type') }}" required/>
                        </div>
                    </div>
                </div>
                <div class="card border-3 p-3 m-2">
                    <div class="row">
                        <h6 class="mt-3">Give Basic Water Tanker Informarion...</h6>
                        <div class="form-group col-6 p-3">
                            <label>Body Type</label>
                            <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="body_type" value="{{ old('body_type') }}" required/>
                        </div>
                        <div class="form-group col-6 p-3">
                            <label>Chassis#</label>
                            <input type="text" class="form-control border-bottom border-1 border-dark" placeholder="Enter Vehicle Chassis Number..." name="chassis_num" value="{{ old('chassis_num') }}" required/>
                        </div>
                        <div class="form-group col-6 p-3">
                            <label>Engine#</label>
                            <input type="text" class="form-control border-bottom border-1 border-dark" placeholder="Enter Vehicle Engine Number..." name="engine_num" value="{{ old('engine_num') }}" required/>
                        </div>
                        <div class="form-group col-6">
                            <label>Vehicle Maker's Name</label>
                            <input type="text" class="form-control border-bottom" placeholder="Enter Vehicle Maker's Name..." name="company_name" value="{{ old('company_name') }}" required/>
                        </div>
                        <div class="form-group col-6 p-3">
                            <label>Vehicle Model</label>
                            <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Model..." name="model" value="{{ old('model') }}" required/>

                        </div>
                        <div class="form-group col-6 p-3">
                            <label>Number of Cylinders Count</label>
                            <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="cylinders_count" value="{{ old('cylinders_count') }}" required/>
                        </div>
                        <div class="form-group col-6 p-3">
                            <label>Horse Power</label>
                            <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="horse_power" value="{{ old('horse_power') }}" required/>
                        </div>
                        <div class="form-group col-6 p-3">
                            <label>Seating Capacity</label>
                            <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="seating_capacity" value="{{ old('seating_capacity') }}" required/>

                        </div>
                        <div class="form-group col-12 p-3">
                            <label>Water Tanker Capacity</label>
                            <select name="truck_type"
                                class="select2-multiple form-control fs-14  h-50px" required>
                                @foreach ($driver as $col)
                                    <option value="{{ $col->id }}">{{ $col->name }}</option>
                                    {{-- <option value="{{ $col->number }}">{{ $col->name }}</option> --}}
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6 p-3">
                            <label>Vehicle Cabin Color</label>
                            <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="cabin_color" value="{{ old('cabin_color') }}" required/>

                        </div>
                        <div class="form-group col-6 p-3">
                            <label>Vehicle Tank color</label>
                            <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="tanker_color" value="{{ old('tanker_color') }}" required/>

                        </div>
                    </div>
                </div>
                <div class="card border-3 p-3 m-2">
                    <div class="row">
                        <h6 class="mt-3">Numbers Description & Tyre Sizaestion ...</h6>
                        <div class="form-group col-6 p-3">
                            <label>Number, Description</label>
                            <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="num_description" value="{{ old('num_description') }}" required/>

                        </div>
                        <div class="form-group col-6 p-3">
                            <label>Front Excel</label>
                            <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="front_excel" value="{{ old('front_excel') }}" required/>

                        </div>
                        <div class="form-group col-6 p-3">
                            <label>Rear Excel</label>
                            <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="rear_excel" value="{{ old('rear_excel') }}" required/>

                        </div>
                        <div class="form-group col-6 p-3">
                            <label>Any Other</label>
                            <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="any_other" value="{{ old('any_other') }}" required/>

                        </div>
                    </div>
                </div>
                <div class="card border-3 p-3 m-2">
                    <div class="row">
                        <h6 class="mt-3">Fitness Certificate Details ...</h6>
                        <div class="form-group col-6 p-3">
                            <label>CFRA#</label>
                            <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="cfra_no" value="{{ old('cfra_no') }}" required/>
                        </div>
                        <div class="form-group col-6 p-3">
                            <label>Issue Date</label>
                            <input type="date" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="issue_date" value="{{ old('issue_date') }}" required/>
                        </div>
                        <div class="form-group col-12 p-3">
                            <label>Expiry Date</label>
                            <input type="date" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="expiry_date" value="{{ old('expiry_date') }}" required/>
                        </div>
                    </div>
                </div>
                <div class="card border-3 p-3 m-2">
                    <div class="row">
                        <h6 class="mt-3">All Attachments...</h6>
                        <div class="form-group form-file-upload form-file-simple col-6 p-3">
                            <label>Vehicle Document Copy</label>
                            <input type="file" class="form-control border-bottom inputFileHidden border-1 border-dark" name="paper_image" required>
                        </div>

                        <div class="form-group form-file-upload form-file-simple col-6 p-3">
                            <label>Vehicle Image</label>
                            <input type="file" class="form-control border-bottom inputFileHidden border-1 border-dark" name="vehicle_image" required>
                        </div>

                        <div class="form-group form-file-upload form-file-simple col-6 p-3">
                            <label>Vehicle Fitness Certificate</label>
                            <input type="file" class="form-control border-bottom inputFileHidden border-1 border-dark" name="vehicle_fitness" required>
                        </div>

                        <div class="form-group form-file-upload form-file-simple col-6 p-3">
                            <label>Commercial License Certificate</label>
                            <input type="file" class="form-control border-bottom inputFileHidden border-1 border-dark" name="commercial_license" required>
                        </div>

                        <div class="form-group form-file-upload form-file-simple col-6 p-3">
                            <label>Road Permit Document</label>
                            <input type="file" class="form-control border-bottom inputFileHidden border-1 border-dark" name="road_permit" required>
                        </div>

                        <div class="form-group form-file-upload form-file-simple col-6 p-3">
                            <label>Running paper Image</label>
                            <input type="file" class="form-control border-bottom inputFileHidden border-1 border-dark" name="doc_running_part" required>
                        </div>

                        <div class="form-group form-file-upload form-file-simple col-6 p-3">
                            <label>Cabin Picture</label>
                            <input type="file" class="form-control border-bottom inputFileHidden border-1 border-dark" name="cabin_picture" required>
                        </div>
                        <div class="form-group form-file-upload form-file-simple col-6 p-3">
                            <div class="text-center">
                                <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Create</button>
                            </div>
                        </div>

                    </div>
                </div>

                    {{-- Addition Start --}}












                    {{-- Addition End --}}






                    {{-- Addtion --}}
                    {{-- Addtion --}}





            </form>
        </div>
    </div>
  </div>
</div>


@endsection
