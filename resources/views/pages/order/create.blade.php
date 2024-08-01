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
                                <select name="truck_type" class="select2-multiple form-control fs-14  h-50px" required>
                                    @foreach ($truck_type as $col)
                                        <option value="{{ $col->id }}">{{ $col->name }}</option>
                                        {{-- <option value="{{ $col->number }}">{{ $col->name }}</option> --}}
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-12">
                                <label>Order Type</label>
                                <select name="order_type" class="select2-multiple form-control fs-14  h-50px" required id="order-type">
                                    @if (auth()->user()->role == 2)
                                        <option value="Online (GPS)">Online (GPS)</option>
                                        @if (auth()->user()->type == 'commercial')
                                            <option value="Commercial">Commercial</option>
                                        @else
                                            <option value="Gps(billing)">Gps ( billing )</option>
                                            <option value="Gps(careoff)">Gps ( care off )</option>
                                            {{-- <option value="GRATIS">GRATIS</option> --}}
                                            <option value="Pak rangers">Pak rangers</option>
                                            <option value="P.A.F korangi creek">P.A.F korangi creek</option>
                                            <option value="Dc quota">Dc quota</option>
                                            <option value="Govt. vehicle">Govt. vehicle</option>
                                        @endif
                                    @else
                                        <option value="Online (GPS)">Online (GPS)</option>
                                        <option value="Commercial">Commercial</option>
                                        <option value="Gps(billing)">Gps ( billing )</option>
                                        <option value="Gps(careoff)">Gps ( care off )</option>
                                        {{-- <option value="GRATIS">GRATIS</option> --}}
                                        <option value="Pak rangers">Pak rangers</option>
                                        <option value="P.A.F korangi creek">P.A.F korangi creek</option>
                                        <option value="Dc quota">Dc quota</option>
                                        <option value="Govt. vehicle">Govt. vehicle</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-12">
                                <label>Customers</label>
                                <select name="customer_id[]" class=" form-control fs-14  h-50px"
                                    id="get-customer" required multiple>
                                    {{-- @foreach ($customer as $col)
                                        <option value="{{ $col->id }}">{{ $col->name }} - {{ $col->address }}
                                            {{ $col->street }} phone: {{ $col->contact_num }}</option> --}}
                                    {{-- <option value="{{ $col->number }}">{{ $col->name }}</option> --}}
                                    {{-- @endforeach --}}
                                </select>
                                <label>New Customer</label>
                                <input type="checkbox" name="new_cutomer" value="1" id="new-customer" disabled/>
                            </div>
                            <div class="d-none" id="cust-div">
                                <div class="form-group col-12">
                                    <label>Customer Name</label>
                                    <input type="tel" class="form-control border-bottom"
                                        placeholder="Enter Customer Name..." name="name"
                                        value="{{ old('name') }}" />
                                </div>
                                <div class="form-group col-12">
                                    <label>Customer Phone</label>
                                    <input type="tel" class="form-control border-bottom"
                                        placeholder="Enter Customer  Phone Number..." name="customer_num"
                                        value="{{ old('customer_num') }}" />
                                </div>
                            </div>
                            @if (auth()->user()->role == 1)
                                <div class="form-group col-12">
                                    <label>Hydrants</label>
                                    <select name="hydrant_id" class="select2-multiple form-control fs-14  h-50px" required>
                                        @foreach ($hydrants as $col)
                                            <option value="{{ $col->id }}">{{ $col->name }}</option>
                                            {{-- <option value="{{ $col->number }}">{{ $col->name }}</option> --}}
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            <div class="form-group col-12">
                                <label>Customer Alternate Phone</label>
                                <input type="tel" class="form-control border-bottom"
                                    placeholder="Enter Customer Alternate Phone Number..." name="contact_num"
                                    value="{{ old('contact_num') }}" />
                            </div>



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
            console.log("check");
            $('#get-customer').select2({
                placeholder: 'Search for a customer',
                ajax: {
                    url: '{{ route('customers.search') }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        console.log("check");
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                minimumInputLength: 2,
                templateResult: formatCustomer,
                templateSelection: formatCustomerSelection
            });

            function formatCustomer(customer) {
                if (customer.loading) {
                    return customer.text;
                }
                var markup = customer.text;
                return markup;
            }

            function formatCustomerSelection(customer) {
                return customer.text || customer.id;
            }

            $("#order-type").change(function(){
                var value  = $(this).val();
                if(value == "Commercial" || value == "Dc quota")
                {
                    $("#new-customer").attr('disabled',false);
                }
                else
                {
                    $("#new-customer").attr('disabled',true);
                }
            });

            $("#new-customer").change(function() {
                if ($(this).is(':checked')) {
                    $("#get-customer").attr('disabled', true);
                    $("#cust-div").removeClass('d-none');
                    $("#cust-div input").attr('required', 'required');
                    $("#get-customer").removeAttr('required');
                } else {
                    $("#get-customer").attr('disabled', false);
                    $("#cust-div").addClass('d-none');
                    $("#cust-div input").removeAttr('required');
                    $("#get-customer").attr('required', 'required');
                }
            });

        });
    </script>

@endsection
