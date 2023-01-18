@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="text-white text-capitalize ps-3">Edit Hydrant</h6>
                </div>
            </div>
          </div>
        </div>
        <div class="card-body px-4 pb-2">
            <h5>Give Hydrant Informarion...</h5>
            <form role="form" method="POST" action="{{ route('hydrant.update',$hyd->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="row">


                    <div class="form-group col-6">
                        <label>Name</label>
                        <input type="text" class="form-control border-bottom" placeholder="Enter Hydrant Name..." name="name" value="{{ old('name',$hyd->name) }}" required/>

                    </div>
                    <div class="form-group col-6">
                        <label>Contractor Name</label>
                        <input type="tel" class="form-control border-bottom" placeholder="Enter Contractor Name..." name="contractor_name" value="{{ old('contractor_name',$hyd->contractor_name) }}" required/>
                    </div>
                    <div class="form-group col-6">
                        <label>Person Name</label>
                        <input type="text" class="form-control border-bottom" placeholder="Enter Person Name..." name="person" value="{{ old('person',$hyd->person) }}" required/>
                    </div>
                    <div class="form-group col-6">
                        <label>Phone Number</label>
                        <input type="tel" class="form-control border-bottom" placeholder="Enter  Phone Number..." name="contact" value="{{ old('contact',$hyd->contact) }}" required/>
                    </div>
                    {{--<div class="form-group col-6">
                            <label>Vehicle Owned</label>
                        <select name="owned"
                            class="form-control" required>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                        </select>
                    </div>--}}
                    <div class="form-group col-6">
                        <label>Color</label>
                        <input type="color" class="form-control border-bottom"  name="color" value="{{ old('color',$hyd->color) }}" required/>
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
