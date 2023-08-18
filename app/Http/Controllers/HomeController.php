<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\Truck;
use App\Models\Truck_type;
use App\Traits\SaveImage;
use App\Models\Hydrants;
use App\Models\Orders;
use App\Models\Billings;
use App\Models\Customer;
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
    public function index(Request $request)
    {
        $driver = 0;
        $today_gallon_count = 0;

        if(auth()->user()->role == 1)
        {
            $vehicle = Truck::count();
            $driver = Driver::count();
            $contractor_driver = Driver::with('truck')->whereHas('truck',function($query){
                $query->where('owned_by',1);
            })->count();
            $third_driver = Driver::with('truck')->whereHas('truck',function($query){
                $query->where('owned_by',0);
            })->count();
            $contractor = Truck::where('owned_by',1)->count();
            $third = Truck::where('owned_by',0)->count();
            $hydCount = Hydrants::count();
            $order = Orders::count();
            $today_order = Orders::whereDay('created_at', '=', date('d'))->count();
            $today_gallon = Orders::with('truck_type_fun')->whereDay('created_at', '=', date('d'))->get();
            $customer_count = Customer::count();
            foreach($today_gallon as $row)
            {
                $expNum = explode(' ', $row->truck_type_fun->name);
                $today_gallon_count = $today_gallon_count + (int)$expNum[0];
            }
            $comm = Orders::with('customer')->whereHas('customer',function($query)
            {
                $query->where('standard',"Commercial");
            })->count();
            $gps = Orders::with('customer')->whereHas('customer',function($query)
            {
                $query->where('standard',"GPS");
            })->count();
            $today_comm = Orders::with('customer')->whereHas('customer',function($query)
            {
                $query->where('standard',"Commercial");
            })->whereDay('created_at', '=', date('d'))->count();
            $today_gps = Orders::with('customer')->whereHas('customer',function($query)
            {
                $query->where('standard',"GPS");
            })->whereDay('created_at', '=', date('d'))->count();
            $hydrants = Hydrants::with('vehicles')->get();
            $today = Hydrants::with('vehicles','todayorders','todayorders.customer')->get();
            // dd($today->toArray());

        }
        else
        {
            // dd(auth()->user()->hydrant->vehicles->toArray());
            $vehicle = Truck::where('hydrant_id',auth()->user()->hydrant->id)->count();
            // $driver = Driver::where('truck_id',auth()->user()->hydrant->vehicles->id)->count();
            $contractor_driver = Driver::with('truck')->whereHas('truck',function($query){
                $query->where('owned_by',1);
            })->count();
            $third_driver = Driver::with('truck')->whereHas('truck',function($query){
                $query->where('owned_by',0);
            })->count();
            $contractor = Truck::where('owned_by',1)->count();
            $third = Truck::where('owned_by',0)->count();
            $customer_count = Customer::where('user_id',auth()->user()->id)->count();
            $order = Orders::where('hydrant_id',auth()->user()->hydrant->id)->count();
            $today_order = Orders::where('hydrant_id',auth()->user()->hydrant->id)->whereDay('created_at', '=', date('d'))->count();
            $today_gallon = Orders::with('truck_type_fun')->where('hydrant_id',auth()->user()->hydrant->id)->whereDay('created_at', '=', date('d'))->get();
            foreach($today_gallon as $row)
            {
                $expNum = explode(' ', $row->truck_type_fun->name);
                $today_gallon_count = $today_gallon_count + (int)$expNum[0];
            }
            $comm = Orders::with('customer')->whereHas('customer',function($query)
            {
                $query->where('standard',"Commercial");
            })->where('hydrant_id',auth()->user()->hydrant->id)->count();
            $gps = Orders::with('customer')->whereHas('customer',function($query)
            {
                $query->where('standard',"GPS");
            })->where('hydrant_id',auth()->user()->hydrant->id)->count();
            $today_comm = Orders::with('customer')->whereHas('customer',function($query)
            {
                $query->where('standard',"Commercial");
            })->where('hydrant_id',auth()->user()->hydrant->id)->whereDay('created_at', '=', date('d'))->count();
            $today_gps = Orders::with('customer')->whereHas('customer',function($query)
            {
                $query->where('standard',"GPS");
            })->where('hydrant_id',auth()->user()->hydrant->id)->whereDay('created_at', '=', date('d'))->count();
            $hydCount = Hydrants::where('user_id',auth()->user()->id)->count();
            $hydrants = Hydrants::where('user_id',auth()->user()->id)->with('vehicles')->get();
            // $today = Orders::where('hydrant_id',auth()->user()->hydrant->id)->whereDay('created_at', now()->day)->get();
            $today = Hydrants::with('vehicles','todayorders','todayorders.customer')->where('user_id',auth()->user()->id)->get();

        }
        // dd($today->toArray());
        $result[] = ['Clicks','Viewers'];
        foreach ($hydrants as $key => $value) {
            $result[++$key] = [$value->name, (int)count($value->orders)];
        }

        $result_today[] = ['Clicks','Viewers'];
        foreach ($today as $key => $value) {
            // if((int)count($value->todayorders) != 0)
            // {
                $result_today[++$key] = [$value->name, (int)count($value->todayorders)];
            // }
        }

        $result2[] = ['Clicks','Viewers'];
        foreach ($hydrants as $key => $value) {
            $result2[++$key] = [$value->name, (int)count($value->vehicles)];
        }
        // dd($result);
        if($request->has('status') && $request->status == "api")
        {
            $data['result'] = $result;
            $data['newresult'] = $result2;

            $data['contractor_driver'] = $contractor_driver;
            $data['third_driver'] = $third_driver;

            $data['contractor'] = $contractor;
            $data['third'] = $third;

            $data['hydrants'] = $hydrants;
            $data['result_today'] = $result_today;
            $data['today_order'] = $today_order;
            $data['today_gallon_count'] = $today_gallon_count;
            $data['today_comm'] = $today_comm;
            $data['today_gps'] = $today_gps;
            return $data;
        }
        return view('home',compact('customer_count','today_gallon_count','today_order','today_comm','today_gps','comm','gps','vehicle','driver','hydCount','hydrants','result','result2','order','contractor_driver','third_driver','contractor','third'));
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
        //new
        $driver->lic_father_name = $request->lic_father_name;
        $driver->lic_address = $request->lic_address;
        $driver->lic_region = $request->lic_region;
        $driver->lic_identity_mark = $request->lic_identity_mark;
        $driver->cc_issue_date = $request->cc_issue_date;
        $driver->cc_police_station = $request->cc_police_station;
        $driver->hc_issue_date = $request->hc_issue_date;
        $driver->hc_hospital_name = $request->hc_hospital_name;

        //End
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
        //new
        $driver->lic_father_name = $request->lic_father_name;
        $driver->lic_address = $request->lic_address;
        $driver->lic_region = $request->lic_region;
        $driver->lic_identity_mark = $request->lic_identity_mark;
        $driver->cc_police_station = $request->cc_police_station;
        $driver->hc_issue_date = $request->hc_issue_date;
        $driver->hc_hospital_name = $request->hc_hospital_name;

        //End
        $driver->nic_image = $this->NicImage($request->nic_image);
        $driver->expiry = $today;
        $driver->save();
        return redirect()->route('driver.list');
    }
    public function changeDriverActiveStatus(Request $request)
    {
        $driver = Driver::find($request->id);
        $driver->status = $request->status;
        $driver->save();
        return 1;
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
            'reg_region'        => 'required',
            'book_num'          => 'required',
            'father_name'       => 'required',
            'owner_address'     => 'required',
            'owner_cnic'        => 'required',
            'reg_date'          => 'required',
            'class_of_type'     => 'required',
            'cylinders_count'   => 'required',
            'body_type'         => 'required',
            'horse_power'       => 'required',
            'seating_capacity'  => 'required',
            'num_description'   => 'required',
            'front_excel'       => 'required',
            'rear_excel'        => 'required',
            'any_other'         => 'required',
            'cfra_no'           => 'required',
            'issue_date'        => 'required',
            'expiry_date'        => 'required',
			'commercial_license'   =>  'required|image|max:2048',
            'road_permit'     	=>  'required|image|max:2048',
            'doc_running_part'     =>  'required|image|max:2048',
            'cabin_picture'     =>  'required|image|max:2048',
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
            //Addition Start
            $truck->reg_region = $request->reg_region;
            $truck->book_num = $request->book_num;
            $truck->father_name = $request->father_name;
            $truck->owner_address = $request->owner_address;
            $truck->owner_cnic = $request->owner_cnic;
            $truck->reg_date = $request->reg_date;
            $truck->class_of_type = $request->class_of_type;
            $truck->cylinders_count = $request->cylinders_count;
            $truck->body_type = $request->body_type;
            $truck->horse_power = $request->horse_power;
            $truck->seating_capacity = $request->seating_capacity;
            $truck->num_description = $request->num_description;
            $truck->front_excel = $request->front_excel;
            $truck->rear_excel = $request->rear_excel;
            $truck->any_other = $request->any_other;
            $truck->cfra_no = $request->cfra_no;
            $truck->issue_date = $request->issue_date;
            $truck->expiry_date = $request->expiry_date;

            //Addition End

            //Addition Start
            if($request->has('paper_image'))
            {
                $loc = 'image'.'/'.'commercial_license/';
                $truck->commercial_license = $this->vehicle_docs($request->commercial_license,$loc);
            }
            if($request->has('vehicle_image'))
            {
                $loc = 'image'.'/'.'road_permit/';
                $truck->road_permit = $this->vehicle_docs($request->road_permit,$loc);
            }
            if($request->has('vehicle_fitness'))
            {
                $loc = 'image'.'/'.'doc_running_part/';
                $truck->doc_running_part = $this->vehicle_docs($request->doc_running_part,$loc);
            }
            if($request->has('vehicle_fitness'))
            {
                $loc = 'image'.'/'.'cabin_picture/';
                $truck->cabin_picture = $this->vehicle_docs($request->cabin_picture,$loc);
            }
            //Addition End
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
            'truck_num'   		=>  'required|string|unique:trucks,truck_num,'.$request->truck_num,
            'truck_type' 		=>  'required|numeric|exists:truck_types,id',
			'owned_by'          =>  'required|numeric|in:0,1',
            'reg_region'        => 'required',
            'book_num'          => 'required',
            'father_name'       => 'required',
            'owner_address'     => 'required',
            'owner_cnic'        => 'required',
            'reg_date'          => 'required',
            'class_of_type'     => 'required',
            'cylinders_count'   => 'required',
            'body_type'         => 'required',
            'horse_power'       => 'required',
            'seating_capacity'  => 'required',
            'num_description'   => 'required',
            'front_excel'       => 'required',
            'rear_excel'        => 'required',
            'any_other'         => 'required',
            'cfra_no'           => 'required',
            'issue_date'        => 'required',
            'expiry_date'        => 'required',
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
            //Addition Start
            $truck->reg_region = $request->reg_region;
            $truck->book_num = $request->book_num;
            $truck->father_name = $request->father_name;
            $truck->owner_address = $request->owner_address;
            $truck->owner_cnic = $request->owner_cnic;
            $truck->reg_date = $request->reg_date;
            $truck->class_of_type = $request->class_of_type;
            $truck->cylinders_count = $request->cylinders_count;
            $truck->body_type = $request->body_type;
            $truck->horse_power = $request->horse_power;
            $truck->seating_capacity = $request->seating_capacity;
            $truck->num_description = $request->num_description;
            $truck->front_excel = $request->front_excel;
            $truck->rear_excel = $request->rear_excel;
            $truck->any_other = $request->any_other;
            $truck->cfra_no = $request->cfra_no;
            $truck->issue_date = $request->issue_date;
            $truck->expiry_date = $request->expiry_date;

            //Addition End
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
            //Addition Start
            if($request->has('paper_image'))
            {
                $loc = 'image'.'/'.'commercial_license/';
                $truck->commercial_license = $this->vehicle_docs($request->commercial_license,$loc);
            }
            if($request->has('vehicle_image'))
            {
                $loc = 'image'.'/'.'road_permit/';
                $truck->road_permit = $this->vehicle_docs($request->road_permit,$loc);
            }
            if($request->has('vehicle_fitness'))
            {
                $loc = 'image'.'/'.'doc_running_part/';
                $truck->doc_running_part = $this->vehicle_docs($request->doc_running_part,$loc);
            }
            if($request->has('vehicle_fitness'))
            {
                $loc = 'image'.'/'.'cabin_picture/';
                $truck->cabin_picture = $this->vehicle_docs($request->cabin_picture,$loc);
            }
            //Addition End
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
