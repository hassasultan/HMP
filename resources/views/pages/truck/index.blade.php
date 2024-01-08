@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="text-white text-capitalize ps-3">Water Tanker List</h6>
                            </div>
                            @if (auth()->user()->role == 1)
                                <div class="col-6 text-end">
                                    <a class="btn bg-gradient-dark mb-0 mr-3" href="{{ route('truck.create') }}"><i
                                            class="material-icons text-sm">add</i>&nbsp;&nbsp;<i
                                            class="fa fa-truck"></i></a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-header">
                    @if (auth()->user()->role == 1)
                        <form action="{{ route('truck.list') }}" method="GET">
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
                                        <option @if(request()->get('unregister') == 1) selected @endif value="1">UnRegister</option>
                                        <option @if(request()->get('unregister') == 0) selected @endif value="0">Register</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="link">Link</label>
                                    <select name="link" class="form-control border p-2">
                                        <option disabled selected>-- Select Option --</option>
                                        <option @if(request()->get('link') == 1) selected @endif value="1">Yes</option>
                                        <option @if(request()->get('link') == 1) selected @endif value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Hydrants</label>
                                    <select name="hydrant_id" class="select2-multiple form-control fs-14  h-50px">
                                        <option disabled selected>-- Select Option --</option>
                                        @foreach ($hydrant as $col)
                                            <option @if( request()->get('hydrant_id') == $col->id) selected @endif value="{{ $col->id }}">{{ $col->name }}</option>
                                            {{-- <option value="{{ $col->number }}">{{ $col->name }}</option> --}}
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control border p-2">
                                        <option disabled selected>-- Select Option --</option>
                                        <option @if(request()->get('status') == 1) selected @endif value="1">Active</option>
                                        <option @if(request()->get('status') == 0) selected @endif value="0">DeActive</option>
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
                        </form>
                    @else
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
                                        <option @if(request()->get('unregister') == 1) selected @endif value="1">UnRegister</option>
                                        <option @if(request()->get('unregister') == 0) selected @endif value="0">Register</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="link">Link</label>
                                    <select name="link" class="form-control border p-2">
                                        <option disabled selected>-- Select Option --</option>
                                        <option @if(request()->get('link') == 1) selected @endif value="1">Yes</option>
                                        <option @if(request()->get('link') == 1) selected @endif value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Hydrants</label>
                                    <select name="hydrant_id" class="select2-multiple form-control fs-14  h-50px">
                                        <option disabled selected>-- Select Option --</option>
                                        @foreach ($hydrant as $col)
                                            <option @if(request()->get('hydrant_id') == $col->id) selected @endif value="{{ $col->id }}">{{ $col->name }}</option>
                                            {{-- <option value="{{ $col->number }}">{{ $col->name }}</option> --}}
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control border p-2">
                                        <option disabled selected>-- Select Option --</option>
                                        <option @if({{ request()->get('status') }} == 1) selected @endif value="1">Active</option>
                                        <option @if({{ request()->get('status') }} == 0) selected @endif value="0">DeActive</option>
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
                        </form>
                    @endif
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="p-0">
                        {{-- <div class="load"></div> --}}

                        <table id="example3" class="table table-bordered align-items-center mb-0" style="width:100%">
                            <thead>
                                <tr>
                                    <!--<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Vehicle</th>-->
                                    {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Water Tanker Document Copy</th> --}}
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Model/Number </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Hydrant</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Owned By</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        QR Code</th>
                                    <th class="text-secondary opacity-7">Active</th>
                                    <th class="text-secondary opacity-7">Status</th>
                                    <th class="text-secondary opacity-7">Form View</th>
                                    <th class="text-secondary opacity-7">Action</th>
                                </tr>
                            </thead>
                            <tbody id="driver-table">
                                @if (count($truck) > 0)
                                    @foreach ($truck as $row)
                                        <tr>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0"> {{ $row->truck_num }}</p>
                                                <p class="text-xs text-secondary mb-0"> {{ $row->model }} </p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $row->hydrant->name ?? 'Hydrant has been deleted...' }} </p>
                                                <p class="text-xs text-secondary mb-0">
                                                    {{ $row->hydrant->contact ?? 'Hydrant has been deleted...' }} </p>
                                                <p class=" mt-2"><span class="p-2"
                                                        style="background-color: {{ $row->hydrant->color }} "></span></p>

                                            </td>

                                            <td>
                                                @if ($row->owned_by == 1)
                                                    <p class="text-center font-weight-bold mb-0">Contractor</p>
                                                @else
                                                    <p class="text-center font-weight-bold mb-0">Third Party</p>
                                                @endif
                                            </td>


                                            <td class="align-middle text-center text-sm">
                                                <a href="{{ route('generate.qr', $row->id) }}" target="_blank">
                                                    <span class="badge badge-sm bg-gradient-primary">Generate QrCode</span>
                                                </a>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control border border-dark border-1 p-2"
                                                        id="FormControlAdminSelect-{{ $row->id }}"
                                                        onchange="adminstatus({{ $row->id }})">
                                                        @php
                                                            if ($row->black_list == 1) {
                                                                $select = 'selected';
                                                            } else {
                                                                $select = '';
                                                            }
                                                            if ($row->black_list == 0) {
                                                                $secselect = 'selected';
                                                            } else {
                                                                $secselect = '';
                                                            }
                                                        @endphp
                                                        <option {{ $select }} value="1">Yes</option>
                                                        <option {{ $secselect }} value="0">No</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($row->unregister == 1)
                                                    <span class="badge badge-sm bg-danger">UnRegister</span>
                                                @else
                                                    <span class="badge badge-sm bg-success">Register</span>
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('vehicle.details', $row->id) }}"
                                                    class="text-secondary m-2 font-weight-bold text-xs"
                                                    data-toggle="tooltip" data-original-title="Info Vehicle"
                                                    target="_blank">Form View</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('truck.edit', $row->id) }}"
                                                    class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                                    data-original-title="Edit user">Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    No Record Find...
                                @endif
                            </tbody>
                        </table>
                        @if (count($truck) > 0)
                            <div class="d-flex justify-content-center">
                                {{ $truck->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // $(document).ready(function() {
        //     current_page = null;
        //     $('#example3').DataTable({
        //         "processing": true,
        //         "serverSide": true,
        //         "ajax": {
        //             "url": "{{ route('truck.list') }}?page="+current_page,
        //             "type": "GET",
        //             "data": {
        //                 "json": "json"
        //             },
        //             "dataSrc": function(json) {
        //                 console.log('check', json);
        //                 current_page = json.current_page;
        //                 return json.data; // Adjust based on your actual response structure
        //             }
        //         },
        //         "columns": [{
        //                 "data": "truck_num",
        //                 "name": "truck_num"
        //             },
        //             {
        //                 "data": "hydrant.name",
        //                 "name": "hydrant.name"
        //             },
        //             {
        //                 "data": "owned_by",
        //                 "name": "owned_by",
        //                 "render": function(data, type, row) {
        //                     return data == 1 ? 'Contractor' : 'Third Party';
        //                 }
        //             },
        //             {
        //                 "data": null,
        //                 "name": "qr_code",
        //                 "render": function(data, type, row) {
        //                     return '<a href="{{ route('generate.qr', '') }}/' + row.id +
        //                         '" target="_blank"><span class="badge badge-sm bg-gradient-primary">Generate QrCode</span></a>';
        //                 }
        //             },
        //             {
        //                 "data": "black_list",
        //                 "name": "black_list",
        //                 "render": function(data, type, row) {
        //                     return data == 1 ? 'Yes' : 'No';
        //                 }
        //             },
        //             {
        //                 "data": null,
        //                 "name": "form_view",
        //                 "render": function(data, type, row) {
        //                     return '<a href="{{ route('vehicle.details', '') }}/' + row.id +
        //                         '" class="text-secondary m-2 font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Info Vehicle" target="_blank">Form View</a>';
        //                 }
        //             },
        //             {
        //                 "data": null,
        //                 "name": "action",
        //                 "render": function(data, type, row) {
        //                     return '<a href="{{ route('truck.edit', '') }}/' + row.id +
        //                         '" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">Edit</a>';
        //                 }
        //             }
        //         ],
        //         "paging": true,
        //         "lengthChange": false,
        //         "searching": true,
        //         "ordering": true,
        //         "info": true,
        //         "autoWidth": false,
        //         "responsive": true,
        //     });
        // });


        $(document).ready(function() {

            // $.ajax({
            //         url: "{{ route('truck.list') }}",
            //         type: "Get",
            //         data: {
            //             json: "json",
            //         },
            //     }).done(function(data) {
            //         console.log(data);
            //         html = "";
            //         select = "";
            //         secselect = "";
            //         $.each(data, function(index, row) {
            //             console.log(row);
            //             html += '<tr>';
            //             html += '  <td>';
            //             html += '  <p class="text-xs font-weight-bold mb-0">' + row['truck_num'] +
            //                 '</p><p class="text-xs text-secondary mb-0">' + row['model'] + '</p>';
            //             // if(row['vehicle_image'] != null)
            //             // {
            //             //     html += '    <div class="d-flex px-2 py-1">';
            //             //     html += '      <div>';
            //             //     html += '        <img';
            //             //     html += '          src="{{ asset('public/storage/') }}/'+ row['vehicle_image']+'"';
            //             //     html += '          class="avatar avatar-sm me-3 border-radius-lg"';
            //             //     html += '          alt="user1"';
            //             //     html += '        />';
            //             //     html += '      </div>';
            //             // }
            //             // html += '  </td>';
            //             // html += '  <td class="align-middle text-center text-sm">';
            //             // html += '    <div class="align-middle text-center d-flex px-2 py-1">';
            //             // html += '      <div class="align-middle text-center">';
            //             // html += '        <img';
            //             // html += '          src="{{ asset('public/storage/') }}/'+row['paper_image']+'"';
            //             // html += '          class="avatar avatar-sm me-3 border-radius-lg"';
            //             // html += '          alt="user1"';
            //             // html += '        />';
            //             // html += '      </div>';
            //             // html += '    </div>';
            //             // html += '  </td>';

            //             html += '  <td>';
            //             html += '    <p class="text-xs font-weight-bold mb-0">' + row['hydrant'][
            //                 'name'
            //             ] ?? 'Hydrant has been deleted...' + '</p>';
            //             html += '    <p class="text-xs text-secondary mb-0">' + row['hydrant'][
            //                 'contact'
            //             ] ?? 'Hydrant has been deleted...' + '</p>';
            //             html += '    <p class=" mt-2"><span class="p-2" style="background-color: ' +
            //                 row['hydrant']['color'] + '"></span></p>';
            //             html += '  ';
            //             html += '  </td>';

            //             html += '  <td>';
            //             if (row['owned_by'] == 1) {
            //                 html += '<p class="text-center font-weight-bold mb-0">Contractor</p>';
            //             } else {
            //                 html += '<p class="text-center font-weight-bold mb-0">Third Party</p>';
            //             }
            //             html += '  </td>';

            //             html +=
            //                 '  <td class="align-middle text-center text-sm"><a href="{{ route('generate.qr', '') }}/' +
            //                 row['id'] +
            //                 '" target="_blank"><span class="badge badge-sm bg-gradient-primary">Generate QrCode</span></a></td>';
            //             html += '<td>';
            //             html += '    <div class="form-group">';
            //             html += '       <select class="form-control border border-dark border-1 p-2"';
            //             html += '           id="FormControlAdminSelect-' + row['id'] + '"';
            //             html += '               onchange="adminstatus(' + row['id'] + ');">';
            //             if (row['black_list'] == 1) {
            //                 select = "selected";
            //             } else {
            //                 select = "";
            //             }
            //             if (row['black_list'] == 0) {
            //                 secselect = "selected";
            //             } else {
            //                 secselect = "";
            //             }
            //             html += '                   <option ' + select + ' value="1">Yes</option>';
            //             html += '                   <option ' + secselect + ' value="0">No</option>';
            //             html += '       </select>';
            //             html += '      </div>';
            //             html += ' </td>'
            //             html += '  <td class="align-middle">';
            //             html += '  <a href="{{ route('vehicle.details', '') }}/' + row['id'] +
            //                 '" class="text-secondary m-2 font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Info Vehicle" target="_blank">Form View</a>';
            //             html += '  </td>';



            //             html += '  <td>';
            //             html += '    <a href="{{ route('truck.edit', '') }}/' + row['id'] +
            //                 '" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">Edit</a>';
            //             html += '  </td>';
            //             html += '</tr>';


            //         });
            //         // console.log(html);
            //         $('.load').css('display', 'none');
            //         $('#example3').removeClass('d-none');
            //         $("#driver-table").html(html);
            //         $('#example3').DataTable({
            //             "paging": true,
            //             "lengthChange": false,
            //             "searching": true,
            //             "ordering": true,
            //             "info": true,
            //             "autoWidth": false,
            //             "responsive": true,

            //         });
            //         // successModal("Status Has been Changed Successfully...");
            //     })
            //     .fail(function(error) {
            //         console.log(error);
            //         // errorModal(error);

            //     });
        });
    </script>
@endsection
