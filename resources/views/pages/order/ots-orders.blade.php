@extends('layouts.app')

@section('content')

    <style>
        .villa-listing-pagination {
            display: flex;
            flex-direction: column;
            margin-bottom: 55px;
        }

        .villa-listing-pagination ul {
            width: max-content;
            margin: auto;
            margin-bottom: 15px;
        }

        .villa-listing-pagination ul li a {
            border: 1px solid #2f3237;
            border-radius: 4px;
            background-color: #141517;
            width: 40px;
            height: 40px;
            float: left;
            line-height: 40px;
            color: #2f3237;
            font-weight: 500;
        }

        .villa-listing-pagination ul li:first-child {
            margin-right: 25px;
        }

        .villa-listing-pagination ul li:last-child {
            margin-left: 25px;
        }

        .villa-listing-pagination ul li {
            margin-right: 10px;
            float: left;
        }

        .villa-listing-pagination ul li:hover a {
            color: #fff;
            border: 1px solid #c5a33579;
        }

        .villa-listing-pagination p {
            color: #8e9298;
            font-size: 14px;
        }

        .villa-listing-pagination {
            margin-bottom: 55px;
        }

        /*New Pagination Villa Listing */
        .villa-listing-pagination nav {
            width: 100%;
        }

        .villa-listing-pagination nav>div:first-child {
            display: none;
        }

        .villa-listing-pagination nav>div:last-child {
            width: 100%;
            display: flex;
            flex-direction: row-reverse;
            justify-content: space-between;
        }

        .villa-listing-pagination nav>div:last-child>div:last-child {
            width: 50%;
            float: left;
            display: flex;
            flex-direction: column;
        }

        .villa-listing-pagination nav>div:last-child>div:last-child>span {
            display: flex;
            flex-direction: row;
            width: 100%;
            justify-content: flex-start;
            box-shadow: 0 0 10px transparent !important;
        }

        .villa-listing-pagination nav>div:last-child>div:last-child>span>span,
        .villa-listing-pagination nav>div:last-child>div:last-child>span>a {
            padding: 0 !important;
            margin-right: 5px;
            display: flex;
            height: 40px;
            width: 45px;
            flex-direction: column;
            justify-content: center;
            color: #fff !important;
            background-color: #141517 !important;
            border: 1px solid #2f3237 !important;
            border-radius: 4px;
        }

        .villa-listing-pagination nav>div:last-child>div:last-child>span>span:first-child,
        .villa-listing-pagination nav>div:last-child>div:last-child>span>a:last-child,
        .villa-listing-pagination nav>div:last-child>div:last-child>span>a:first-child,
        .villa-listing-pagination nav>div:last-child>div:last-child>span>span:last-child>span {
            min-width: 60px;
        }

        .villa-listing-pagination nav>div:last-child>div:last-child>span>span:hover,
        .villa-listing-pagination nav>div:last-child>div:last-child>span>span:hover span,
        .villa-listing-pagination nav>div:last-child>div:last-child>span>a:hover {
            color: #fff !important;
            cursor: pointer;
            border: 1px solid #c5a33579 !important;
        }

        .villa-listing-pagination nav>div:last-child>div:last-child>span>a:last-child {
            position: relative;
        }

        .villa-listing-pagination nav>div:last-child>div:last-child>span>span>span {
            position: relative;
            padding: 0 !important;
            height: 40px;
            line-height: 40px;
            background-color: #141517 !important;
            border: 1px solid #2f3237 !important;
            border-radius: 4px;
            text-align: center;
        }

        .villa-listing-pagination nav>div:last-child>div:last-child>span>span[aria-current="page"]>span {
            /* border: 1px solid #fecc6b !important; */
            color: #b78725 !important;
        }

        .villa-listing-pagination nav>div:last-child>div:last-child>span>a {
            position: relative;
        }

        .villa-listing-pagination nav>div:last-child>div:last-child>span>span>span svg,
        .villa-listing-pagination nav>div:last-child>div:last-child>span>a svg {
            display: none;
        }

        .villa-listing-pagination nav>div:last-child>div:last-child>span>span:first-child>span:before,
        .villa-listing-pagination nav>div:last-child>div:last-child>span>a:last-child:before,
        .villa-listing-pagination nav>div:last-child>div:last-child>span>a:first-child:before {
            position: absolute;
            content: "Prev";
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
            bottom: 0;
            margin: auto;
            line-height: 40px;
        }

        .villa-listing-pagination nav>div:last-child>div:last-child>span>a:last-child:before,
        .villa-listing-pagination nav>div:last-child>div:last-child>span>span:last-child>span:before {
            content: "Next";
        }

        .villa-listing-pagination nav>div:last-child>div:last-child>span>span[aria-disabled]:hover span,
        .villa-listing-pagination nav>div:last-child>div:last-child>span>span[aria-disabled='true']:hover {
            cursor: auto;
        }

        .villa-listing-pagination nav>div:last-child {
            flex-direction: column-reverse;
        }

        .villa-listing-pagination p {
            text-align: left;
            margin-top: 5px;
        }

        .villa-listing-pagination nav>div:last-child>div:last-child>span>span,
        .villa-listing-pagination nav>div:last-child>div:last-child>span>a {
            min-width: 60px;
        }
    </style>

    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="text-white text-capitalize ps-3">Ots Order List</h6>
                            </div>
                            {{-- <div class="col-6 text-end">
                            <a class="btn bg-gradient-dark mb-0 mr-3" href="{{ route('order.create') }}"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;<i class="fa fa-truck"></i></a>
                        </div> --}}
                        </div>
                    </div>
                </div>
                <div class="card-header">
                    <form action="{{ route('ots.order.list') }}" method="GET">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="date">Date</label>
                                <input type="date" name="date" class="form-control border p-2"
                                    value="{{ request()->get('date') }}" id="date" />
                            </div>
                            <div class="col-md-3">
                                <label for="order_no">Order Number</label>
                                <input type="text" name="order_no" class="form-control border p-2"
                                    value="{{ request()->get('order_no') }}" id="order_no" />
                            </div>
                            <div class="col-md-3">
                                <label for="gallon">Gallon</label>
                                <select class="form-control border p-2" id="gallon" name="gallon">
                                    <option selected disabled value=""></option>
                                    <option value="1000" @if (request()->get('gallon') == '1000') selected @endif>1000</option>
                                    <option value="2000" @if (request()->get('gallon') == '2000') selected @endif>2000</option>
                                    <option value="3000" @if (request()->get('gallon') == '3000') selected @endif>3000</option>
                                    <option value="4000" @if (request()->get('gallon') == '4000') selected @endif>4000</option>
                                    <option value="5000" @if (request()->get('gallon') == '5000') selected @endif>5000</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <br />
                                <button type="submit" class="mt-2 btn  border">Search</button>
                            </div>
                            <div class="col-md-3">
                                <br />
                                <a href="{{ route('ots.order.list') }}" class="mt-2 btn  border">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class=" p-0">
                        <table class="table table-bordered align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Order
                                        Number</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Customer Details </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Hydrant</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Gallons </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Charges </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Cancelled </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Source </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Date</th>
                                    <th class="text-secondary opacity-7">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($orders) > 0)
                                    @foreach ($orders as $key => $row)
                                        @if (auth()->user()->role == 1)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p>Order Number:</p>
                                                            <h6 class="mb-0 text-sm">{{ $row['order_no'] }}</h6>
                                                            <p>Order Id:</p>
                                                            <p class="text-xs text-secondary mb-0">{{ $row['order_id'] }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $row['consumer_name'] }}</p>
                                                    <p class="text-xs text-secondary mb-0">{{ $row['consumer_phone'] }}</p>
                                                    <p class="text-xs text-primary mb-0">
                                                        {{ $row['consumer_address']['label'] }}
                                                    </p>
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ $row['consumer_address']['area'] }}</p>
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ $row['consumer_address']['block'] }}</p>
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ $row['consumer_address']['sector'] }}</p>
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ $row['consumer_address']['address'] }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-center font-weight-bold mb-0">
                                                        {{ $row['hydrant']['title'] }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ $row['gallons']['quantity'] }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">Delivery Charges:
                                                        {{ $row['delivery_charges'] }}</p>
                                                    <p class="text-xs font-weight-bold mb-0">Tanker Amount:
                                                        {{ $row['gallons']['tanker_charges'] }}</p>
                                                    <p class="text-xs font-weight-bold mb-0">Distance:
                                                        {{ $row['distance_kms'] }}</p>
                                                </td>
                                                <td>
                                                    <form method="post" action="{{ route('order.store') }}"
                                                        id="cancel-form">
                                                        @csrf
                                                        <input type="hidden" name="cancel" value="1" />
                                                        <input type="hidden" name="ots" value="1" />
                                                        <input type="hidden" name="note" value=""
                                                            id="cancel-note" />
                                                        <input type="hidden" name="name"
                                                            value="{{ $row['consumer_name'] }}" />
                                                        <input type="hidden" name="address"
                                                            value="{{ $row['consumer_address']['address'] }}, {{ $row['consumer_address']['area'] }}, {{ $row['consumer_address']['block'] }}, {{ $row['consumer_address']['sector'] }}" />
                                                        <input type="hidden" name="street"
                                                            value="{{ $row['consumer_address']['area'] }}" />
                                                        <input type="hidden" name="location"
                                                            value="{{ $row['consumer_address']['block'] }}, {{ $row['consumer_address']['sector'] }}" />
                                                        <input type="hidden" name="gps"
                                                            value="{{ $row['consumer_address']['lat'] }},{{ $row['consumer_address']['lon'] }}" />
                                                        <input type="hidden" name="contact_num"
                                                            value="{{ $row['consumer_phone'] }}" />
                                                        <input type="hidden" name="hydrant_id"
                                                            value="{{ $row['hydrant']['id'] }}" />
                                                        <input type="hidden" name="Order_Number"
                                                            value="{{ $row['order_no'] }}" />
                                                        <input type="hidden" name="gallon"
                                                            value="{{ $row['gallons']['quantity'] }}" />
                                                        <input type="hidden" name="delivery_charges"
                                                            value="{{ $row['delivery_charges'] }}" />
                                                        <input type="hidden" name="tanker_charges"
                                                            value="{{ $row['gallons']['tanker_charges'] }}" />
                                                        <input type="hidden" name="distance_kms"
                                                            value="{{ $row['distance_kms'] }}" />
                                                        <input type="hidden" name="ots_created_at"
                                                            value="{{ $row['created_at'] }}" />
                                                        <button type="button" class="badge badge-sm bg-gradient-danger"
                                                            id="cancelled-btn">Canceled
                                                            Order</button>
                                                    </form>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $row['source'] }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $row['status'] }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $row['created_at'] }}</span>
                                                </td>
                                                <td>
                                                    <form method="post" action="{{ route('order.store') }}">
                                                        @csrf
                                                        <input type="hidden" name="ots" value="1" />
                                                        <input type="hidden" name="name"
                                                            value="{{ $row['consumer_name'] }}" />
                                                        <input type="hidden" name="address"
                                                            value="{{ $row['consumer_address']['address'] }}, {{ $row['consumer_address']['area'] }}, {{ $row['consumer_address']['block'] }}, {{ $row['consumer_address']['sector'] }}" />
                                                        <input type="hidden" name="street"
                                                            value="{{ $row['consumer_address']['area'] }}" />
                                                        <input type="hidden" name="location"
                                                            value="{{ $row['consumer_address']['block'] }}, {{ $row['consumer_address']['sector'] }}" />
                                                        <input type="hidden" name="gps"
                                                            value="{{ $row['consumer_address']['lat'] }},{{ $row['consumer_address']['lon'] }}" />
                                                        <input type="hidden" name="contact_num"
                                                            value="{{ $row['consumer_phone'] }}" />
                                                        <input type="hidden" name="hydrant_id"
                                                            value="{{ $row['hydrant']['id'] }}" />
                                                        <input type="hidden" name="Order_Number"
                                                            value="{{ $row['order_no'] }}" />
                                                        <input type="hidden" name="gallon"
                                                            value="{{ $row['gallons']['quantity'] }}" />
                                                        <input type="hidden" name="delivery_charges"
                                                            value="{{ $row['delivery_charges'] }}" />
                                                        <input type="hidden" name="tanker_charges"
                                                            value="{{ $row['gallons']['tanker_charges'] }}" />
                                                        <input type="hidden" name="distance_kms"
                                                            value="{{ $row['distance_kms'] }}" />
                                                        <input type="hidden" name="ots_created_at"
                                                            value="{{ $row['created_at'] }}" />
                                                        <button type="submit"
                                                            class="badge badge-sm bg-gradient-primary">Generate
                                                            Order</button>
                                                    </form>
                                                </td>

                                            </tr>
                                        @else
                                            @if ($row['hydrant']['id'] == auth()->user()->hydrant->ots_hydrant)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <p>Order Number:</p>
                                                                <h6 class="mb-0 text-sm">{{ $row['order_no'] }}</h6>
                                                                <p>Order Id:</p>
                                                                <p class="text-xs text-secondary mb-0">
                                                                    {{ $row['order_id'] }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            {{ $row['consumer_name'] }}
                                                        </p>
                                                        <p class="text-xs text-secondary mb-0">
                                                            {{ $row['consumer_phone'] }}
                                                        </p>
                                                        <p class="text-xs text-primary mb-0">
                                                            {{ $row['consumer_address']['label'] }}
                                                        </p>
                                                        <p class="text-xs text-secondary mb-0">
                                                            {{ $row['consumer_address']['area'] }}</p>
                                                        <p class="text-xs text-secondary mb-0">
                                                            {{ $row['consumer_address']['block'] }}</p>
                                                        <p class="text-xs text-secondary mb-0">
                                                            {{ $row['consumer_address']['sector'] }}</p>
                                                        <p class="text-xs text-secondary mb-0">
                                                            {{ $row['consumer_address']['address'] }}</p>
                                                    </td>
                                                    <td>
                                                        <p class="text-center font-weight-bold mb-0">
                                                            {{ $row['hydrant']['title'] }}
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs text-secondary mb-0">
                                                            {{ $row['gallons']['quantity'] }}</p>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">Delivery Charges:
                                                            {{ $row['delivery_charges'] }}</p>
                                                        <p class="text-xs font-weight-bold mb-0">Tanker Amount:
                                                            {{ $row['gallons']['tanker_charges'] }}</p>
                                                        <p class="text-xs font-weight-bold mb-0">Distance:
                                                            {{ $row['distance_kms'] }}</p>
                                                    </td>
                                                    <td>
                                                        <form method="post" action="{{ route('order.store') }}"
                                                            id="cancel-form">
                                                            @csrf
                                                            <input type="hidden" name="cancel" value="1" />
                                                            <input type="hidden" name="ots" value="1" />
                                                            <input type="hidden" name="note" value=""
                                                                id="cancel-note" />
                                                            <input type="hidden" name="name"
                                                                value="{{ $row['consumer_name'] }}" />
                                                            <input type="hidden" name="address"
                                                                value="{{ $row['consumer_address']['address'] }}, {{ $row['consumer_address']['area'] }}, {{ $row['consumer_address']['block'] }}, {{ $row['consumer_address']['sector'] }}" />
                                                            <input type="hidden" name="street"
                                                                value="{{ $row['consumer_address']['area'] }}" />
                                                            <input type="hidden" name="location"
                                                                value="{{ $row['consumer_address']['block'] }}, {{ $row['consumer_address']['sector'] }}" />
                                                            <input type="hidden" name="gps"
                                                                value="{{ $row['consumer_address']['lat'] }},{{ $row['consumer_address']['lon'] }}" />
                                                            <input type="hidden" name="contact_num"
                                                                value="{{ $row['consumer_phone'] }}" />
                                                            <input type="hidden" name="hydrant_id"
                                                                value="{{ $row['hydrant']['id'] }}" />
                                                            <input type="hidden" name="Order_Number"
                                                                value="{{ $row['order_no'] }}" />
                                                            <input type="hidden" name="gallon"
                                                                value="{{ $row['gallons']['quantity'] }}" />
                                                            <input type="hidden" name="delivery_charges"
                                                                value="{{ $row['delivery_charges'] }}" />
                                                            <input type="hidden" name="tanker_charges"
                                                                value="{{ $row['gallons']['tanker_charges'] }}" />
                                                            <input type="hidden" name="distance_kms"
                                                                value="{{ $row['distance_kms'] }}" />
                                                            <input type="hidden" name="ots_created_at"
                                                                value="{{ $row['created_at'] }}" />
                                                            <button type="button"
                                                                class="badge badge-sm bg-gradient-danger"
                                                                id="cancelled-btn">Canceled
                                                                Order</button>
                                                        </form>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span
                                                            class="text-secondary text-xs font-weight-bold">{{ $row['source'] }}</span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span
                                                            class="text-secondary text-xs font-weight-bold">{{ $row['status'] }}</span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span
                                                            class="text-secondary text-xs font-weight-bold">{{ $row['created_at'] }}</span>
                                                    </td>
                                                    <td>
                                                        <form method="post" action="{{ route('order.store') }}">
                                                            @csrf
                                                            <input type="hidden" name="ots" value="1" />
                                                            <input type="hidden" name="name"
                                                                value="{{ $row['consumer_name'] }}" />
                                                            <input type="hidden" name="address"
                                                                value="{{ $row['consumer_address']['address'] }}, {{ $row['consumer_address']['area'] }}, {{ $row['consumer_address']['block'] }}, {{ $row['consumer_address']['sector'] }}" />
                                                            <input type="hidden" name="street"
                                                                value="{{ $row['consumer_address']['area'] }}" />
                                                            <input type="hidden" name="location"
                                                                value="{{ $row['consumer_address']['block'] }}, {{ $row['consumer_address']['sector'] }}" />
                                                            <input type="hidden" name="gps"
                                                                value="{{ $row['consumer_address']['lat'] }},{{ $row['consumer_address']['lon'] }}" />
                                                            <input type="hidden" name="contact_num"
                                                                value="{{ $row['consumer_phone'] }}" />
                                                            <input type="hidden" name="hydrant_id"
                                                                value="{{ $row['hydrant']['id'] }}" />
                                                            <input type="hidden" name="Order_Number"
                                                                value="{{ $row['order_no'] }}" />
                                                            <input type="hidden" name="gallon"
                                                                value="{{ $row['gallons']['quantity'] }}" />
                                                            <input type="hidden" name="tanker_charges"
                                                                value="{{ $row['gallons']['tanker_charges'] }}" />
                                                            {{-- <input type="hidden" name="" value=""/>
                                                            <input type="hidden" name="" value=""/>
                                                            <input type="hidden" name="" value=""/>
                                                            <input type="hidden" name="" value=""/> --}}
                                                            <button type="submit"
                                                                class="badge badge-sm bg-gradient-primary">Generate
                                                                Order</button>
                                                        </form>
                                                    </td>

                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                @else
                                    No Record Find...
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $orders->links() }}
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="reasonModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Canceled Reason</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- <fieldset class="border rounded-3 p-3"> --}}
                        <div class="form-group">
                            <label class="float-none w-auto px-3">Reason</label>
                            <select id="note" class="form-control">
                                <option value="" selected disabled>-- Select Reason --</option>
                                <option value="duplicate order">Duplicate order</option>
                                <option value="Wrong area selection">Wrong area selection</option>
                                <option value="incomplete address">Incomplete address</option>
                            </select>
                        </div>

                    {{-- </fieldset> --}}
                    <span class="text-danger d-none" id="alert-field">Please fill this field first then submit ...</span>
                    {{-- <textarea id="note" class="form-control border"></textarea> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="reason-submit" data-id="">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $("#cancelled-btn").click(function() {
            // $("#canc-reason").val($("#bulk-note").val());
            var myModal = new bootstrap.Modal(document.getElementById('reasonModal'), {
                keyboard: false
            });
            myModal.show();
        });
        $("#reason-submit").click(function() {
            note = $("#note").val();
            if (note != null) {
                $("#alert-field").addClass('d-none');
                $("#cancel-note").val(note);
                $("#cancel-form").submit();
                var myModal = new bootstrap.Modal(document.getElementById('reasonModal'), {
                    keyboard: false
                });
                myModal.hide();
            } else {
                $("#alert-field").removeClass('d-none');
            }
        });
    </script>
@endsection
