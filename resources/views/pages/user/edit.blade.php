@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="text-white text-capitalize ps-3">Update User</h6>
                </div>
            </div>
          </div>
        </div>
        <div class="card-body px-4 pb-2">
            <h5>Give User Informarion...</h5>
            <form role="form" method="POST" action="{{ route('user-management.update',$user->id) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="form-group col-12 p-3">
                        <label>Name</label>
                        <input type="text" class="form-control border-bottom border-1 border-dark" placeholder="Enter User Name..." name="name" value="{{ old('name',$user->name) }}" required/>
                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Email</label>
                        <input type="email" class="form-control border-bottom border-1 border-dark" placeholder="Enter Email..." name="email" value="{{ old('email',$user->email) }}" required/>
                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Password</label>
                        <input type="password" class="form-control border-bottom border-1 border-dark" placeholder="Enter password here..." name="password" value="{{ old('password') }}"/>
                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Select Role</label>
                        <select name="role"
                            class="select2-multiple form-control fs-14  h-50px" required>
                                <option @if($user->role == "1") selected @endif value="1">Subadmin</option>
                                <option @if($user->role == "2") selected @endif value="2">Hydrant</option>
                        </select>
                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Hydrants</label>
                        <select name="hydrant_id"
                            class="select2-multiple form-control fs-14  h-50px" required>
                            @foreach ($hydrant as $col)
                                <option value="{{ $col->id }}" @if ($col->user_id == $user->id) selected @endif>{{ $col->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-12 p-3">
                        <label>Type</label>
                        <select name="type"
                            class="select2-multiple form-control fs-14  h-50px" required>
                                <option @if($user->type == "commercial") selected @endif value="commercial">Commercial</option>
                                <option @if($user->type == "gps") selected @endif value="gps">GPS</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-20 mt-4 mb-0">Update</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
  </div>
</div>


@endsection
