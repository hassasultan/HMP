<?php

namespace App\Http\Controllers;

use App\Models\Billings;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Truck_type;
use App\Models\Truck;
use App\Models\Driver;
use Haruncpi\LaravelIdGenerator\IdGenerator;
class OrderController extends Controller
{
    //
    public  function index()
    {
        # code...
        $order = Orders::all();
        return view('pages.order.index',compact('order'));
    }
    public  function create()
    {
        # code...
        $truck_type = Truck_type::all();
        return view('pages.order.create',compact('truck_type'));
    }

    public  function store(Request $request)
    {
        # code...
        $letter = str_split($request->address);
        $id = IdGenerator::generate(['table' => 'orders', 'field' => 'Order_Number', 'length' => 7, 'prefix' => strtoupper($letter[0]).'-']);
        
        $request['Order_Number'] = $id;
        // dd($request->all());
        //output: INV-000001
        $truck_type = Orders::create($request->all());
        $truck_type->Order_Number = $id;
        $truck_type->save();
        return redirect()->route('order.list');

    }

    //billing

    public  function billingindex()
    {
        # code...
        $billing = Billings::all();
        return view('pages.billing.index',compact('billing'));
    }
    public  function billingcreate()
    {
        # code...
        $order = Orders::all();
        $truck = Truck::all();
        $driver = Driver::all();
        return view('pages.billing.create',compact('order','truck','driver'));
    }

    public  function billingstore(Request $request)
    {
        # code...
        $truck_type = Billings::create($request->all());
        return redirect()->route('billing.list');

    }
    
    public  function billingReciept($id)
    {
        # code...
        $billing = Billings::with('order','truck','driver','truck.hydrant')->find($id);
        // dd($billing->toArray());
        return view('pages.billing.print',compact('billing'));
    }
}
