@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="text-white text-capitalize ps-3">Add Driver</h6>
                </div>
            </div>
          </div>
        </div>
        <div class="card-body px-4 pb-2">
            <h5>Give Driver Informarion...</h5>
            <form role="form" method="POST" action="{{ route('driver.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <h6 class="mt-3">Give Driver's Personal Informations...</h6>
                    <div class="card border-3 p-3">
                        <div class="row">
                            <div class="form-group col-12">
                                <label>Water Tanker</label>
                                <select name="truck_id"
                                    class="select2-multiple form-control fs-14  h-50px" required>
                                    @foreach ($truck as $col)
                                        <option value="{{ $col->id }}">{{ $col->truck_num }}</option>
                                        {{-- <option value="{{ $col->number }}">{{ $col->trcuk_num }}</option> --}}
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label>Name</label>
                                <input type="text" class="form-control border-bottom" placeholder="Enter driver Name..." name="name" value="{{ old('name') }}" required/>

                            </div>
                            <div class="form-group col-6">
                                <label>Phone</label>
                                <input type="tel" class="form-control border-bottom" placeholder="Enter driver Phone Number..." name="phone" value="{{ old('phone') }}" required/>
                            </div>
                        </div>
                    </div>
                    <h6 class="mt-3">Give Driver's CNIC Informarion...</h6>
                    <div class="card border-3 p-3">
                        <div class="row">
                            <div class="form-group col-6">
                                <label>CNIC Number</label>
                                <input type="number" class="form-control border-bottom" placeholder="Enter driver CNIC..." name="nic" value="{{ old('nic') }}" required/>

                            </div>
                            <div class="form-group col-6">
                                <label>CNIC Father Name</label>
                                <input type="text" class="form-control border-bottom" placeholder="Enter driver NIC Father Name..." name="nic_father_name" required/>


                            </div>
                            <div class="form-group col-6">
                                <label>CNIC Gender</label>
                                <select class="form-control border-bottom"  name="nic_gender" required>
                                    <option value="Male" >Male</option>
                                    <option value="Female">Female</option>
                                    </select>


                            </div>
                            <div class="form-group col-6">
                                <label>CNIC Residential Address</label>
                                <input type="text" class="form-control border-bottom" placeholder="Enter driver NIC Residential Address..." name="nic_res_address"  required/>


                            </div>
                            <div class="form-group col-6">
                                <label>CNIC Permenent Address</label>
                                <input type="text" class="form-control border-bottom" placeholder="Enter driver NIC Permenent Address..." name="nic_per_address"  required/>


                            </div>
                            <div class="form-group col-6">
                                <label>CNIC Date of Birth</label>
                                <input type="date" class="form-control border-bottom" placeholder="Enter driver NIC DOB..." name="nic_dob"  required/>


                            </div>

                            <div class="form-group col-6">
                                <label>CNIC Issue Date</label>
                                <input type="date" class="form-control border-bottom" placeholder="Enter driver NIC Issue Date..." name="nic_issue_date" required />


                            </div>
                            <div class="form-group col-6">
                                <label>CNIC Expiry Date</label>
                                <input type="date" class="form-control border-bottom" placeholder="Enter driver NIC Expiry Date..." name="nic_expiry_date" required />


                            </div>
                            <div class="form-group form-file-upload form-file-simple col-6">
                                <label>CNIC Picture</label>
                                <input type="file" class="form-control border-bottom inputFileHidden" name="nic_image" >
                            </div>

                            <div class="form-group form-file-upload form-file-simple col-6">
                                <label>Driver Picture</label>
                                <input type="file" class="form-control border-bottom inputFileHidden" name="image" >
                            </div>
                        </div>
                    </div>
                    <h6 class="mt-3">Give Driver's License Informarion...</h6>
                    <div class="card border-3 p-3">
                        <div class="row">
                            <div class="form-group col-6">
                                <label>License Number</label>
                                <input type="number" class="form-control border-bottom" placeholder="Enter driver License Number..." name="license_no"  required/>


                            </div>
                            {{-- new --}}
                            <div class="form-group col-6">
                                <label>License Father Name</label>
                                <input type="text" class="form-control border-bottom" placeholder="Enter driver License Father Name..." name="lic_father_name" required/>
                            </div>
                            <div class="form-group col-6">
                                <label>License Address</label>
                                <input type="text" class="form-control border-bottom" placeholder="Enter driver License Address..." name="lic_address" required/>
                            </div>
                            <div class="form-group col-6">
                                <label>License Region</label>
                                <input type="text" class="form-control border-bottom" placeholder="Enter driver License Region..." name="lic_region" required/>
                            </div>
                            <div class="form-group col-6">
                                <label>License Identity Mark</label>
                                <input type="text" class="form-control border-bottom" placeholder="Enter driver License Identity Mark..." name="lic_identity_mark" required/>
                            </div>
                            {{-- End --}}
                            <div class="form-group col-6">
                                <label>License Category</label>
                                <input type="text" class="form-control border-bottom" placeholder="Enter driver License Category..." name="category" required/>


                            </div>
                            <div class="form-group col-6">
                                <label>Blood Group</label>
                                <input type="text" class="form-control border-bottom" placeholder="Enter driver Blood Group..." name="blood_group"  required/>


                            </div>
                            <div class="form-group col-6">
                                <label>License Issue Date</label>
                                <input type="date" class="form-control border-bottom" placeholder="Enter driver License Issue Date..." name="lic_issue_date"  required/>


                            </div>
                            <div class="form-group col-6">
                                <label>License Valid Up To</label>
                                <input type="date" class="form-control border-bottom" placeholder="Enter driver License Valid Up To..." name="lic_expiry_date"  required/>


                            </div>
                            <div class="form-group form-file-upload form-file-simple col-6">
                                <label>Driver License Picture</label>
                                <input type="file" class="form-control border-bottom inputFileHidden" name="license_image" >
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <h6 class="mt-3">Give Driver's Character Certificate Information...</h6>
                        <div class="card border-3 p-3">
                            <div class="form-group col-12">
                                <label>Character Certificate Police Station Name</label>
                                <input type="text" class="form-control border-bottom" placeholder="Enter driver Character Certificate Police Station Name..." name="cc_police_station"  required/>


                            </div>
                            <div class="form-group col-12">
                                <label>Character Certificate Issue Date</label>
                                <input type="date" class="form-control border-bottom" placeholder="Enter driver Character Certificate Issue Date..." name="cc_issue_date"  required/>


                            </div>
                            <div class="form-group form-file-upload form-file-simple col-12">
                                <label>Driver Character Certificate Picture</label>
                                <input type="file" class="form-control border-bottom inputFileHidden" name="character_certificate" >
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <h6 class="mt-3">Give Driver's Health Cerificates Information...</h6>
                        <div class="card border-3 p-3">
                            <div class="form-group col-12">
                                <label>Health Certificate Hospital Name</label>
                                <input type="text" class="form-control border-bottom" placeholder="Enter driver Health Certificate Hospital Name..." name="hc_hospital_name"  required/>


                            </div>
                            <div class="form-group col-12">
                                <label>Health Certificate Issue Date</label>
                                <input type="date" class="form-control border-bottom" placeholder="Enter driver Health Certificate Issue Date..." name="hc_issue_date"  required/>


                            </div>
                            <div class="form-group form-file-upload form-file-simple col-12">
                                <label>Driver Health Certificate Picture</label>
                                <input type="file" class="form-control border-bottom inputFileHidden" name="health_certificate" >
                            </div>

                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-20 mt-4 mb-0">Create</button>
                      </div>
                  </div>

            </form>
        </div>
    </div>
  </div>
</div>


@endsection
