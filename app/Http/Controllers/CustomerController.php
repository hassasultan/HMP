<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;


class CustomerController extends Controller
{
    //
    public function index(Request $request)
    {
        $customer = new Customer();
        if(auth()->user()->role != 1)
        {
            $customer = $customer->where('user_id',auth()->user()->id);
        }
        if($request->has('name'))
        {
            $customer = $customer->where('name', 'like', '%' . $request->name . '%')->orwhere('contact_num', 'like', '%' . $request->name . '%');
        }
        $customer = $customer->paginate(20);
        if($request->has('search'))
        {
            return $customer;
        }
        return view('pages.customer.index',compact('customer'));
    }
    public function create()
    {
        $user = User::where('id','!=', auth()->user()->id)->whereHas('hydrant')->get();
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
    public function generate_report($id)
    {
        $customer = Customer::with('orders')->find($id);
        return view('pages.customer.report',compact('customer'));
    }

}
