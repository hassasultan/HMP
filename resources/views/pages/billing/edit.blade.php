@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="text-white text-capitalize ps-3">Update Billing</h6>
                </div>
            </div>
          </div>
        </div>
        <div class="card-body px-4 pb-2">
            <h5>Give Billing Informarion...</h5>
            <form role="form" method="POST" action="{{ route('billing.update',$bill->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-12">
                            <label>Driver</label>
                        <select name="driver_id"
                            class="select2-multiple form-control fs-14  h-50px" required>
                            {{-- <option selected disabled>-- Select Option --</option> --}}
                            @foreach ($driver as $col)
                                <option value="{{ $col->id }}" @if($bill->driver_id == $col->id) selected @endif>{{ $col->name }} - {{ $col->phone }}</option>
                                {{-- <option value="{{ $col->number }}">{{ $col->name }}</option> --}}
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-12">
                        <label>Order</label>
                        <select name="order_id"
                            class="select2-multiple form-control fs-14  h-50px" required>
                            <option value="{{ $bill->order_id }}" selected>{{ $bill->order->Order_Number}}</option>
                            @foreach ($order as $col)
                                <option value="{{ $col->id }}">{{ $col->Order_Number }}</option>
                                {{-- <option value="{{ $col->number }}">{{ $col->name }}</option> --}}
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label>Vehicle</label>
                        <select name="truck_id"
                            class="select2-multiple form-control fs-14  h-50px" required>
                            {{-- <option selected disabled>-- Select Option --</option> --}}

                            @foreach ($truck as $col)
                                <option value="{{ $col->id }}" @if($bill->truck_id == $col->id) selected @endif>{{ $col->hydrant->name }} - {{ $col->truckCap->name }} - {{ $col->name }} : {{ $col->truck_num }} ({{ $col->company_name }})</option>
                                {{-- <option value="{{ $col->number }}">{{ $col->name }}</option> --}}
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label>Tanker Amount</label>
                        <input type="number" class="form-control border-bottom" placeholder="Enter Tanker Amount..." name="amount" value="{{ old('amount',$bill->amount) }}" required/>

                    </div>
                    <div class="form-group col-12">
                        <label>Extra Per KM Amount</label>
                        <input type="number" class="form-control border-bottom" placeholder="Enter Extra Per KM Amount..." name="km_amount" value="{{ old('km_amount',$bill->km_amount) }}" required/>

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
