<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    //
    public function index()
    {
        $customer = Customer::all();
        return view('pages.customer.index',compact('customer'));
    }
    public function create()
    {
        return view('pages.customer.create');
    }
    public function store(Request $request)
    {
        $customer = Customer::create($request->all());
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

}
