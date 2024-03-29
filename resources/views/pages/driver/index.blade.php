@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="text-white text-capitalize ps-3">Drivers List</h6>
                            </div>
                            <div class="col-6 text-end">
                                <a class="btn bg-gradient-dark mb-0 mr-3" href="{{ route('driver.create') }}"><i
                                        class="material-icons text-sm">add</i>&nbsp;&nbsp;<i class="fa fa-user"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-header">
                    @if (auth()->user()->role == 1)
                        <form action="{{ route('driver.list') }}" method="GET">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name">Driver Name</label>
                                    <input type="text" name="name" class="form-control border p-2"
                                        value="{{ request()->get('name') }}" id="name" />
                                </div>
                                <div class="col-md-3">
                                    <label for="phone">Driver Mobile Number</label>
                                    <input type="text" name="phone" class="form-control border p-2"
                                        value="{{ request()->get('phone') }}" id="phone" />
                                </div>
                                <div class="col-md-3">
                                    <label for="truck_num">Truck Number</label>
                                    <input type="text" name="truck_num" class="form-control border p-2"
                                        value="{{ request()->get('truck_num') }}" id="truck_num" />
                                </div>

                                <div class="col-md-3">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control border p-2">
                                        <option disabled selected>-- Select Option --</option>
                                        <option @if (request()->has('status') && request()->get('status') == 1) selected @endif value="1">Active
                                        </option>
                                        <option @if (request()->has('status') && request()->get('status') == 0) selected @endif value="0">DeActive
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <br />
                                    <button type="submit" class="mt-2 btn  border">Search</button>
                                </div>
                                <div class="col-md-2">
                                    <br />
                                    <a href="{{ route('driver.list') }}"
                                        class="mt-2 btn btn-primary bg-gradient-primary">Reset Filter</a>
                                </div>
                            </div>
                        </form>
                        {{-- @else
                        <form action="{{ route('hydrant.truck.list') }}" method="GET">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="reg_num">Registration Number</label>
                                    <input type="text" name="reg_num" class="form-control border p-2"
                                        value="{{ request()->get('reg_num') }}" id="reg_num" />
                                </div>
                                <div class="col-md-3">
                                    <label for="unregister">Regiter/UnRegister</label>
                                    <select name="unregister" class="form-control border p-2">
                                        <option disabled selected>-- Select Option --</option>
                                        <option value="1">UnRegister</option>
                                        <option value="0">Register</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="link">Link</label>
                                    <select name="link" class="form-control border p-2">
                                        <option disabled selected>-- Select Option --</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Hydrants</label>
                                    <select name="hydrant_id" class="select2-multiple form-control fs-14  h-50px">
                                        <option disabled selected>-- Select Option --</option>
                                        @foreach ($hydrant as $col)
                                            <option value="{{ $col->id }}">{{ $col->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control border p-2">
                                        <option disabled selected>-- Select Option --</option>
                                        <option value="1">Active</option>
                                        <option value="0">DeActive</option>
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <br />
                                    <button type="submit" class="mt-2 btn  border">Search</button>
                                </div>
                                <div class="col-md-2">
                                    <br />
                                    <a href="{{ route('truck.list') }}"
                                        class="mt-2 btn btn-primary bg-gradient-primary">Reset Filter</a>
                                </div>
                            </div>
                        </form> --}}
                    @endif
                </div>
                <div class="card-body px-0 pb-2">
                    <div class=" p-0">
                        {{-- <div class="load"></div> --}}

                        <table id="example3" class="table table-bordered align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Driver
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NIC
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Water Tanker</th>
                                    {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th> --}}
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Expiry</th>
                                    <th class="text-secondary opacity-7">Active</th>

                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($driver) > 0)
                                    @foreach ($driver as $key => $row)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ asset('public/storage/' . $row->image) }}"
                                                            class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $row->name }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $row->phone }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $row->nic }}</p>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ asset('public/storage/' . $row->nic_image) }}"
                                                            class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('vehicle.details', $row->truck->id) }}" target="_blank">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $row->truck->truck_num }}
                                                    </p>
                                                    <p class=" mt-2">
                                                        <span class="p-2"
                                                            style="background-color: {{ $row->truck->hydrant->color }};"></span>
                                                    </p>
                                                </a>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $row->expiry }}</span>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control border border-dark border-1 p-2"
                                                        id="FormControlAdminSelect-{{ $row->id }}"
                                                        onchange="adminstatusdriver({{ $row->id }});">
                                                        <option @if ($row->black_list == 1) selected @endif
                                                            value='1'>
                                                            Yes</option>
                                                        <option @if ($row->black_list == 0) selected @endif
                                                            value='0'>
                                                            No</option>
                                                    </select>
                                                </div>
                                            </td>

                                            <td class="align-middle">

                                                {{-- {!! \QrCode::size(250)->generate('www.google.com') !!} --}}
                                                <a href="{{ route('driver.edit', $row->id) }}"
                                                    class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                                    data-original-title="Edit user">
                                                    Edit
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    No Record Find...
                                @endif
                            </tbody>
                        </table>
                        @if (count($driver) > 0)
                            <div class="d-flex justify-content-center">
                                {{ $driver->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // $.ajax({
            //     url: "{{ route('driver.list') }}",
            //     type: "Get",
            //     data: {
            //         json: "json",
            //     },
            // }).done(function(data) {
            //     console.log(data);
            //     html = "";
            //     select = "";
            //     secselect = "";
            //     $.each(data,function(index,row)
            //     {
            //         console.log(row);
            //         html += '<tr>';
            //         html += '  <td>';
            //         html += '    <div class="d-flex px-2 py-1">';
            //         html += '      <div>';
            //         html += '        <img';
            //         html += '          src="{{ asset('public/storage/') }}/'+ row['image']+'"';
            //         html += '          class="avatar avatar-sm me-3 border-radius-lg"';
            //         html += '          alt="user1"';
            //         html += '        />';
            //         html += '      </div>';
            //         html += '      <div class="d-flex flex-column justify-content-center">';
            //         html += '        <h6 class="mb-0 text-sm">' +row['name']+'</h6>';
            //         html += '        <p class="text-xs text-secondary mb-0">' +row['phone']+'</p>';
            //         html += '      </div>';
            //         html += '    </div>';
            //         html += '  </td>';
            //         html += '  <td>';
            //         html += '    <p class="text-xs font-weight-bold mb-0">' +row['nic']+'</p>';
            //         // html += '    <div class="d-flex px-2 py-1">';
            //         // html += '      <div>';
            //         // html += '        <img';
            //         // html += '          src="{{ asset('public/storage/') }}/'+row['nic_image']+'"';
            //         // html += '          class="avatar avatar-sm me-3 border-radius-lg"';
            //         // html += '          alt="user1"';
            //         // html += '        />';
            //         // html += '      </div>';
            //         html += '    </div>';
            //         html += '  </td>';
            //         html += '  <td>';
            //         html += '    <a href="{{ route('vehicle.details', ' ') }}'+row['truck']['id']+'" target="_blank">';
            //         html += '      <p class="text-xs font-weight-bold mb-0">' +row['truck']['truck_num']+'</p>';
            //         html += '      <p class="mt-2">';
            //         html += '        <span';
            //         html += '          class="p-2"';
            //         html += '          style="background-color: ' +row['truck']['hydrant']['color']+';"';
            //         html += '        ></span;>';
            //         html += '      </p>';
            //         html += '    </a>';
            //         html += '  </td>';
            //         html += '  <td class="align-middle text-center">';
            //         html += '    <span; class="text-secondary text-xs font-weight-bold"';
            //         html += '      >' +row['expiry'] +'</span';
            //         html += '    >';
            //         html += '  </td>';
            //         html += '  <td>';
            //         html += '    <div class="form-group">';
            //         html += '      <select';
            //         html += '        class="form-control border border-dark border-1 p-2"';
            //         html += '        id="FormControlAdminSelect-' +row['id'] +'"';
            //         html += '        onchange="adminstatusdriver(' +row['id'] +');"';
            //         html += '      >';
            //                         if(row['black_list'] == 1)
            //                         {
            //                             select =   ' selected ';
            //                         }
            //         html += '        <option '+select+'';
            //         html +=   'value="1"> Yes';
            //         html += '        </option>';
            //                 if(row['black_list'] == 1)
            //                 {
            //                     select = ' selected ';
            //                 }
            //         html += '        <option '+select+'';
            //         html += 'value=0> No';
            //         html += '        </option>';
            //         html += '      </select>';
            //         html += '    </div>';
            //         html += '  </td>';
            //         html += '  <td class="align-middle">';
            //         html += '    <a';
            //         html += '      href="{{ route('driver.edit', ' ') }}'+row['id']+'"';
            //         html += '      class="text-secondary font-weight-bold text-xs"';
            //         html += '      data-toggle="tooltip"';
            //         html += '      data-original-title="Edit user"';
            //         html += '    >';
            //         html += '      Edit';
            //         html += '    </a;>';
            //         html += '  </td>';
            //         html += '</tr>';


            //                     });
            //     $('.load').css('display','none');
            //     $('#example3').removeClass('d-none');
            //     $("#driver-table").html(html);
            //     $('#example3').DataTable({
            //         "paging": true,
            //         "lengthChange": false,
            //         "searching": true,
            //         "ordering": true,
            //         "info": true,
            //         "autoWidth": false,
            //         "responsive": true,
            //     });
            //     // successModal("Status Has been Changed Successfully...");
            // })
            // .fail(function(error) {
            //     console.log(error);
            //     // errorModal(error);

            // });
        });
    </script>
@endsection
