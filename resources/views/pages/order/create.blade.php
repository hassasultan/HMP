@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="text-white text-capitalize ps-3">Add Order</h6>
                </div>
            </div>
          </div>
        </div>
        <div class="card-body px-4 pb-2">
            <h5>Give Order Informarion...</h5>
            <form role="form" method="POST" action="{{ route('order.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-12">
                            <label>Vehicle Type</label>
                        <select name="truck_type"
                            class="select2-multiple form-control fs-14  h-50px" required>
                            @foreach ($truck_type as $col)
                                <option value="{{ $col->id }}">{{ $col->name }}</option>
                                {{-- <option value="{{ $col->number }}">{{ $col->name }}</option> --}}
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label>Customers</label>
                    <select name="customer_id"
                        class="select2-multiple form-control fs-14  h-50px" required>
                        @foreach ($customer as $col)
                            <option value="{{ $col->id }}">{{ $col->name }} - {{ $col->address }} {{ $col->street }}</option>
                            {{-- <option value="{{ $col->number }}">{{ $col->name }}</option> --}}
                        @endforeach
                    </select>
                </div>
                @if (auth()->user()->role == 1)
                    <div class="form-group col-12">
                        <label>Hydrants</label>
                        <select name="hydrant_id"
                            class="select2-multiple form-control fs-14  h-50px" required>
                            @foreach ($hydrants as $col)
                                <option value="{{ $col->id }}">{{ $col->name }}</option>
                                {{-- <option value="{{ $col->number }}">{{ $col->name }}</option> --}}
                            @endforeach
                        </select>
                    </div>
                @endif
                    <div class="form-group col-12">
                        <label>Customer Alternate Phone</label>
                        <input type="tel" class="form-control border-bottom" placeholder="Enter Customer Alternate Phone Number..." name="contact_num" value="{{ old('contact_num') }}"/>
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
