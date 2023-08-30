@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="text-white text-capitalize ps-3">Add Customer</h6>
                </div>
            </div>
          </div>
        </div>
        <div class="card-body px-4 pb-2">
            <h5>Give Customer Informarion...</h5>
            <form role="form" method="POST" action="{{ route('customer-management.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="form-group col-12">
                        <label>Customer Name</label>
                        <input type="text" class="form-control border-bottom" placeholder="Enter Customer Name..." name="name" value="{{ old('name') }}" required/>

                    </div>
                    <div class="form-group col-12">
                        <label>Customer Phone</label>
                        <input type="tel" class="form-control border-bottom" placeholder="Enter driver Phone Number..." name="contact_num" value="{{ old('contact_num') }}" required/>
                    </div>
                    <div class="form-group col-12">
                        <label>Area</label>
                        <input type="text" class="form-control border-bottom" placeholder="Enter Area..." name="address" value="{{ old('address') }}" required/>

                    </div>
                    <div class="form-group col-12">
                        <label>Street</label>
                        <input type="text" class="form-control border-bottom" placeholder="Enter Street..." name="street" value="{{ old('street') }}" required/>

                    </div>
                    <div class="form-group col-12">
                        <label>Location</label>
                        <input type="text" class="form-control border-bottom" placeholder="Enter Location Name..." name="location" value="{{ old('location') }}" required/>

                    </div>
                    <div class="form-group col-12">
                       <label>Gps (Geo Location)</label>
                        <input type="text" class="form-control border-bottom" placeholder="Enter Gps (lat,lng)..." name="gps" value="{{ old('gps') }}" required/>
                    </div>
                    <div class="form-group col-12">
                        <label>Consumer Type</label>
                        <select name="standard"
                            class="select2-multiple form-control fs-14  h-50px" required>
                            @if(auth()->user()->role == 2)
                                @if (auth()->user()->type == "commercial")
                                    <option value="Commercial">Commercial</option>
                                @else
                                    <option value="Online (GPS)">Online (GPS)</option>
                                    <option value="Gps ( billing )">Gps ( billing )</option>
                                    <option value="Gps ( care off )">Gps ( care off )</option>
                                    <option value="GRATIS">GRATIS</option>
                                    <option value="Pak rangers">Pak rangers</option>
                                    <option value="P.A.F korangi creek">P.A.F korangi creek</option>
                                    <option value="Dc quota">Dc quota</option>
                                    <option value="Govt. vehicle">Govt. vehicle</option>
                                @endif
                            @else
                                <option value="Commercial">Commercial</option>
                                <option value="Online (GPS)">Online (GPS)</option>
                                <option value="Gps ( billing )">Gps ( billing )</option>
                                <option value="Gps ( care off )">Gps ( care off )</option>
                                <option value="GRATIS">GRATIS</option>
                                <option value="Pak rangers">Pak rangers</option>
                                <option value="P.A.F korangi creek">P.A.F korangi creek</option>
                                <option value="Dc quota">Dc quota</option>
                                <option value="Govt. vehicle">Govt. vehicle</option>
                            @endif
                        </select>
                    </div>
                    @if (auth()->user()->role == 1)
                        <div class="form-group col-12">
                            <label>Hydrant Users</label>
                            <select name="user_id"
                                class="select2-multiple form-control fs-14  h-50px" required>
                                @foreach ($user as $col)
                                    <option value="{{ $col->id }}">{{ $col->hydrant->name }} ({{ $col->name }})</option>
                                    {{-- <option value="{{ $col->number }}">{{ $col->name }}</option> --}}
                                @endforeach
                            </select>
                        </div>
                    @endif


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
