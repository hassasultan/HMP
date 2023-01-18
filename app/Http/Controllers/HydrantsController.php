<?php

namespace App\Http\Controllers;

use App\Models\Billings;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Truck_type;
use App\Models\Truck;
use App\Models\Driver;
use App\Models\Hydrants;
use Haruncpi\LaravelIdGenerator\IdGenerator;
class HydrantsController extends Controller
{
    public function index()
    {
        $hyd = Hydrants::all();
        return view('pages.hydrants.index',compact('hyd'));
    }
    public function create()
    {
        return view('pages.hydrants.create');
    }
    public function store(Request $request)
    {
        $hyd = Hydrants::create($request->all());
        return redirect()->route('hydrant.list');
    }
    public function edit($id)
    {
        $hyd = Hydrants::find($id);
        return view('pages.hydrants.edit',compact('hyd'));
    }
    public function update(Request $request,$id)
    {
        $hyd = Hydrants::find($id)->update($request->all());
        return redirect()->route('hydrant.list');
    }
 
}