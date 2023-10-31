<?php

namespace App\Http\Controllers;

use App\Exports\MyDataExport;
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
use Maatwebsite\Excel\Facades\Excel;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class OrderController extends Controller
{
    //
    public  function index(Request $request)
    {
        # code...
        $vehicle_type = Truck_type::all();
        $order = Orders::with('truck_type_fun','hydrant','customer','billing');
        if (auth()->user()->role != 1) {
            $order = $order->where('hydrant_id', auth()->user()->hydrant_id);
            if (auth()->user()->type == "commercial") {
                $order = $order->whereHas('customer', function ($q) {
                    $q->where('standard', 'Commercial');
                });
            } else {
                $order = $order->whereHas('customer', function ($q) {
                    $q->where('standard', '!=', 'Commercial');
                });
            }
        }

        if($request->has('vehicle_type') && $request->vehicle_type != '')
        {
            $order = $order->where('truck_type',$request->vehicle_type);
        }
        if($request->has('from_date') && $request->from_date != '' && $request->has('to_date') && $request->to_date != '')
        {
            $order = $order->whereBetween('created_at',[$request->from_date, $request->to_date]);
        }
        // dd($order->OrderBy('id', 'DESC')->get()->toArray());

        if($request->has('order_type') && $request->order_type != '')
        {
            $order = $order->where('order_type',$request->order_type);
        }
        if($request->has('order_num') && $request->order_num != '')
        {
            $order = $order->where('Order_Number',$request->order_num);
        }
        if($request->has('customer_phone') && $request->customer_phone != '')
        {
            $phone = $request->customer_phone;
            $order = $order->whereHas('customer', function ($q) use($phone) {
                $q->where('contact_num', $phone);
            });
        }
        if($request->has('report'))
        {
            $data = $order->OrderBy('id', 'DESC')->whereHas('billing')->get();
            return Excel::download(new MyDataExport($data), 'my-data.xlsx');
        }
        $order = $order->OrderBy('id', 'DESC')->paginate(20);
        // dd($order->toArray());
        return view('pages.order.index', compact('order','vehicle_type'));
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
        // dd($request->all());
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
                if (auth()->user()->role == 1) {
                    $cust->user_id = 1;
                } else {
                    $cust->user_id = auth()->user()->id;
                }
                $cust->save();
            }
        } else {
            $cust = Customer::find($request->customer_id);
        }
        if ($request->has('ots')) {
            $ord_check = Orders::where('Order_Number', $request->Order_Number)->count();
            if ($ord_check == 0) {
                $new_order = new Orders();
                $new_order->Order_Number = $request->Order_Number;
                if (auth()->user()->role != 1) {
                    $new_order->hydrant_id = auth()->user()->hydrant->id;
                } else {
                    $hyd_id = $request->hydrant_id;
                    $user = User::with('hydrant')->whereHas('hydrant', function ($query) use ($hyd_id) {
                        $query->where('ots_hydrant', $hyd_id);
                    })->first();
                    $new_order->hydrant_id = $user->hydrant_id;
                }
                $new_order->customer_id = $cust->id;
                $new_order->contact_num = $request->contact_num;
                $new_order->delivery_charges = $request->delivery_charges;
                if((int)$request->distance_kms < 11)
                {
                    $new_order->distance_kms = 0;
                }
                else
                {
                    $new_order->distance_kms = $request->distance_kms;
                }
                $gallon = Truck_type::where('name', $request->gallon)->first();
                $new_order->truck_type = $gallon->id;
                $new_order->save();
            }
            else
            {
                $new_order = Orders::where('Order_Number', $request->Order_Number)->first();
            }

        } else {
            foreach ($request->customer_id as $row) {
                $letter = explode(' ', $request->order_type);
                $NEW_ORDER = Orders::latest()->first();
                if (empty($NEW_ORDER)) {
                    $expNum[1] = 0;
                } else {
                    $expNum = explode('-', $NEW_ORDER->Order_Number);
                }
                if (isset($expNum[1])) {
                    if(isset($letter[1]))
                    {
                        $id = strtoupper($letter[1]) . '-' . date('YmdHis');
                    }
                    else
                    {
                        $id = strtoupper($letter[0]) . '-' . date('YmdHis');

                    }
                } else {
                    if(isset($letter[1]))
                    {
                        $id = strtoupper($letter[1]) . '-' . date('YmdHis');
                    }
                    else
                    {
                        $id = strtoupper($letter[0]) . '-' . date('YmdHis');

                    }
                }
                // $id = IdGenerator::generate(['table' => 'orders', 'field' => 'Order_Number', 'length' => 9, 'prefix' => strtoupper($letter[0]).'-']);

                // dd($id);
                $request['Order_Number'] = $id;

                //output: INV-000001
                $data = $request->all();
                $data['customer_id'] = $row;
                $truck_type = Orders::create($data);
                // dd($truck_type);
                if (auth()->user()->role != 1) {
                    $truck_type->hydrant_id = auth()->user()->hydrant->id;
                } else {
                    $truck_type->hydrant_id = $request->hydrant_id;
                }
                $truck_type->Order_Number = $id;
                $truck_type->customer_id = $row;
                $truck_type->save();
            }
        }
        if($request->has('ots'))
        {
            return redirect()->route('billing.create',$new_order->id);
        }
        if (auth()->user()->role != 1) {
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    //billing

    public  function billingindex(Request $request)
    {
        # code...
        $vehicle_type = Truck_type::all();
        $billing = Billings::with('order', 'order.customer');
        if (auth()->user()->role != 1) {
            $billing = $billing->whereHas('order', function ($query) {
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
        }
        if($request->has('vehicle_type') && $request->vehicle_type != '')
        {
            $billing = $billing->whereHas('order',function($query)use($request){
                $query->where('truck_type',$request->vehicle_type);
            });
        }
        if($request->has('from_date') && $request->from_date != '' && $request->has('to_date') && $request->to_date != '')
        {
            $billing = $billing->whereBetween('created_at',[$request->from_date, $request->to_date]);
        }
        // dd($order->OrderBy('id', 'DESC')->get()->toArray());

        if($request->has('order_type') && $request->order_type != '')
        {
            $billing = $billing->whereHas('order',function($query)use($request){
                $query->where('order_type',$request->order_type);
            });
        }
        if($request->has('order_num') && $request->order_num != '')
        {
            $billing = $billing->whereHas('order',function($query)use($request){
                $query->where('Order_Number',$request->order_num);
            });
        }
        if($request->has('customer_phone') && $request->customer_phone != '')
        {
            $phone = $request->customer_phone;
            $billing = $billing->whereHas('order.customer', function ($q) use($phone) {
                $q->where('contact_num', $phone);
            });
        }
        $billing = $billing->OrderBy('id', 'DESC')->paginate(10);
        return view('pages.billing.index', compact('billing','vehicle_type'));
    }
    public  function billingcreate($id)
    {
        # code...
        $vehicle_type = Truck_type::all();
        if (auth()->user()->role != 1) {
            $order = Orders::doesntHave('billing')->where('hydrant_id', auth()->user()->hydrant->id)->where('id', $id)->get();
        } else {
            $order = Orders::doesntHave('billing')->where('id', $id)->get();
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

        return view('pages.billing.create', compact('order', 'truck', 'driver', 'vehicle_type'));
    }
    public  function billingedit($id)
    {
        # code...
        $bill = Billings::with('order')->find($id);
        // dd($bill->toArray());
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

        return view('pages.billing.edit', compact('bill', 'order', 'truck', 'driver'));
    }

    public  function billingstore(Request $request)
    {
        # code...
        // dd($request->all());
        $data = $request->all();
        $order = Orders::find($request->order_id);
        if ($request->has('new_tanker')) {
            $check = Truck::where('truck_num', $request->reg_num)->first();
            if (empty($check)) {
                $truck = Truck::create([
                    "truck_num" => $request->reg_num,
                    "truck_type" => $request->turck_type,
                    "hydrant_id" => $order->hydrant_id,
                    "unregister" => 1,
                ]);
                $truckId = $truck->id;
                $data['truck_id'] = $truck->id;
            } else {
                $truckId = $check->id;
                $data['truck_id'] = $check->id;
            }
        } else {
            $truckId = $request->truck_id;
        }
        if ($request->has('new_driver')) {
            $check2 = Driver::where('phone', $request->driver_phone)->first();
            if (empty($check2)) {
                $driver = Driver::create([
                    "name" => $request->driver_name,
                    "phone" => $request->driver_phone,
                    "truck_id" => $truckId,
                ]);
                $data['driver_id'] = $driver->id;
            } else {
                $data['driver_id'] = $check2->id;
            }
        }
        $order->truck_type = $request->turck_type;
        $order->save();
        $data['status'] = 2;
        $truck_type = Billings::create($data);
        if (auth()->user()->role != 1) {
            return redirect()->route('billing.details', $truck_type->id);
        } else {
            return redirect()->route('billing.details', $truck_type->id);
        }
    }
    public  function billingupdate(Request $request, $id)
    {
        # code...
        $data = $request->except(['_token']);
        $data['status'] = 2;
        $truck_type = Billings::where('id', $id)->update($data);
        if (auth()->user()->role != 1) {
            return redirect()->route('hydrant.billing.list');
        } else {
            return redirect()->route('billing.list');
        }
    }

    public function changeBlillingStatus(Request $request)
    {
        $status = '';
        $state = '';
        $note = '';
        $amount = '';
        $vehicle_no = '';
        $driver_name = '';
        $driver_phone = '';
        $billing = Billings::with('order','truck','driver')->find($request->id);
        if($billing->order->delivery_charges != NULL || $billing->order->distance_kms != NULL)
        {
            if($request->status == 2)
            {
                $status = 2;
                $state = "dispatched";
                $amount = $billing->amount;
                $vehicle_no = $billing->truck->truck_num;
                $driver_name = $billing->driver->name;
                $driver_phone = $billing->driver->phone;

            }
            elseif($request->status == 1)
            {
                $status = 3;
                $state = "closed";
                $amount = $billing->amount;
                $vehicle_no = $billing->truck->truck_num;
                $driver_name = $billing->driver->name;
                $driver_phone = $billing->driver->phone;

            }
            elseif($request->status == 3)
            {
                $status = 4;
                $state = "cancelled";
                $note = $request->note;
                $amount = $billing->amount;
                $vehicle_no = $billing->truck->truck_num;
                $driver_name = $billing->driver->name;
                $driver_phone = $billing->driver->phone;



            }
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://kwsb.crdc.biz/api/v1/order/'.$billing->order->Order_Number.'/update',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('status' => $status,'state' => $state,'amount' => $amount,'vehicle_no' => $vehicle_no,'driver_phone' => $driver_phone,'note' => $note,'driver_name' => $driver_name),
                CURLOPT_HTTPHEADER => array(
                  'Accept: application/json'
                ),
              ));

              $response = curl_exec($curl);

              curl_close($curl);
              if($response['error'] == true)
              {
                return response()->json(['error'=>$response['data']['message']],500);
              }
            //   dd($response);
        }
        if($request->status == 3)
        {
            $billing->cancle_reason = $request->note;
        }
        $billing->status = $request->status;
        $billing->save();
        return response()->json(['message'=>"Status Has been Changed Successfully..."],200);
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
    public function get_ots_order(Request $request)
    {
        // dd(request('page'));
        $curl = curl_init();
        $filter = null;
        if($request->has('date'))
        {
            $filter = 'date='.$request->get('date');
        }
        if($request->has('gallon'))
        {
            $filter = $filter.'&gallon='.$request->get('gallon');
        }
        if($request->has('order_no'))
        {
            $filter = $filter.'&order_no='.$request->get('order_no');
        }
        if (request()->has('page')) {
            $new_page = 'page=' . request('page');
        } else {
            $new_page = null;
        }
        if (auth()->user()->role_id == 1) {
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://kwsb.crdc.biz/api/v1/fetch/orders?'.$filter.'&'. $new_page,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));
        } else {
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://kwsb.crdc.biz/api/v1/fetch/orders?hydrant_id='.auth()->user()->hydrant->ots_hydrant.'&'.$filter.'&'.$new_page,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));
        }
        $response = curl_exec($curl);
        curl_close($curl);
        $orderData = json_decode($response, true);
        $orderData = $orderData['data'];
        $total = $orderData['total'];
        $count = $orderData['count'];
        $perPage = $orderData['per_page'];
        $currentPage = request('page');
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
    public function generate_excel()
    {
        if(auth()->user()->role == 1)
        {
            $data = Orders::with('truck_type_fun','hydrant','customer','billing')->whereHas('billing')->get();
        }
        else
        {
            $data = Orders::with('truck_type_fun','hydrant','customer','billing')->where('hydrant_id',auth()->user()->hydrant->id)->whereHas('billing')->get();
        }
        // dd($data->toArray());
        return Excel::download(new MyDataExport($data), 'my-data.xlsx');
    }
}
