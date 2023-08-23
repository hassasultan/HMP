<?php

namespace App\Http\Controllers;

use App\Models\Billings;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Truck_type;
use App\Models\Customer;
use App\Models\Truck;
use App\Models\Driver;
use App\Models\Hydrants;

use Haruncpi\LaravelIdGenerator\IdGenerator;
class OrderController extends Controller
{
    //
    public  function index()
    {
        # code...
        if(auth()->user()->role != 1)
        {
            $order = Orders::all()->where('hydrant_id',auth()->user()->hydrant->id);
        }
        else
        {
            $order = Orders::all();

        }
        return view('pages.order.index',compact('order'));
    }
    public function reports()
    {
        return "UNDER CONSTRUCTION";
    }
    public  function create()
    {
        # code...
        $truck_type = Truck_type::all();
        if(auth()->user()->role != 1)
        {
            $customer = Customer::all()->where('user_id',auth()->user()->id);
        }
        else
        {
            $customer = Customer::all();
        }
        $hydrants = Hydrants::get();
        return view('pages.order.create',compact('truck_type','customer','hydrants'));
    }

    public  function store(Request $request)
    {
        # code...
        $cust = Customer::find($request->customer_id);
        $letter = str_split($cust->address);
        $NEW_ORDER = Orders::latest()->first();
        if(empty($NEW_ORDER))
        {
            $expNum[1] = 0;
        }
        else
        {
            $expNum = explode('-', $NEW_ORDER->Order_Number);
        }
        $id = strtoupper($letter[0]).'-0000'. $expNum[1]+1;
        // $id = IdGenerator::generate(['table' => 'orders', 'field' => 'Order_Number', 'length' => 9, 'prefix' => strtoupper($letter[0]).'-']);

        // dd($id);
        $request['Order_Number'] = $id;
        //output: INV-000001
        $truck_type = Orders::create($request->all());
        if(auth()->user()->role != 1)
        {
            $truck_type->hydrant_id = auth()->user()->hydrant->id;
        }
        else
        {
            $truck_type->hydrant_id = $request->hydrant_id;
        }
        $truck_type->Order_Number = $id;
        $truck_type->customer_id = $request->customer_id;
        $truck_type->save();
        if(auth()->user()->role != 1)
        {
            return redirect()->route('hydrant.order.list');
        }
        else
        {
            return redirect()->route('order.list');


        }

    }

    //billing

    public  function billingindex()
    {
        # code...
        if(auth()->user()->role != 1)
        {
            $billing = Billings::with('order')->whereHas('order',function($query){
                $query->where('hydrant_id',auth()->user()->hydrant->id);
            })->get();
        }
        else
        {
            $billing = Billings::all();
        }
        return view('pages.billing.index',compact('billing'));
    }
    public  function billingcreate()
    {
        # code...
        if(auth()->user()->role != 1)
        {
            $order = Orders::doesntHave('billing')->where('hydrant_id',auth()->user()->hydrant->id)->get();
        }
        else
        {
            $order = Orders::doesntHave('billing')->get();

        }
        if(auth()->user()->role != 1)
        {
            $truck = Truck::all()->where('hydrant_id',auth()->user()->hydrant->id);
        }
        else
        {
            $truck = Truck::all();
        }
        if(auth()->user()->role != 1)
        {
            $driver = Driver::with('truck')->whereHas('truck',function($query){
                $query->where('hydrant_id',auth()->user()->hydrant->id);
            })->get();
        }
        else
        {
            $driver = Driver::all();

        }

        return view('pages.billing.create',compact('order','truck','driver'));
    }

    public  function billingstore(Request $request)
    {
        # code...
        $truck_type = Billings::create($request->all());
        if(auth()->user()->role != 1)
        {
            return redirect()->route('hydrant.billing.list');
        }
        else
        {
            return redirect()->route('billing.list');


        }

    }

    public function changeBlillingStatus(Request $request)
    {
        $driver = Billings::find($request->id);
        $driver->status = $request->status;
        $driver->save();
        return 1;
    }

    public  function billingReciept($id)
    {
        # code...
        $billing = Billings::with('order','order.customer','truck','driver','truck.hydrant')->find($id);
        // dd($billing->toArray());
        return view('pages.billing.print',compact('billing'));
    }
}
