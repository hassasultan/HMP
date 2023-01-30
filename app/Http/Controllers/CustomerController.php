<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;


class CustomerController extends Controller
{
    //
    public function index()
    {
        if(auth()->user()->role != 1)
        {
            $customer = Customer::where('user_id',auth()->user()->id)->get();
        }
        else
        {
            $customer = Customer::all();
        }
        return view('pages.customer.index',compact('customer'));
    }
    public function create()
    {
        $user = User::all()->where('id','!=', auth()->user()->id);
        return view('pages.customer.create',compact('user'));
    }
    public function store(Request $request)
    {
        $customer = Customer::create($request->all());
        if(auth()->user()->role != 1)
        {
            $customer->user_id = auth()->user()->id;
            $customer->save();
        }
        return redirect()->route('customer-management.index');
    }
    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('pages.customer.edit',compact('customer'));
    }
    public function update(Request $request,$id)
    {
        $hyd = Customer::find($id)->update($request->all());
        return redirect()->route('customer-management.index');
    }

    public function changeStatus(Request $request)
    {
        $customer = Customer::find($request->id);
        $customer->black_list = $request->status;
        $customer->save();
        return 1;
    }

}
