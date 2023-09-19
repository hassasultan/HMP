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
                        <a class="btn bg-gradient-dark mb-0 mr-3" href="{{ route('truck.create') }}"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;<i class="fa fa-truck"></i></a>
                    </div>
                @endif
            </div>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="p-0">
            <div class="load"></div>

            <table id="example3" class="table table-bordered align-items-center mb-0 d-none">
              <thead>
                <tr>
                  <!--<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Vehicle</th>-->
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Model/Number </th>
                  {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Water Tanker Document Copy</th> --}}
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hydrant</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Owned By</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">QR Code</th>
                  <th class="text-secondary opacity-7">Active</th>
                  <th class="text-secondary opacity-7">Form View</th>
                  <th class="text-secondary opacity-7">Action</th>
                </tr>
              </thead>
              <tbody id="driver-table">
                @if(count($truck) > 0)
                @else
                    No Record Find...
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $.ajax({
            url: "{{ route('truck.list') }}",
            type: "Get",
            data: {
                json: "json",
            },
        }).done(function(data) {
            console.log(data);
            html = "";
            select = "";
            secselect = "";
            $.each(data,function(index,row)
            {
                console.log(row);
                html += '<tr>';
                html += '  <td>';
                html += '  <p class="text-xs font-weight-bold mb-0">'+ row['truck_num']+'</p><p class="text-xs text-secondary mb-0">'+ row['model']+'</p>';
                // if(row['vehicle_image'] != null)
                // {
                //     html += '    <div class="d-flex px-2 py-1">';
                //     html += '      <div>';
                //     html += '        <img';
                //     html += '          src="{{ asset("public/storage/") }}/'+ row['vehicle_image']+'"';
                //     html += '          class="avatar avatar-sm me-3 border-radius-lg"';
                //     html += '          alt="user1"';
                //     html += '        />';
                //     html += '      </div>';
                // }
                // html += '  </td>';
                // html += '  <td class="align-middle text-center text-sm">';
                // html += '    <div class="align-middle text-center d-flex px-2 py-1">';
                // html += '      <div class="align-middle text-center">';
                // html += '        <img';
                // html += '          src="{{ asset("public/storage/") }}/'+row['paper_image']+'"';
                // html += '          class="avatar avatar-sm me-3 border-radius-lg"';
                // html += '          alt="user1"';
                // html += '        />';
                // html += '      </div>';
                // html += '    </div>';
                // html += '  </td>';

                html += '  <td>';
                html += '    <p class="text-xs font-weight-bold mb-0">'+row['hydrant']['name'] ?? 'Hydrant has been deleted...' +'</p>';
                html += '    <p class="text-xs text-secondary mb-0">'+row['hydrant']['contact'] ?? 'Hydrant has been deleted...' +'</p>';
                html += '    <p class=" mt-2"><span class="p-2" style="background-color: '+row['hydrant']['color']+'"></span></p>';
                html += '  ';
                html += '  </td>';

                html += '  <td>';
                if(row['owned_by'] == 1)
                {
                    html += '<p class="text-center font-weight-bold mb-0">Contractor</p>';
                }
                else
                {
                    html += '<p class="text-center font-weight-bold mb-0">Third Party</p>';
                }
                html += '  </td>';

                html += '  <td class="align-middle text-center text-sm"><a href="{{ route("generate.qr","") }}/'+ row['id'] +'" target="_blank"><span class="badge badge-sm bg-gradient-primary">Generate QrCode</span></a></td>';
                html += '<td>';
                html += '    <div class="form-group">';
                html += '       <select class="form-control border border-dark border-1 p-2"';
                html += '           id="FormControlAdminSelect-'+row['id']+'"';
                html += '               onchange="adminstatus('+row['id']+');">';
                if(row['black_list'] == 1)
                {
                    select = "selected";
                }
                else
                {
                    select = "";
                }
                if(row['black_list'] == 0)
                {
                    secselect = "selected";
                }
                else
                {
                    secselect = "";
                }
                html += '                   <option ' + select + ' value="1">Yes</option>';
                html += '                   <option ' + secselect + ' value="0">No</option>';
                html += '       </select>';
                html += '      </div>';
                html += ' </td>'
                html += '  <td class="align-middle">';
                html += '  <a href="{{route("vehicle.details","")}}/'+row['id']+'" class="text-secondary m-2 font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Info Vehicle" target="_blank">Form View</a>';
                html += '  </td>';



                html += '  <td>';
                html += '    <a href="{{ route("truck.edit","") }}/'+row['id']+'" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">Edit</a>';
                html += '  </td>';
                html += '</tr>';


                            });
            $('.load').css('display','none');
            $('#example3').removeClass('d-none');
            $("#driver-table").html(html);
            $('#example3').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            // successModal("Status Has been Changed Successfully...");
        })
        .fail(function(error) {
            console.log(error);
            // errorModal(error);

        });
    });
</script>
@endsection
