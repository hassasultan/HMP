<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.0.0') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"
        integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}

</head>

<body style="background-color:rgb(158, 158, 158) !important;">
    <style>
        @media only screen and (max-width: 600px) {
            .mob-end {
                text-align:center !important;
            }
        }
    </style>
    <div id="app">
        <div class="container p-4 bg-white w-100 text-center">
            <h2>KW&SC</h2>
            <p class="border-bottom">VEHICLE REGISTRATION FORM</p>

            @php
                $incompleteFields = [];

                // Check vehicle fields
                if (empty($driver->truck_num) || $driver->truck_num === null) $incompleteFields[] = 'Vehicle Registration Number';
                if (empty($driver->chassis_num) || $driver->chassis_num === null) $incompleteFields[] = 'Chassis Number';
                if (empty($driver->engine_num) || $driver->engine_num === null) $incompleteFields[] = 'Engine Number';
                if (empty($driver->company_name) || $driver->company_name === null) $incompleteFields[] = 'Make';
                if (empty($driver->model) || $driver->model === null) $incompleteFields[] = 'Model';
                if (empty($driver->cabin_color) || $driver->cabin_color === null) $incompleteFields[] = 'Cabin Color';
                if (empty($driver->tanker_color) || $driver->tanker_color === null) $incompleteFields[] = 'Tanker Color';
                if (empty($driver->name) || $driver->name === null) $incompleteFields[] = 'Owner Name';
                if (empty($driver->owner_cnic) || $driver->owner_cnic === null) $incompleteFields[] = 'Owner CNIC';

                // Check image fields
                if (empty($driver->paper_image) || $driver->paper_image === null) $incompleteFields[] = 'Registration Paper Image';
                if (empty($driver->vehicle_image) || $driver->vehicle_image === null) $incompleteFields[] = 'Vehicle Image';
                if (empty($driver->vehicle_fitness) || $driver->vehicle_fitness === null) $incompleteFields[] = 'Vehicle Fitness Certificate';
                if (empty($driver->commercial_license) || $driver->commercial_license === null) $incompleteFields[] = 'Commercial License Certificate';
                if (empty($driver->road_permit) || $driver->road_permit === null) $incompleteFields[] = 'Road Permit Document';
                if (empty($driver->doc_running_part) || $driver->doc_running_part === null) $incompleteFields[] = 'Running Paper Image';
                if (empty($driver->cabin_picture) || $driver->cabin_picture === null) $incompleteFields[] = 'Cabin Picture';

                // Check hydrant fields
                if (empty($driver->hydrant->name) || $driver->hydrant->name === null) $incompleteFields[] = 'Hydrant Name';
                if (empty($driver->hydrant->contractor_name) || $driver->hydrant->contractor_name === null) $incompleteFields[] = 'Contractor Name';
                if (empty($driver->hydrant->person) || $driver->hydrant->person === null) $incompleteFields[] = 'Focal Person';

                // Check driver fields
                if (empty($driver->drivers) || count($driver->drivers) === 0) {
                    $incompleteFields[] = 'Driver Information';
                } else {
                    foreach ($driver->drivers as $driverInfo) {
                        if (empty($driverInfo->name) || $driverInfo->name === null) $incompleteFields[] = 'Driver Name';
                        if (empty($driverInfo->phone) || $driverInfo->phone === null) $incompleteFields[] = 'Driver Phone';
                        if (empty($driverInfo->nic) || $driverInfo->nic === null) $incompleteFields[] = 'Driver NIC';
                        if (empty($driverInfo->nic_image) || $driverInfo->nic_image === null) $incompleteFields[] = 'Driver NIC Image';
                        if (empty($driverInfo->image) || $driverInfo->image === null) $incompleteFields[] = 'Driver Profile Image';
                        if (empty($driverInfo->license_image) || $driverInfo->license_image === null) $incompleteFields[] = 'Driver License Image';
                    }
                }
            @endphp

            @if(count($incompleteFields) > 0)
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <div>
                        <strong>Warning:</strong> The registration of this vehicle or driver is incomplete.
                        Missing fields: {{ implode(', ', $incompleteFields) }}
                    </div>
                </div>
            @endif

            <div class="table">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <!--<tr class="p-0">-->
                        <th class="w-100 pl-0 pr-0 mr-0">
                            Hydrant's Details
                        </th>
                        <!--</tr>-->
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="row text-start">
                                    <div class="col-md-6" style="border-right:1px solid #000;">
                                        Hydrant: {{ $driver->hydrant->name }}
                                    </div>
                                    <div class="col-md-6"style="border-left:1px solid #000;">
                                        Contractor: {{ $driver->hydrant->contractor_name }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="row text-start">
                                    <div class="col-md-6" style="border-right:1px solid #000;">
                                        Focal Person: {{ $driver->hydrant->person }}
                                    </div>
                                    {{-- <div class="col-md-6" style="border-left:1px solid #000;">
                                        Contact#: {{ $driver->hydrant->contact }}
                                    </div> --}}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="row text-start">
                                    <div class="col-md-4 " style="border-right:1px solid #000;">
                                        <input type="checkbox" @if ($driver->owned_by == 1) checked @endif
                                            disabled /> Vehicle owner by contractor
                                    </div>
                                    <div class="col-md-4" style="border-right:1px solid #000;">
                                        <input type="checkbox" @if ($driver->owned_by == 0) checked @endif
                                            disabled /> vehicle owned by third party
                                    </div>
                                    <div class="col-md-4">

                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="col-md-4 text-start">
                                    Alternate Hydrant:{{ $driver->hydrant->alternate }}
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered border-2">
                    <thead class="table-dark border-2">
                        <!--<tr class="p-0">-->
                        <th class="w-100 pl-0 pr-0 mr-0">
                            <div class="row">
                                <div class="col-md-6 text-end mob-end">
                                    Vehicle's Details
                                </div>
                                <div class="col-md-6 text-end mob-end">
                                    @if ($driver->link != null)
                                    <a class="btn bg-gradient-primary" href="{{ $driver->link }}" target="_blank"
                                        style="margin-bottom: 0rem !important; line-height:0.667 !important;"><i
                                            class="fas fa-map-marker-alt" style="font-size:0.8rem; "></i></a>
                                    @endif
                                </div>
                            </div>
                        </th>
                        <!--</tr>-->
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="row text-start">
                                    <div class="col-md-6 text-start" style="border-right:1px solid #000;">
                                        Vehicle Reg#: {{ $driver->truck_num }}
                                    </div>
                                    <div class="col-md-3 text-start" style="border-left:1px solid #000;">
                                        Chassis#: {{ $driver->chassis_num }}
                                    </div>
                                    <div class="col-md-3 text-start" style="border-left:1px solid #000;">
                                        Engine#: {{ $driver->engine_num }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="row text-start">
                                    <div class="col-md-9" style="border-right:1px solid #000;">
                                        Make: {{ $driver->company_name }}
                                    </div>
                                    <div class="col-md-3" style="border-left:1px solid #000;">
                                        Model: {{ $driver->model }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="row text-start">
                                    <div class="col-md-6" style="border-right:1px solid #000;">
                                        Tanker Capacity: {{ $driver->truckCap->name }}
                                    </div>
                                    <div class="col-md-3" style="border-left:1px solid #000;">
                                        Cabin Color: {{ $driver->cabin_color }}
                                    </div>
                                    <div class="col-md-3" style="border-left:1px solid #000;">
                                        Tank color: {{ $driver->tanker_color }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-4"></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="row text-start">
                                    <div class="col-md-6" style="border-right:1px solid #000;">
                                        Reg Paper Image: <img class="w-50"
                                            src="{{ asset('public/storage/' . $driver->paper_image) }}" />
                                    </div>
                                    <div class="col-md-6" style="border-left:1px solid #000;">
                                        Capacity: {{ $driver->truckCap->name }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="row text-start">
                                    <div class="col-md-6" style="border-right:1px solid #000;">
                                        Owner Name: {{ $driver->name }}
                                    </div>
                                    <div class="col-md-6" style="border-left:1px solid #000;">
                                        Owner CNIC: {{ $driver->owner_cnic }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="row text-center">
                                    <h6>Vehicle Image</h6>
                                    <img class="m-auto img-fluid"
                                        src="{{ asset('public/storage/' . $driver->vehicle_image) }}" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="row text-center">
                                    <h6>Vehicle Fitness Certificate</h6>
                                    <img class="m-auto img-fluid"
                                        src="{{ asset('public/storage/'.$driver->vehicle_fitness) }}" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="row text-center">
                                    <h6>Commercial License Certificate</h6>
                                    <img class="m-auto img-fluid"
                                        src="{{ asset('public/storage/'.$driver->commercial_license) }}" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="row text-center">
                                    <h6>Road Permit Document</h6>
                                    <img class="m-auto img-fluid"
                                        src="{{ asset('public/storage/'.$driver->road_permit) }}" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="row text-center">
                                    <h6>Running paper Image</h6>
                                    <img class="m-auto img-fluid"
                                        src="{{ asset('public/storage/'.$driver->doc_running_part) }}" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="row text-center">
                                    <h6>Cabin Picture</h6>
                                    <img class="m-auto img-fluid"
                                        src="{{ asset('public/storage/'.$driver->cabin_picture) }}" />
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                @foreach ($driver->drivers as $key => $row)
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <!--<tr class="p-0">-->
                            <th class="w-100 pl-0 pr-0 mr-0">
                                Driver's {{ ++$key }} Details
                            </th>
                            <!--</tr>-->
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="row  text-start">
                                        <div class="col-md-6" style="border-right:1px solid #000;">
                                            Name: {{ $row->name }}
                                        </div>
                                        <div class="col-md-6"style="border-left:1px solid #000;">
                                            Phone#: {{ $row->phone }}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row text-start">
                                        <div class="col-md-6" style="border-right:1px solid #000;">
                                            Nic#: {{ $row->nic }}
                                        </div>
                                        <div class="col-md-6" style="border-left:1px solid #000;">
                                            Nic Image#: <img class="w-50"
                                                src="{{ asset('public/storage/' . $row->nic_image) }}" />
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row text-start">
                                        <div class="col-md-6" style="border-right:1px solid #000;">
                                            Profile Image#: <img class="w-50"
                                                src="{{ asset('public/storage/' . $row->image) }}" />
                                        </div>
                                        <div class="col-md-6" style="border-left:1px solid #000;">
                                            License Image#: <img class="w-50"
                                                src="{{ asset('public/storage/' . $row->license_image) }}" />
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                @endforeach
            </div>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/js/material-dashboard.min.js?v=3.0.0') }}"></script>
</body>

</html>
