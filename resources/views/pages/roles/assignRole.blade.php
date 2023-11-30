@extends('layouts.app')
@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Assign Role</h1>
        <div class="lead">
            Manage your roles here.
            <a href="{{ route('roles.create') }}" class="btn bg-gradient-dark btn-sm">Add role</a>
        </div>

        <div class="mt-2">
            @include('layouts.partials.messages')
        </div>

        <div class="col-md-12">
            <form action="{{ route('assign.role.users',$role->id) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="form-group col-12">
                        <label>Users</label>
                        <select name="user_id[]" class="select2-multiple form-control fs-14  h-50px" required multiple>
                            {{-- <option selected disabled>-- Select Option --</option> --}}
                            @foreach ($user as $col)
                                <option value="{{ $col->id }}">{{ $col->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-20 mt-4 mb-0">Assigned</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
