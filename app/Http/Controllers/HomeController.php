<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\Truck;
use App\Models\Truck_type;
use App\Traits\SaveImage;
use App\Models\Hydrants;
use App\Models\Orders;
use Illuminate\Support\Carbon;
use QrCode;
use Exception;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    use SaveImage;
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // dd("check");
        $driver = 0;
        if(auth()->user()->role == 1)
        {
            $vehicle = Truck::count();
            $driver = Driver::count();
            $hydCount = Hydrants::count();
            $order = Orders::count();
            $hydrants = Hydrants::with('vehicles')->get();

        }
        else
        {
            // dd(auth()->user()->hydrant->vehicles->toArray());
            $vehicle = Truck::where('hydrant_id',auth()->user()->hydrant->id)->count();
            // $driver = Driver::where('truck_id',auth()->user()->hydrant->vehicles->id)->count();
            $order = Orders::where('hydrant_id',auth()->user()->hydrant->id)->count();
            $hydCount = Hydrants::where('user_id',auth()->user()->id)->count();
            $hydrants = Hydrants::where('user_id',auth()->user()->id)->with('vehicles')->get();
        }
        $result[] = ['Clicks','Viewers'];
        foreach ($hydrants as $key => $value) {
            $result[++$key] = [$value->name, (int)count($value->orders)];
        }
        // dd($result);
        return view('home',compact('vehicle','driver','hydCount','hydrants','result','order'));
    }
    public function driver()
    {

        $driver = Driver::all();
        // dd($driver);
        return view('pages.driver.index',compact('driver'));
    }
    public function create()
    {
        $truck = Truck::all();
        return view('pages.driver.create',compact('truck'));
    }
    public function edit($id)
    {
        $driver = Driver::find($id);
        $truck = Truck::all();
        return view('pages.driver.edit',compact('truck','driver'));
    }
    public function update($id,Request $request)
    {
        $timezone = 'Asia/Karachi';
        $today = Carbon::parse('today 8pm', $timezone);
        // dd($today->toArray());
        $driver = Driver::find($id);
        $driver->truck_id = $request->truck_id;
        $driver->name = $request->name;
        $driver->phone = $request->phone;
        $driver->nic_name = $request->name;
        $driver->nic_gender = $request->nic_gender;
        $driver->nic_res_address = $request->nic_res_address;
        $driver->nic_per_address = $request->nic_per_address;
        $driver->nic_dob = $request->nic_dob;
        $driver->nic_father_name = $request->nic_father_name;
        $driver->nic_issue_date = $request->nic_issue_date;
        $driver->nic_expiry_date = $request->nic_expiry_date;
        $driver->license_no = $request->license_no;
        $driver->category = $request->category;
        $driver->lic_issue_date = $request->lic_issue_date;
        $driver->lic_expiry_date = $request->lic_expiry_date;
        $driver->blood_group = $request->blood_group;
        if($request->has('image'))
        {
            $driver->image = $this->ProfileImage($request->image);
        }
        if($request->has('license_image'))
        {
            $driver->license_image = $this->Licence($request->license_image);
        }
        if($request->has('health_certificate'))
        {
            $driver->health_certificate = $this->HealthCertificate($request->health_certificate);
        }
        if($request->has('character_certificate'))
        {
            $driver->character_certificate = $this->CharacterCertificate($request->character_certificate);
        }
        if($request->has('nic_image'))
        {
            $driver->nic_image = $this->NicImage($request->nic_image);
        }
        $driver->nic = $request->nic;
        $driver->expiry = $today;
        $driver->save();
        return redirect()->route('driver.list')->with('success', 'Record Updated successfully.');
    }
    public function driverStore(Request $request)
    {
        $timezone = 'Asia/Karachi';
        $today = Carbon::parse('today 8pm', $timezone);
        // dd($today->toArray());
        $driver = new Driver();
        $driver->truck_id = $request->truck_id;
        $driver->name = $request->name;
        $driver->phone = $request->phone;
        $driver->image = $this->ProfileImage($request->image);
        $driver->license_image = $this->Licence($request->license_image);
        $driver->health_certificate = $this->HealthCertificate($request->health_certificate);
        $driver->character_certificate = $this->CharacterCertificate($request->character_certificate);
        $driver->nic = $request->nic;
        $driver->nic_name = $request->name;
        $driver->nic_gender = $request->nic_gender;
        $driver->nic_res_address = $request->nic_res_address;
        $driver->nic_per_address = $request->nic_per_address;
        $driver->nic_dob = $request->nic_dob;
        $driver->nic_father_name = $request->nic_father_name;
        $driver->nic_issue_date = $request->nic_issue_date;
        $driver->nic_expiry_date = $request->nic_expiry_date;
        $driver->license_no = $request->license_no;
        $driver->category = $request->category;
        $driver->lic_issue_date = $request->lic_issue_date;
        $driver->lic_expiry_date = $request->lic_expiry_date;
        $driver->blood_group = $request->blood_group;
        $driver->nic_image = $this->NicImage($request->nic_image);
        $driver->expiry = $today;
        $driver->save();
        return redirect()->route('driver.list');
    }
    public function changeDriverStatus(Request $request)
    {
        $driver = Driver::find($request->id);
        $driver->black_list = $request->status;
        $driver->save();
        return 1;
    }
    public function truckTypeIndex()
    {
        $truck_type = Truck_type::all();
        return view('pages.truck_type.index',compact('truck_type'));
    }
    public function truckTypeEdit($id)
    {
        $truck_type = Truck_type::find($id);
        return view('pages.truck_type.edit',compact('truck_type'));
    }
    public function truckTypeUpdate($id,Request $request)
    {
        $truck_type = Truck_type::find($id);
        $truck_type->name = $request->name;
        $truck_type->description = $request->description;
        $truck_type->save();
        return redirect()->route('truck_type.list')->with('success', 'Record Updated successfully.');
    }
    public function truckTypeCreate()
    {
        return view('pages.truck_type.create');
    }
    public function truckTypeStore(Request $request)
    {
        Truck_type::create($request->all());
        return redirect()->route('truck_type.list');
    }
    public function truck()
    {
        if(auth()->user()->role != 1)
        {
            $truck = Truck::all()->where('hydrant_id',auth()->user()->hydrant->id);
        }
        else
        {
            $truck = Truck::all();
        }
        return view('pages.truck.index',compact('truck'));
    }
    public function TruckCreate()
    {
        $driver = Truck_type::get();
        $hydrant = Hydrants::all();
        return view('pages.truck.create',compact('driver','hydrant'));
    }
    public function truckStore(Request $request)
    {
        $valid = $this->validate($request, [
            'truck_num'   		=>  'required|string|unique:trucks,truck_num',
            'truck_type' 		=>  'required|numeric|exists:truck_types,id',
			'owned_by'          =>  'required|numeric|in:0,1',
			'vehicle_fitness'   =>  'required|image|max:2048',
            'paper_image'     	=>  'required|image|max:2048',
            'vehicle_image'     =>  'required|image|max:2048',
        ]);
        try
        {
            $truck = new Truck();
            $truck->truck_type = $request->truck_type;
            if(auth()->user()->role == 1)
            {
                $truck->hydrant_id = $request->hydrant_id;
            }
            else
            {
                $truck->hydrant_id = auth()->user()->hydrant->id;
            }
            $truck->name = $request->name;
            $truck->company_name = $request->company_name;
            $truck->truck_num = $request->truck_num;
            $truck->chassis_num = $request->chassis_num;
            $truck->engine_num = $request->engine_num;
            $truck->cabin_color = $request->cabin_color;
            $truck->tanker_color = $request->tanker_color;
            $truck->owned_by = $request->owned_by;
            $truck->paper_image = $this->Licence($request->paper_image);
            $truck->vehicle_image = $this->vehicle($request->vehicle_image);
            $truck->vehicle_fitness = $this->fitness($request->vehicle_fitness);
            $truck->model = $request->model;
            $truck->save();
            if(auth()->user()->role != 1)
            {
                return redirect()->route('hydrant.truck.list');
            }
            else
            {
                return redirect()->route('truck.list');


            }
        }
        catch(Exception $ex)
        {
            return back()->with('error', $ex->getMessage());
        }

    }
    public function TruckEdit($id)
    {
        $truck = Truck::find($id);
        $driver = Truck_type::get();
        $hydrant = Hydrants::all();
        return view('pages.truck.edit',compact('driver','hydrant','truck'));
    }
    public function TruckUpdate($id,Request $request)
    {
        $valid = $this->validate($request, [
            'truck_num'   		=>  'required|string|unique:trucks,truck_num,'.$id,
            'truck_type' 		=>  'required|numeric|exists:truck_types,id',
			'owned_by'          =>  'required|numeric|in:0,1',
			'vehicle_fitness'   =>  'image|max:2048',
            'paper_image'     	=>  'image|max:2048',
            'vehicle_image'     =>  'image|max:2048',
        ]);
        try
        {
            $truck = Truck::find($id);
            $truck->truck_type = $request->truck_type;
            if(auth()->user()->role == 1)
            {
                $truck->hydrant_id = $request->hydrant_id;
            }
            else
            {
                $truck->hydrant_id = auth()->user()->hydrant->id;
            }
            $truck->name = $request->name;
            $truck->company_name = $request->company_name;
            $truck->truck_num = $request->truck_num;
            $truck->chassis_num = $request->chassis_num;
            $truck->engine_num = $request->engine_num;
            $truck->cabin_color = $request->cabin_color;
            $truck->tanker_color = $request->tanker_color;
            $truck->owned_by = $request->owned_by;
            if($request->has('paper_image'))
            {
                $truck->paper_image = $this->Licence($request->paper_image);
            }
            if($request->has('vehicle_image'))
            {
                $truck->vehicle_image = $this->vehicle($request->vehicle_image);
            }
            if($request->has('vehicle_fitness'))
            {
                $truck->vehicle_fitness = $this->fitness($request->vehicle_fitness);
            }
            $truck->model = $request->model;
            $truck->save();
            if(auth()->user()->role != 1)
            {
                return redirect()->route('hydrant.truck.list')->with('success', 'Record Updated successfully.');
            }
            else
            {
                return redirect()->route('truck.list')->with('success', 'Record Updated successfully.');


            }
        }
        catch(Exception $ex)
        {
            return back()->with('error', $ex->getMessage());
        }

    }
    public function generateQR($id)
    {

        $url =  route('vehicle.details',$id);
        // dd($url);
        // return \QrCode::size(300)->generate($url);
        return view('pages.truck.qr',compact('url'));
    }
    public function vehicleDetails($id)
    {
        $driver = Truck::with('truckCap','hydrant','drivers')->find($id);
        // dd($driver->toArray());
        return view('pages.truck.print',compact('driver'));
    }
    public function changeVehicleStatus(Request $request)
    {
        // dd($request->all());
        $truck = Truck::find($request->id);
        $truck->black_list = $request->status;
        $truck->save();
        return 1;
    }
}
