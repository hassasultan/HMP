<?php

namespace App\Http\Controllers;

use App\Models\RegTrucks;
use App\Models\TruckTracking;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RegTrucksController extends Controller
{
    //
    public function index()
    {
        $regTrucks = RegTrucks::orderBy("created_at","desc")->paginate(20);
        return view("pages.register-truck.index",compact("regTrucks"));
    }
    public function truck_tracking_list()
    {
        $regTrucks = TruckTracking::orderBy("created_at","desc")->paginate(20);
        return view("pages.register-truck.index",compact("regTrucks"));
    }
    public function create()
    {
        return view("");
    }
    public function store(Request $request)
    {
        $this->validate($request, []);
        $regTruck = new RegTrucks();
        $regTruck->truck_id = $request->truck_id;
        $regTruck->save();
        return redirect()->back()->with("success","");
    }
    public function destroy($id)
    {
        $regTruck = RegTrucks::find($id); 
        $regTruck->delete();
        return redirect()->back()->with("success","Truck has been remove from tracking list...");
    }
}
