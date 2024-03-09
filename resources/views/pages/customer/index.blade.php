@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="text-white text-capitalize ps-3">Customer List</h6>
                            </div>
                            <div class="col-6 text-end">
                                <a class="btn bg-gradient-dark mb-0 mr-3" href="{{ route('customer-management.create') }}"><i
                                        class="material-icons text-sm">add</i>&nbsp;&nbsp;<i class="fa fa-truck"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="p-3">
                            <form role="form" method="get" action="{{ route('customer-management.index') }}"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-8 p-3">
                                        <label>Search With Customer Name or Contact Number</label>
                                        <input type="text" class="form-control border-bottom"
                                            placeholder="Enter Customer Name or Contact Number..." name="name"
                                            value="{{ request()->get('name') }}" />
                                    </div>
                                </div>
                                <div class="form-group col-3 p-3 mt-4">
                                    <button type="submit" class="btn bg-gradient-primary btn-lg ">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class=" p-0">
                        <table id="example1" class="table table-bordered align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Adress</th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Contact
                                        Number</th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Consumer Type</th>
                                    <th class="text-secondary opacity-7">Black Listed</th>

                                    <th class="text-secondary opacity-7">Reports</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($customer) > 0)
                                    @foreach ($customer as $key => $row)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $row->name }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $row->address }}</p>
                                                <p class="text-xs text-secondary mb-0">{{ $row->street }}</p>
                                                <p class="text-xs text-secondary mb-0">{{ $row->location }}</p>
                                                <p class="text-xs text-secondary mb-0">{{ $row->gps }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $row->contact_num }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $row->standard }}</p>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control border border-dark border-1 p-2"
                                                        id="FormControlAdminSelect-{{ $row->id }}"
                                                        onchange="adminstatuscustomer({{ $row->id }});">
                                                        <option @if ($row->black_list == 1) selected @endif
                                                            value='1'>
                                                            Yes</option>
                                                        <option @if ($row->black_list == 0) selected @endif
                                                            value='0'>
                                                            No</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('generate.customer.report', $row->id) }}" target="_blank"
                                                    class="btn btn-sm btn-primary" data-toggle="tooltip"
                                                    data-original-title="Edit user">
                                                    Generate Report
                                                </a>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('customer-management.edit', $row->id) }}"
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

                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $customer->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
