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
use App\Models\OtsOrder;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

use Haruncpi\LaravelIdGenerator\IdGenerator;

class OrderController extends Controller
{
    //
    public  function index()
    {
        # code...
        if (auth()->user()->role != 1) {
            $order = Orders::with('customer')->where('hydrant_id', auth()->user()->hydrant_id);
            if (auth()->user()->type == "commercial") {
                $order = $order->whereHas('customer', function ($q) {
                    $q->where('standard', 'Commercial');
                });
            } else {
                $order = $order->whereHas('customer', function ($q) {
                    $q->where('standard', '!=', 'Commercial');
                });
            }
            $order = $order->get();
        } else {
            $order = Orders::all();
        }
        return view('pages.order.index', compact('order'));
    }
    public function reports()
    {
        return "UNDER CONSTRUCTION";
    }
    public  function create()
    {
        # code...
        $truck_type = Truck_type::all();
        if (auth()->user()->role != 1) {
            $customer = Customer::where('user_id', auth()->user()->id);
            if (auth()->user()->type == "commercial") {
                $customer = $customer->where('standard', 'Commercial');
            } else {
                $customer = $customer->where('standard', '!=', 'Commercial');
            }
            $customer = $customer->get();
        } else {
            $customer = Customer::all();
        }
        $hydrants = Hydrants::get();
        return view('pages.order.create', compact('truck_type', 'customer', 'hydrants'));
    }

    public  function store(Request $request)
    {
        # code...
        if ($request->has('ots')) {
            $cust = Customer::where('contact_num', $request->contact_num)->first();
            if (empty($cust)) {
                $cust = new Customer();
                $cust->name = $request->name;
                $cust->address = $request->address;
                $cust->street = $request->street;
                $cust->location = $request->location;
                $cust->gps = $request->gps;
                $cust->contact_num = $request->contact_num;
                $cust->standard = "Online (GPS)";
                if(auth()->user()->role == 1)
                {
                    $cust->user_id = 1;
                }
                else
                {
                    $cust->user_id = auth()->user()->id;
                }
                $cust->save();
            }
        } else {
            $cust = Customer::find($request->customer_id);
        }
        if ($request->has('ots')) {
            $new_order = new Orders();
            if (auth()->user()->role != 1) {
                $new_order->hydrant_id = auth()->user()->hydrant->id;
            } else {
                $hyd_id = $request->hydrant_id;
                $user = User::with('hydrant')->whereHas('hydrant', function($query)use($hyd_id){
                    $query->where('ots_hydrant',$hyd_id);
                })->first();
                $new_order->hydrant_id = $user->hydrant_id;
            }
            $new_order->customer_id = $cust->id;
            $new_order->contact_num = $request->contact_num;
            $new_order->truck_type = 2;
            $new_order->save();
        }
        else
        {

            $letter = str_split($cust->address);
            $NEW_ORDER = Orders::latest()->first();
            if (empty($NEW_ORDER)) {
                $expNum[1] = 0;
            } else {
                $expNum = explode('-', $NEW_ORDER->Order_Number);
            }
            $id = strtoupper($letter[0]) . '-0000' . $expNum[1] + 1;
            // $id = IdGenerator::generate(['table' => 'orders', 'field' => 'Order_Number', 'length' => 9, 'prefix' => strtoupper($letter[0]).'-']);

            // dd($id);
            $request['Order_Number'] = $id;
            //output: INV-000001
            $truck_type = Orders::create($request->all());
            if (auth()->user()->role != 1) {
                $truck_type->hydrant_id = auth()->user()->hydrant->id;
            } else {
                $truck_type->hydrant_id = $request->hydrant_id;
            }
            $truck_type->Order_Number = $id;
            $truck_type->customer_id = $request->customer_id;
            $truck_type->save();
        }
        if (auth()->user()->role != 1) {
            return redirect()->route('hydrant.order.list');
        } else {
            return redirect()->route('order.list');
        }
    }

    //billing

    public  function billingindex()
    {
        # code...
        if (auth()->user()->role != 1) {
            $billing = Billings::with('order', 'order.customer')->whereHas('order', function ($query) {
                $query->where('hydrant_id', auth()->user()->hydrant_id);
            });
            if (auth()->user()->type == "commercial") {
                $billing = $billing->whereHas('order.customer', function ($q) {
                    $q->where('standard', 'Commercial');
                });
            } else {
                $billing = $billing->whereHas('order.customer', function ($q) {
                    $q->where('standard', '!=', 'Commercial');
                });
            }
            $billing = $billing->get();
        } else {
            $billing = Billings::all();
        }
        return view('pages.billing.index', compact('billing'));
    }
    public  function billingcreate()
    {
        # code...
        if (auth()->user()->role != 1) {
            $order = Orders::doesntHave('billing')->where('hydrant_id', auth()->user()->hydrant->id)->get();
        } else {
            $order = Orders::doesntHave('billing')->get();
        }
        if (auth()->user()->role != 1) {
            $truck = Truck::all()->where('hydrant_id', auth()->user()->hydrant->id);
        } else {
            $truck = Truck::all();
        }
        if (auth()->user()->role != 1) {
            $driver = Driver::with('truck')->whereHas('truck', function ($query) {
                $query->where('hydrant_id', auth()->user()->hydrant->id);
            })->get();
        } else {
            $driver = Driver::all();
        }

        return view('pages.billing.create', compact('order', 'truck', 'driver'));
    }

    public  function billingstore(Request $request)
    {
        # code...
        $truck_type = Billings::create($request->all());
        if (auth()->user()->role != 1) {
            return redirect()->route('hydrant.billing.list');
        } else {
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
        $billing = Billings::with('order', 'order.customer', 'truck', 'driver', 'truck.hydrant')->find($id);
        // dd($billing->toArray());
        return view('pages.billing.print', compact('billing'));
    }

    public function create_ots_order(Request $request)
    {
        try {
            $valid = $this->validate($request, [
                'order_id'          => 'required|string',
                'consumer_name'          => 'required|string',
                // 'consumer_number'          => 'required|string',
                // 'consumer_address'          => 'required|string',
                'hydrant'          => 'required|string',
                'gallon'          => 'required|string',
                // 'delivery_charges'          => 'required|string',
                'tanker_amount'          => 'required|string',
                // 'km'          => 'required|string',
                // 'source'          => 'required|string',
                // 'vehicle_no'          => 'required|string',
                // 'driver_name'          => 'required|string',
                // 'driver_phone'          => 'required|string',
                // 'comment'          => 'required|string',
                'status'          => 'required|string',

            ]);
            DB::beginTransaction();
            $data = $request->all();
            OtsOrder::create($data);
            DB::commit();

            return response()->json(['success' => 'Record Updated successfully...'], 200);
        } catch (Exception $ex) {
            return response()->json(['error', $ex->getMessage()], 500);
        }
    }
    public function get_ots_order()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://kwsb.crdc.biz/api/v1/fetch/orders',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $orderData = json_decode($response, true);
        $orderData = $orderData['data'];
        $total = $orderData['total'];
        $count = $orderData['count'];
        $perPage = $orderData['per_page'];
        $currentPage = $orderData['current_page'];
        $totalPages = $orderData['total_pages'];

        $orders = new \Illuminate\Pagination\LengthAwarePaginator(
            $orderData['data'],
            $total,
            $perPage,
            $currentPage,
            ['path' => route('ots.order.list'), 'query' => request()->query()]
        );
        // dd($orders);
        return view('pages.order.ots-orders', compact('orders'));
    }
}
