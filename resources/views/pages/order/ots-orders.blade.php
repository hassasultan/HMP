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
                                        Source </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status</th>
                                    {{-- <th class="text-secondary opacity-7"></th> --}}
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
                                                    <p class="text-xs text-secondary mb-0">{{ $row['gallons'] }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">Delivery Charges:
                                                        {{ $row['delivery_charges'] }}</p>
                                                    <p class="text-xs font-weight-bold mb-0">Tanker Amount:
                                                        {{ $row['tanker_amount'] }}</p>
                                                    <p class="text-xs font-weight-bold mb-0">Distance:
                                                        {{ $row['distance_kms'] }}</p>
                                                </td>

                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $row['source'] }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $row['status'] }}</span>
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
                                                                <p class="text-xs text-secondary mb-0">{{ $row['order_id'] }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">{{ $row['consumer_name'] }}
                                                        </p>
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
                                                        <p class="text-xs text-secondary mb-0">{{ $row['gallons'] }}</p>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">Delivery Charges:
                                                            {{ $row['delivery_charges'] }}</p>
                                                        <p class="text-xs font-weight-bold mb-0">Tanker Amount:
                                                            {{ $row['tanker_amount'] }}</p>
                                                        <p class="text-xs font-weight-bold mb-0">Distance:
                                                            {{ $row['distance_kms'] }}</p>
                                                    </td>

                                                    <td class="align-middle text-center">
                                                        <span
                                                            class="text-secondary text-xs font-weight-bold">{{ $row['source'] }}</span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span
                                                            class="text-secondary text-xs font-weight-bold">{{ $row['status'] }}</span>
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

@endsection
