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
        $reportData = Orders::with(['hydrant', 'billing.truck.truckCap'])->whereHas('billing')
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

                $orders = Orders::with(['hydrant', 'billing.truck.truckCap'])
                ->whereHas('billing.truck.truckCap')
                ->where('hydrant_id', $hydrant->id)
                ->whereBetween('created_at', [$dateS,$dateE])
                ->get();

                // print_r($order->toArray());

            // dd($orders->toArray());
                foreach ($orders as $order) {
                    // dd($order->billing->truck->truckCap->toArray());
                    if($order != "[]")
                    {
                        $capacity = $order->billing->truck->truckCap->sum('name');
                    }
                    else
                    {
                        $capacity = 0;
                    }
                    // $sumOfTruckCapNames will contain the sum of truckCap names for each order
                }
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
}
