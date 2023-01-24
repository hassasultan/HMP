@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="text-white text-capitalize ps-3">Edit Customer</h6>
                </div>
            </div>
          </div>
        </div>
        <div class="card-body px-4 pb-2">
            <h5>Update Customer Informarion...</h5>
            <form role="form" method="POST" action="{{ route('customer-management.update',$customer->id) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">

                    <div class="form-group col-12">
                        <label>Customer Name</label>
                        <input type="text" class="form-control border-bottom" placeholder="Enter Customer Name..." name="name" value="{{ old('name',$customer->name) }}" required/>

                    </div>
                    <div class="form-group col-12">
                        <label>Customer Phone</label>
                        <input type="tel" class="form-control border-bottom" placeholder="Enter driver Phone Number..." name="contact_num" value="{{ old('contact_num' ,$customer->contact_num) }}" required/>
                    </div>
                    <div class="form-group col-12">
                        <label>Area</label>
                        <input type="text" class="form-control border-bottom" placeholder="Enter Area..." name="address" value="{{ old('address',$customer->address) }}" required/>

                    </div>
                    <div class="form-group col-12">
                        <label>Street</label>
                        <input type="text" class="form-control border-bottom" placeholder="Enter Street..." name="street" value="{{ old('street',$customer->street) }}" required/>

                    </div>
                    <div class="form-group col-12">
                        <label>Location</label>
                        <input type="text" class="form-control border-bottom" placeholder="Enter Location Name..." name="location" value="{{ old('location',$customer->location) }}" required/>

                    </div>
                    <div class="form-group col-12">
                       <label>Gps</label>
                        <input type="text" class="form-control border-bottom" placeholder="Enter Gps (lat,lng)..." name="gps" value="{{ old('gps',$customer->gps) }}" required/>

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
