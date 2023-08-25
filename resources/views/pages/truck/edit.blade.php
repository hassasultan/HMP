@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="text-white text-capitalize ps-3">Update Vehicle</h6>
                </div>
            </div>
          </div>
        </div>
        <div class="card-body px-4 pb-2">
            <h5>Give Vehicle Informarion...</h5>
            <form role="form" method="POST" action="{{ route('truck.update',$truck->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-12 p-3">
                            <label>Vehicle Owned By Contractor</label>
                        <select name="owned_by"
                            class="form-control border border-dark border-1 p-2" required>
                                <option value="1" @if($truck->owned_by == 1) selected @endif>Yes</option>
                                <option value="0" @if($truck->owned_by == 0) selected @endif>No</option>
                        </select>
                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Vehicle Registration Number</label>
                        <input type="text" class="form-control border-bottom border-1 border-dark" placeholder="Enter Vehicle Number..." name="truck_num" value="{{ old('name', $truck->truck_num) }}" required/>

                    </div>
                    <div class="form-group col-12">
                        <label>Vehicle Owner Name</label>
                        <input type="text" class="form-control border-bottom" placeholder="Enter Owner  Name..." name="name" value="{{ old('name', $truck->name) }}" required/>

                    </div>
                    <div class="form-group col-12">
                        <label>Vehicle Maker's Name</label>
                        <input type="text" class="form-control border-bottom" placeholder="Enter Vehicle Maker's Name..." name="company_name" value="{{ old('company_name' , $truck->company_name) }}" required/>
                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Chassis#</label>
                        <input type="text" class="form-control border-bottom border-1 border-dark" placeholder="Enter Vehicle Chassis Number..." name="chassis_num" value="{{ $truck->chassis_num }}" required/>

                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Engine#</label>
                        <input type="text" class="form-control border-bottom border-1 border-dark" placeholder="Enter Vehicle Engine Number..." name="engine_num" value="{{ $truck->engine_num }}" required/>

                    </div>
                    {{-- Addition Start --}}
                    <div class="form-group col-12 p-3">
                        <label>Registration Region</label>
                        <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="reg_region" value="{{ old('reg_region', $truck->reg_region) }}" required/>

                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Book Number</label>
                        <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="book_num" value="{{ old('book_num', $truck->book_num) }}" required/>

                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Father Name</label>
                        <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="father_name" value="{{ old('father_name', $truck->father_name) }}" required/>

                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Owner Address</label>
                        <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="owner_address" value="{{ old('owner_address', $truck->owner_address) }}" required/>

                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Owner CNIC</label>
                        <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="owner_cnic" value="{{ old('owner_cnic', $truck->owner_cnic) }}" required/>

                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Registration Date</label>
                        <input type="date" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="reg_date" value="{{ old('reg_date', $truck->reg_date) }}" required/>

                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Class of Type</label>
                        <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="class_of_type" value="{{ old('class_of_type', $truck->class_of_type) }}" required/>

                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Number of Cylinders Count</label>
                        <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="cylinders_count" value="{{ old('cylinders_count', $truck->cylinders_count) }}" required/>

                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Body Type</label>
                        <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="body_type" value="{{ old('body_type', $truck->body_type) }}" required/>

                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Horse Power</label>
                        <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="horse_power" value="{{ old('horse_power', $truck->horse_power) }}" required/>

                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Seating Capacity</label>
                        <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="seating_capacity" value="{{ old('seating_capacity', $truck->seating_capacity) }}" required/>

                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Number, Description</label>
                        <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="num_description" value="{{ old('num_description', $truck->num_description) }}" required/>

                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Front Excel</label>
                        <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="front_excel" value="{{ old('front_excel', $truck->front_excel) }}" required/>

                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Rear Excel</label>
                        <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="rear_excel" value="{{ old('rear_excel', $truck->rear_excel) }}" required/>

                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Any Other</label>
                        <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="any_other" value="{{ old('any_other', $truck->any_other) }}" required/>

                    </div>
                    <div class="form-group col-12 p-3">
                        <label>CFRA#</label>
                        <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="cfra_no" value="{{ old('cfra_no', $truck->cfra_no) }}" required/>

                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Issue Date</label>
                        <input type="date" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="issue_date" value="{{ old('issue_date', $truck->issue_date) }}" required/>

                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Expiry Date</label>
                        <input type="date" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="expiry_date" value="{{ old('expiry_date', $truck->expiry_date) }}" required/>

                    </div>

                    {{-- Addition End --}}
                    <div class="form-group col-12 p-3">
                        <label>Vehicle Model</label>
                        <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Model..." name="model" value="{{ $truck->model }}" required/>

                    </div>
                     <div class="form-group col-12 p-3">
                        <label>Vehicle Cabin Color</label>
                        <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="cabin_color" value="{{ $truck->cabin_color }}" required/>

                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Vehicle Tank color</label>
                        <input type="text" class="form-control border-bottom border-dark" placeholder="Enter Vehicle Cabin Color..." name="tanker_color" value="{{ $truck->tanker_color }}" required/>

                    </div>

                    <div class="form-group col-12 p-3">
                            <label>Vehicle/Tanker Capacity</label>
                        <select name="truck_type"
                            class="select2-multiple form-control fs-14  h-50px" required>
                            @foreach ($driver as $col)
                                <option value="{{ $col->id }}" @if($truck->truck_type == $col->id) selected @endif>{{ $col->name }}</option>
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
                                    <option value="{{ $col->id }}" @if($truck->hydrant_id == $col->id) selected @endif>{{ $col->name }}</option>
                                    {{-- <option value="{{ $col->number }}">{{ $col->name }}</option> --}}
                                @endforeach
                            </select>
                        </div>
                    @endif



                    <div class="form-group form-file-upload form-file-simple col-12 p-3">
                        <label>Vehicle Document Copy</label>
                        <input type="file" class="form-control border-bottom inputFileHidden border-1 border-dark" name="paper_image" >
                        <img src="{{ asset('public/storage/'.$truck->paper_image) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                    </div>

                    <div class="form-group form-file-upload form-file-simple col-12 p-3">
                        <label>Vehicle Image</label>
                        <input type="file" class="form-control border-bottom inputFileHidden border-1 border-dark" name="vehicle_image">
                        <img src="{{ asset('public/storage/'.$truck->vehicle_image) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                    </div>

                    <div class="form-group form-file-upload form-file-simple col-12 p-3">
                        <label>Vehicle Fitness Certificate</label>
                        <input type="file" class="form-control border-bottom inputFileHidden border-1 border-dark" name="vehicle_fitness" >
                        <img src="{{ asset('public/storage/'.$truck->vehicle_fitness) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                    </div>

                    {{-- Addtion --}}
                    <div class="form-group form-file-upload form-file-simple col-12 p-3">
                        <label>Commercial License Certificate</label>
                        <input type="file" class="form-control border-bottom inputFileHidden border-1 border-dark" name="commercial_license" >
                        <img src="{{ asset('public/storage/'.$truck->commercial_license) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">

                    </div>

                    <div class="form-group form-file-upload form-file-simple col-12 p-3">
                        <label>Road Permit Document</label>
                        <input type="file" class="form-control border-bottom inputFileHidden border-1 border-dark" name="road_permit" >
                        <img src="{{ asset('public/storage/'.$truck->road_permit) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">

                    </div>

                    <div class="form-group form-file-upload form-file-simple col-12 p-3">
                        <label>Running paper Image</label>
                        <input type="file" class="form-control border-bottom inputFileHidden border-1 border-dark" name="doc_running_part" >
                        <img src="{{ asset('public/storage/'.$truck->doc_running_part) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">

                    </div>

                    <div class="form-group form-file-upload form-file-simple col-12 p-3">
                        <label>Cabin Picture</label>
                        <input type="file" class="form-control border-bottom inputFileHidden border-1 border-dark" name="cabin_picture" >
                        <img src="{{ asset('public/storage/'.$truck->cabin_picture) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">

                    </div>
                    {{-- Addtion --}}

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
