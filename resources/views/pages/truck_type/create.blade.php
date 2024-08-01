@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="text-white text-capitalize ps-3">Add Vehicle Type</h6>
                </div>
            </div>
          </div>
        </div>
        <div class="card-body px-4 pb-2">
            <h5>Give Vehicle Type Informarion...</h5>
            <form role="form" method="POST" action="{{ route('truck_type.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="form-group col-12">
                        <label>Name</label>
                        <input type="text" class="form-control border-bottom" placeholder="Enter Truck Name..." name="name" value="{{ old('name') }}" required/>

                    </div>
                    <div class="form-group col-12">
                        <label>Price</label>
                        <input type="number" class="form-control border-bottom" placeholder="Enter Truck Name..." name="price" value="{{ old('price') }}" required/>

                    </div>
                    <div class="form-group col-12">
                        <label>Per KM Price</label>
                        <input type="number" class="form-control border-bottom" placeholder="Enter Truck Name..." name="km_price" value="{{ old('km_price') }}" required/>

                    </div>
                    <div class="form-group col-12">
                        <label>Description</label>
                        <textarea class="form-control border-bottom" placeholder="Enter Description Here..." name="description" required>{{ old('description') }}</textarea>
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
