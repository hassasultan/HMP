<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Hydrants;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    //
    public function index()
    {
        $user = User::where('id', '!=', auth()->user()->id)->get();
        return view('pages.user.index', compact('user'));
    }
    public function create()
    {
        $hydrant = Hydrants::all();
        return view('pages.user.create', compact('hydrant'));
    }
    public function store(Request $request)
    {
        $valid = $this->validate($request, [
            'email'         => 'required|string|unique:users,email',
            'name'          => 'required|string',
            'role'          => 'required|numeric|In:1,2',
            'type'          => 'required|string|In:commercial,gps',
            'hydrant_id'    => 'required|numeric|exists:hydrants,id',
        ]);
        try {
            DB::beginTransaction();
            $user = new User();
            $user->name         = $request->name;
            $user->email         = $request->email;
            $user->password         = Hash::make('12345678');
            $user->role        = $request->role;
            if ($request->role != 1) {
                $user->type        = $request->type;
                $user->hydrant_id        = $request->hydrant_id;
            } else {
                $user->type        = null;
                $user->hydrant_id        = 0;
            }
            $user->save();

            $hydrant = Hydrants::find($request->hydrant_id);
            $hydrant->user_id = $user->id;
            $hydrant->save();

            DB::commit();

            return redirect()->route('user-management.index')->with('success', 'Record created successfully.');
        } catch (Exception $ex) {
            return back()->with('error', $ex->getMessage());
        }
    }
    public function edit($id)
    {
        $user = User::find($id);
        $hydrant = Hydrants::all();
        return view('pages.user.edit', compact('user', 'hydrant'));
    }
    public function update($id, Request $request)
    {
        $valid = $this->validate($request, [
            'email'          => 'required|string|unique:users,email,' . $id,
            'name'          => 'required|string',
            'role'          => 'required|numeric|In:1,2',
            'hydrant_id'    => 'required|numeric|exists:hydrants,id',
            'type'          => 'required|string|In:commercial,gps',

        ]);
        try {
            DB::beginTransaction();
            $user = User::find($id);
            if ($request->has('name')) {
                $user->name  = $request->name;
            }
            if ($request->has('email')) {
                $user->email   = $request->email;
            }
            if ($request->has('password')) {
                $user->password   = Hash::make($request->password);
            }
            $user->role        = $request->role;
            if ($request->role != 1) {
                if ($request->has('type')) {
                    $user->type        = $request->type;
                }
                if ($request->has('hydrant_id')) {
                    $user->hydrant_id        = $request->hydrant_id;
                    $user->save();
                    $hydrant = Hydrants::find($request->hydrant_id);
                    $hydrant->user_id = $user->id;
                    $hydrant->save();
                }
                // $user->type        = $request->type;
                $user->hydrant_id        = $request->hydrant_id;
            } else {
                $user->type        = null;
                $user->hydrant_id        = 0;
            }
            $user->save();


            DB::commit();

            return redirect()->route('user-management.index')->with('success', 'Record Updated successfully.');
        } catch (Exception $ex) {
            return back()->with('error', $ex->getMessage());
        }
    }
    public function updatePassword(Request $request)
    {
        $valid =  Validator::make($request->all(), [
            'old_password' => ['required', 'string',],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if (!$valid->fails()) {
            try {
                if (Hash::check($request->old_password, auth()->user()->password)) {
                    $user = User::find(auth()->user()->id);
                    $user->password = Hash::make($request->password);
                    $user->save();
                    return redirect()->back()->with('success', "Password has been successfully updated...");
                } else {
                    $message = "Your Entered Old Password is wrong...";
                    return redirect()->back()->with('error', $message);
                }
            } catch (Exception $ex) {
                return redirect()->back()->with('error', $ex->getMessage());
            }
        } else {
            return redirect()->back()->with('error', $valid->errors());
        }
    }
    public function get_role_assign($id)
    {
        $role = Role::where('id', $id)->first();
        $user = User::whereDoesntHave('roles')->get();
        return view('pages.roles.assignRole', compact('role', 'user'));
    }
    public function role_assign(Request $request, $id)
    {
        $role = Role::where('id', $id)->first();
        foreach ($request->user_id as $row) {
            $user = User::where('id', $row)->first();
            $user->assignRole([$role->id]);
        }
        return redirect()->back()->with('success', 'Assigned Role successfully...');
    }
}
