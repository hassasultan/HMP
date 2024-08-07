@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="text-white text-capitalize ps-3">Add Billing</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-4 pb-2">
                    <h5>Give Billing Informarion...</h5>
                    <form role="form" method="POST" action="{{ route('billing.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-12" id="search-driver">
                                <label>Driver</label>
                                <select name="driver_id" class="select2-multiple form-control fs-14  h-50px" id="driver-id"
                                    required>
                                    <option selected disabled value="">-- Select Option --</option>
                                    {{-- @foreach ($driver as $col)
                                <option value="{{ $col->id }}">{{ $col->name }} - {{ $col->phone }}</option> --}}
                                    {{-- <option value="{{ $col->number }}">{{ $col->name }}</option> --}}
                                    {{-- @endforeach --}}
                                </select>
                            </div>
                            <div class="form-group mt-2 col-12">
                                <input type="checkbox" name="new_driver" id="checkbox" />
                                <label for="checkbox">New Driver</label>

                            </div>
                            <div class="form-group d-none" id="new-driver-div">
                                <div class="form-group col-12">
                                    <label>Driver Name</label>
                                    <input type="text" class="form-control border-bottom"
                                        placeholder="Enter Driver Name..." name="driver_name" id="driver-name"
                                        value="{{ old('driver_name') }}" />

                                </div>
                                <div class="form-group col-12">
                                    <label>Driver Phone</label>
                                    <input type="number" class="form-control border-bottom"
                                        placeholder="Enter Driver Phone..." name="driver_phone" id="driver-phone"
                                        value="{{ old('driver_phone') }}" />

                                </div>
                            </div>

                            <div class="form-group col-12">
                                <label>Order</label>
                                <select name="order_id" class="select2-multiple form-control fs-14  h-50px" required>
                                    {{-- <option selected disabled>-- Select Option --</option> --}}

                                    @foreach ($order as $col)
                                        <option value="{{ $col->id }}">{{ $col->Order_Number }}</option>
                                        {{-- <option value="{{ $col->number }}">{{ $col->name }}</option> --}}
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-12">
                                <label>Vehicle</label>
                                <select name="truck_id" class="select2-multiple form-control fs-14  h-50px" required
                                    id="vehicle-id">
                                    <option selected disabled>-- Select Option --</option>

                                    {{-- @foreach ($truck as $col)
                                <option value="{{ $col->id }}">{{ $col->hydrant->name }} - {{ $col->truckCap->name }} - {{ $col->name }} : {{ $col->truck_num }} ({{ $col->company_name }})</option>
                            @endforeach --}}
                                </select>
                            </div>
                            {{-- <div class="form-group mt-2 col-12">
                        <input type="checkbox"   name="new_tanker" id="tanker-checkbox"/>
                        <label for="checkbox">New Tanker</label>

                    </div>
                    <div class="form-group d-none" id="new-tanker-div">
                        <div class="form-group col-12">
                            <label>Registration Number</label>
                            <input type="text" class="form-control border-bottom" placeholder="Enter Registration Number..." name="reg_num" id="reg-num" value="{{ old('reg_num') }}" />

                        </div>
                    </div> --}}
                            {{-- {{ dd($order) }} --}}
                            <div class="form-group col-12">
                                <label>Gallon</label>
                                <select name="turck_type" class="select2-multiple form-control fs-14  h-50px"
                                    id="truck-type" required>
                                    <option selected disabled>-- Select Option --</option>
                                    @if ($order != null)
                                        @foreach ($vehicle_type as $col)
                                            <option value="{{ $col->id }}"
                                                @if ($order[0]->truck_type == $col->id) selected @endif
                                                data-price = "{{ $col->km_price }}" data-tanker="{{ $col->price }}">
                                                {{ $col->name }}
                                            </option>
                                            {{-- <option value="{{ $col->number }}">{{ $col->name }}</option> --}}
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            @if (count($order) == 1)
                                @if ($order[0]->order_type == 'Commercial')
                                    <div class="form-group col-12">
                                        <label>Area</label>
                                        <select name="area_id" id="area-id"
                                            class="select2-multiple form-control fs-14  h-50px" required>
                                            <option selected disabled>-- Select Option --</option>
                                            @if ($order != null)
                                                @foreach ($area as $col)
                                                    <option value="{{ $col->id }}" data-price="{{ $col->extra_km }}">
                                                        {{ $col->name }} -
                                                        {{ $col->block }} - {{ $col->sector }}</option>
                                                    {{-- <option value="{{ $col->number }}">{{ $col->name }}</option> --}}
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                @endif
                            @endif
                            @if (count($order) == 1)
                                @if ($order[0]->order_type == 'Commercial')
                                    <div class="form-group col-12">
                                        <label>Tanker Amount</label>
                                        <input type="number" class="form-control border-bottom"
                                            placeholder="Enter Tanker Amount..." name="amount" id="tanker-amount"
                                            value="{{ $order[0]->tanker_charges }}" required />

                                    </div>
                                    <div class="form-group col-12">
                                        <label>Extra Km Price</label>
                                        <input type="number" class="form-control border-bottom"
                                            placeholder="Enter KM Price..." name="km_amount"
                                            value="{{ $order[0]->delivery_charges }}" id="km-amount" required />

                                    </div>
                                @else
                                    <div class="form-group col-12">
                                        <label>Tanker Amount</label>
                                        <input type="number" class="form-control border-bottom"
                                            placeholder="Enter Tanker Amount..." name="amount"
                                            value="{{ $order[0]->tanker_charges }}" required />

                                    </div>
                                    <div class="form-group col-12">
                                        <label>Extra Km Price</label>
                                        <input type="number" class="form-control border-bottom"
                                            placeholder="Enter KM Price..." name="km_amount"
                                            value="{{ $order[0]->delivery_charges }}" required />

                                    </div>
                                @endif
                            @else
                                <div class="form-group col-12">
                                    <label>Tanker Amount</label>
                                    <input type="number" class="form-control border-bottom"
                                        placeholder="Enter Tanker Amount..." name="amount"
                                        value="{{ $order[0]->tanker_charges }}" required />

                                </div>
                                <div class="form-group col-12">
                                    <label>Extra Km Price</label>
                                    <input type="number" class="form-control border-bottom" placeholder="Enter KM Price..."
                                        name="km_amount" value="{{ $order[0]->delivery_charges }}" required />

                                </div>
                            @endif
                            <div class="text-center">
                                <button type="submit"
                                    class="btn btn-lg bg-gradient-primary btn-lg w-20 mt-4 mb-0">Create</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // $("#truck-type").trigger('change');

            // $("#truck-type").change(function(){
            var truckTypeTankerSelectedOption = $("#truck-type").find('option:selected');
            var priceTanker = truckTypeTankerSelectedOption.data('tanker');
            console.log(priceTanker);
            $("#tanker-amount").val(priceTanker);
            // });

            $("#truck-type").change(function() {
                var truckTypeTankerSelectedOption = $("#truck-type").find('option:selected');
                var priceTanker = truckTypeTankerSelectedOption.data('tanker');
                console.log(priceTanker);
                $("#tanker-amount").val(priceTanker);
                $("#area-id").trigger('change');
            });

        });

        $('#area-id').change(function() {
            var selectedOption = $(this).find('option:selected');
            var km = selectedOption.data('price');
            // console.log('Selected km:', km);
            var truckTypeSelectedOption = $("#truck-type").find('option:selected');
            var price = truckTypeSelectedOption.data('price');
            var kmPrice = km * price;


            // You can also use this value in other parts of your code
            // Example: Update an input field with the selected price
            $('#km-amount').val(kmPrice);
        });
        $("#checkbox").change(function() {
            if (this.checked == true) {
                $("#new-driver-div").removeClass('d-none');
                $("#driver-id").attr('disabled', true);
                $("#driver-name").attr('required', true);
                $("#driver-phone").attr('required', true);

            } else {
                $("#new-driver-div").addClass('d-none');
                $("#driver-id").attr('disabled', false);
                $("#driver-name").attr('required', false);
                $("#driver-phone").attr('required', false);

            }
        });
        $("#tanker-checkbox").change(function() {
            if (this.checked == true) {
                $("#new-tanker-div").removeClass('d-none');
                $("#vehicle-id").attr('disabled', true);
                $("#reg-num").attr('required', true);
            } else {
                $("#new-tanker-div").addClass('d-none');
                $("#vehicle-id").attr('disabled', false);
                $("#reg-num").attr('required', false);


            }
        });
    </script>
@endsection
