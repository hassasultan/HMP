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
use Illuminate\Support\Facades\DB;


class ReportsController extends Controller
{
    //
    public function report()
    {
        $truck = Truck::all();
        $capacity = Truck_type::get();
        $hydrants = Hydrants::get();
        $order = Orders::with('truck_type_fun')->get();
        $billing = Billings::get();
        $customers = Customer::get();
        return view('pages.reports.index', compact('truck', 'capacity', 'hydrants', 'order', 'billing', 'customers'));
    }
    public function generate_report(Request $request)
    {
        $dateS = $request->from_date;
        $dateE = $request->to_date;
        if ($request->hydrant_id != "all") {
            $hydrants_name = Hydrants::find($request->hydrant_id)->name;
        } else {
            $hydrants_name = "All";
        }
        $town = null;
        $type = null;
        $prio = null;
        $source = null;
        $consumer = null;
        if ($request->hydrant_id != "all") {
            $hydrants = Hydrants::where('id',$request->hydrant_id)->get();
        } else {
            $hydrants = Hydrants::get();
        }
        $reportData = Orders::with(['hydrant', 'billing.truck.truckCap'])
        ->whereBetween('orders.created_at', [$dateS,$dateE])
        ->whereHas('billing')
            ->select('orders.*') // Select all columns from the orders table
            // ->groupBy('orders.id') // Group by the primary key of the orders table
            ->orderBy('orders.created_at')
            ->get();
        // dd($reportData->toArray());
        // Initialize an empty array to store the report data
        $report = [];

        // Loop through the results to populate the report array
        foreach ($reportData as $order) {
            // Extract the order date
            $date = $order->created_at;

            // Initialize an array for the capacities under each hydrant
            $hydrantCapacities = [];

            // Loop through each hydrant to calculate the capacity for that hydrant on the given date
            foreach ($hydrants as $hydrant) {
                // Calculate the total capacity for the hydrant on the given date
                // $capacity = Orders::where('hydrant_id', $hydrant->id)
                //     ->where('created_at', $date)
                //     ->leftJoin('truck', 'truck.id', '=', 'orders.truck_id')
                //     ->sum('truck.capacity');

                $capacity = Orders::with(['hydrant', 'billing','truck_type_fun'])
                ->where('orders.created_at', $date)
                ->whereHas('billing')
                ->where('hydrant_id', $hydrant->id)
                ->join('truck_types', 'orders.truck_type', '=', 'truck_types.id')
                ->sum('truck_types.name');

                // print_r($order->toArray());
                // Add the capacity to the array for this hydrant
                $hydrantCapacities[$hydrant->name] = $capacity;
            }
            // dd($hydrantCapacities);
            // Add the date and capacities to the report array
            $report[] = [
                'Date' => $date,
                // Merge the calculated capacities with hydrant names
                $hydrantCapacities,
            ];
        }
        // dd($report);
        return view('pages.reports.report', compact('dateS', 'dateE', 'hydrants_name', 'hydrants','report'));
        // return view('pages.reports.report');
    }
    public function generate_report_standard(Request $request)
    {
        $startDate = $request->input('from_date');
        $endDate = $request->input('to_date');
        $hydrantId = $request->input('hydrant_id');
        $hydrants_name = Hydrants::find($request->hydrant_id)->name;

        // Subquery to calculate counts for each standard
        $subquery = DB::table('orders as o')
            ->join('customers as c', 'o.customer_id', '=', 'c.id')
            ->select(
                'o.created_at AS order_date',
                'c.standard',
                DB::raw('COUNT(o.id) AS order_count')
            )
            ->whereBetween('o.created_at', [$startDate, $endDate])
            ->where('o.hydrant_id', $hydrantId)
            ->groupBy('o.created_at', 'c.standard');

        // Main query to select maximum counts for each standard
        $reportData = DB::table(DB::raw("({$subquery->toSql()}) as sub"))
            ->mergeBindings($subquery) // Bind subquery parameters
            ->select(
                'order_date',
                DB::raw('MAX(CASE WHEN standard = "Commercial" THEN order_count ELSE 0 END) AS "Commercial"'),
                DB::raw('MAX(CASE WHEN standard = "Online (GPS)" THEN order_count ELSE 0 END) AS "Online (GPS)"'),
                DB::raw('MAX(CASE WHEN standard = "Gps ( billing )" THEN order_count ELSE 0 END) AS "Gps ( billing )"'),
                DB::raw('MAX(CASE WHEN standard = "Gps ( care off )" THEN order_count ELSE 0 END) AS "Gps ( care off )"'),
                DB::raw('MAX(CASE WHEN standard = "GRATIS" THEN order_count ELSE 0 END) AS "GRATIS"'),
                DB::raw('MAX(CASE WHEN standard = "Pak rangers" THEN order_count ELSE 0 END) AS "Pak rangers"'),
                DB::raw('MAX(CASE WHEN standard = "P.A.F korangi creek" THEN order_count ELSE 0 END) AS "P.A.F korangi creek"'),
                DB::raw('MAX(CASE WHEN standard = "Dc quota" THEN order_count ELSE 0 END) AS "Dc quota"'),
                DB::raw('MAX(CASE WHEN standard = "Govt. vehicle" THEN order_count ELSE 0 END) AS "Govt. vehicle"')
            )
            ->groupBy('order_date')
            ->orderBy('order_date', 'asc')
            ->get();

        $standards = DB::table('customers')
            ->distinct()
            ->pluck('standard');
        // dd($reportData);









        // $dateS = $request->from_date;
        // $dateE = $request->to_date;
        // $standards = Hydrants::find($request->hydrant_id)->name;

        // $town = null;
        // $type = null;
        // $prio = null;
        // $source = null;
        // $consumer = null;
        // if ($request->hydrant_id != "all") {
        //     $hydrants = Hydrants::where('id',$request->hydrant_id)->get();
        // } else {
        //     $hydrants = Hydrants::get();
        // }
        // $reportData = Orders::with(['hydrant', 'billing.truck.truckCap'])
        // ->whereBetween('orders.created_at', [$dateS,$dateE])
        // ->whereHas('billing')
        //     ->select('orders.*') // Select all columns from the orders table
        //     // ->groupBy('orders.id') // Group by the primary key of the orders table
        //     ->orderBy('orders.created_at')
        //     ->get();
        // // dd($reportData->toArray());
        // // Initialize an empty array to store the report data
        // $report = [];

        // // Loop through the results to populate the report array
        // foreach ($reportData as $order) {
        //     // Extract the order date
        //     $date = $order->created_at;

        //     // Initialize an array for the capacities under each hydrant
        //     $hydrantCapacities = [];

        //     // Loop through each hydrant to calculate the capacity for that hydrant on the given date
        //     foreach ($hydrants as $hydrant) {
        //         // Calculate the total capacity for the hydrant on the given date
        //         // $capacity = Orders::where('hydrant_id', $hydrant->id)
        //         //     ->where('created_at', $date)
        //         //     ->leftJoin('truck', 'truck.id', '=', 'orders.truck_id')
        //         //     ->sum('truck.capacity');

        //         $capacity = Orders::with(['hydrant', 'billing','truck_type_fun'])
        //         ->where('orders.created_at', $date)
        //         ->whereHas('billing')
        //         ->where('hydrant_id', $hydrant->id)
        //         ->join('truck_types', 'orders.truck_type', '=', 'truck_types.id')
        //         ->sum('truck_types.name');

        //         // print_r($order->toArray());
        //         // Add the capacity to the array for this hydrant
        //         $hydrantCapacities[$hydrant->name] = $capacity;
        //     }
        //     // dd($hydrantCapacities);
        //     // Add the date and capacities to the report array
        //     $report[] = [
        //         'Date' => $date,
        //         // Merge the calculated capacities with hydrant names
        //         $hydrantCapacities,
        //     ];
        // }
        // dd($report);
        return view('pages.reports.daily-report', compact('startDate', 'endDate', 'hydrants_name','standards','reportData'));
        // return view('pages.reports.report');
    }

    public function generate_hydrants_reports(Request $request)
    {
        $dateS = $request->from_date;
        $dateE = $request->to_date;
        $hydrants = Hydrants::with('orders','orders.billing')->whereHas('orders.billing',function($query)use($dateS, $dateE) {
            $query->whereBetween('created_at', [$dateS,$dateE]);
        });
        if(auth()->user()->role == 1)
        {
            if ($request->hydrant_id != "all")
            {
                $hydrants = $hydrants->where('id',$request->hydrant_id)->get();
            } else {
                $hydrants = $hydrants->get();
            }
        }
        else
        {
            $hydrants = $hydrants->where('id',auth()->user()->hydrant->id)->get();
        }
        // dd($hydrants->toArray());
        return view('pages.reports.hydrants-report', compact('dateS', 'dateE','hydrants'));
    }
}
