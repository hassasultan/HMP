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

class ReportsController extends Controller
{
    //
    public function report()
    {
        $town = Town::all();
        $type = ComplaintType::get();
        $prio = Priorities::get();
        $source = Complaints::get()->groupBy('source');
        return view('pages.reports.index',compact('town','type','prio','source'));

    }
    public function generate_report(Request $request)
    {
        $dateS = $request->from_date;
        $dateE = $request->to_date;
        $town = null;
        $type = null;
        $prio = null;
        $source = null;
        $consumer = null;
        // $comp = Complaints::with('type')->whereDate('created_at','>=',$dateS)->whereDate('created_at','<=',$dateE)->orderBy('created_at')
        // ->get()->groupBy('type_id');
        // $comp = Complaints::with('type')
        //     ->whereDate('created_at','>=',$dateS)
        //     ->whereDate('created_at','<=',$dateE)
        //     ->orderBy('type_id','ASC')
        //     ->get()
        //     ->groupBy([ function ($post) {
        //         return $post->created_at->format('Y-m-d');
        //     },'type_id']);
        $complaints = Complaints::with('type','customer')
        ->select('type_id', DB::raw('date(created_at) as date'), DB::raw('count(*) as num_complaints'))
        ->whereBetween('created_at', [$dateS, $dateE]);
        if($request->has('town_id'))
        {
            $complaints = $complaints->where('town_id',$request->town_id);
            $town = Town::find($request->town_id);
            // dd($town->toArray());
        }
        if($request->has('type_id'))
        {
            $complaints = $complaints->where('type_id',$request->type_id);
            $type = ComplaintType::find($request->type_id);
            // dd($town->toArray());
        }
        if($request->has('prio_id'))
        {
            $complaints = $complaints->where('prio_id',$request->prio_id);
            $prio = Priorities::find($request->prio_id);
            // dd($town->toArray());
        }
        if($request->has('customer_id'))
        {
            $cust = $request->customer_id;
            $complaints = $complaints->WhereHas('customer',function($query)use($cust){
                $query->where('customer_id',$cust);
            })->orwhere('customer_num',$request->customer_id);
            $consumer = $cust;
            // dd($town->toArray());
        }
        if($request->has('source'))
        {
            if($request->source != "all")
            {
                $complaints = $complaints->where('source',$request->source);
            }
            $source = $request->source;
            // dd($town->toArray());
        }
        $complaints = $complaints->groupBy('type_id', 'date')
        ->orderBy('date','ASC')
        ->get();

        // $type = ComplaintType::get();
        //     ->groupBy([function ($post) {
        //         return $post->created_at->format('Y-m-d');
        //     }, '']);

        // dd($comp);
        // dd($complaints->toArray());
        return view('pages.reports.report',compact('complaints','type','dateS','dateE','town','consumer','source','prio'));
    }
}
