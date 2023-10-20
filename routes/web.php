<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();
Route::prefix('/admin')->group(function () {
    Route::middleware('checkadmin')->group(function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('/driver-list', [App\Http\Controllers\HomeController::class, 'driver'])->name('driver.list');
        Route::get('create/driver', [App\Http\Controllers\HomeController::class, 'create'])->name('driver.create');
        Route::post('store/driver', [App\Http\Controllers\HomeController::class, 'driverStore'])->name('driver.store');
        Route::get('edit/driver/{id}', [App\Http\Controllers\HomeController::class, 'edit'])->name('driver.edit');
        Route::post('update/driver/{id}', [App\Http\Controllers\HomeController::class, 'update'])->name('driver.update');

        Route::get('change/driver/active/status', [App\Http\Controllers\HomeController::class, 'changeDriverActiveStatus'])->name('change.driver.active.status');


        Route::get('generate/reports', [App\Http\Controllers\ReportsController::class, 'generate_report'])->name('generate.reports');
        Route::get('generate/reports/daily-reports', [App\Http\Controllers\ReportsController::class, 'generate_report_standard'])->name('generate.report.standard');

        //users

        Route::resource('/user-management', UserController::class);


        Route::get('/truck-list', [App\Http\Controllers\HomeController::class, 'truck'])->name('truck.list');
        // Route::get('create/truck', [App\Http\Controllers\HomeController::class, 'TruckCreate'])->name('truck.create');
        // Route::post('store/truck', [App\Http\Controllers\HomeController::class, 'truckStore'])->name('truck.store');
        // Route::get('qrcode/{id}', [App\Http\Controllers\HomeController::class, 'generateQR'])->name('generate.qr');
        // Route::get('edit/truck/{id}', [App\Http\Controllers\HomeController::class, 'TruckEdit'])->name('truck.edit');
        // Route::post('update/truck/{id}', [App\Http\Controllers\HomeController::class, 'TruckUpdate'])->name('truck.update');


        //truck_type
        Route::get('/truck_type-list', [App\Http\Controllers\HomeController::class, 'truckTypeIndex'])->name('truck_type.list');
        Route::get('create/truck_type', [App\Http\Controllers\HomeController::class, 'truckTypeCreate'])->name('truck_type.create');
        Route::post('store/truck_type', [App\Http\Controllers\HomeController::class, 'truckTypeStore'])->name('truck_type.store');
        Route::get('edit/truck_type/{id}', [App\Http\Controllers\HomeController::class, 'truckTypeEdit'])->name('truck_type.edit');
        Route::post('update/truck_type/{id}', [App\Http\Controllers\HomeController::class, 'truckTypeUpdate'])->name('truck_type.update');

        //Order
        Route::get('/order-list', [App\Http\Controllers\OrderController::class, 'index'])->name('order.list');
        // Route::get('create/order', [App\Http\Controllers\OrderController::class, 'create'])->name('order.create');
        // Route::post('store/order', [App\Http\Controllers\OrderController::class, 'store'])->name('order.store');

        //Billing
        Route::get('/billing-list', [App\Http\Controllers\OrderController::class, 'billingindex'])->name('billing.list');
        // Route::get('create/billing', [App\Http\Controllers\OrderController::class, 'billingcreate'])->name('billing.create');
        // Route::post('store/billing', [App\Http\Controllers\OrderController::class, 'billingstore'])->name('billing.store');


        //Hydrants
        Route::get('/hydrant-list', [App\Http\Controllers\HydrantsController::class, 'index'])->name('hydrant.list');
        Route::get('create/hydrant', [App\Http\Controllers\HydrantsController::class, 'create'])->name('hydrant.create');
        Route::get('edit/hydrant/{id}', [App\Http\Controllers\HydrantsController::class, 'edit'])->name('hydrant.edit');
        Route::POST('update/hydrant/{id}', [App\Http\Controllers\HydrantsController::class, 'update'])->name('hydrant.update');
        Route::post('store/hydrant', [App\Http\Controllers\HydrantsController::class, 'store'])->name('hydrant.store');

        Route::get('create/truck', [App\Http\Controllers\HomeController::class, 'TruckCreate'])->name('truck.create');
        Route::post('store/truck', [App\Http\Controllers\HomeController::class, 'truckStore'])->name('truck.store');
        Route::get('edit/truck/{id}', [App\Http\Controllers\HomeController::class, 'TruckEdit'])->name('truck.edit');
        Route::post('update/truck/{id}', [App\Http\Controllers\HomeController::class, 'TruckUpdate'])->name('truck.update');
    });
});
Route::get('vehicle/details/{id}', [App\Http\Controllers\HomeController::class, 'vehicleDetails'])->name('vehicle.details');
Route::get('billing/details/{id}', [App\Http\Controllers\OrderController::class, 'billingReciept'])->name('billing.details');

Route::middleware('auth')->group(function () {

    Route::get('reports', [App\Http\Controllers\ReportsController::class, 'report'])->name('reports');
    Route::get('hydrants/reports/orders', [App\Http\Controllers\ReportsController::class, 'generate_hydrants_reports'])->name('generate.report.hydrant.orders');



    Route::get('/get/ots/order-list', [App\Http\Controllers\OrderController::class, 'get_ots_order'])->name('ots.order.list');
    Route::get('qrcode/{id}', [App\Http\Controllers\HomeController::class, 'generateQR'])->name('generate.qr');
    Route::get('create/order', [App\Http\Controllers\OrderController::class, 'create'])->name('order.create');
    Route::post('store/order', [App\Http\Controllers\OrderController::class, 'store'])->name('order.store');
    Route::get('create/billing/{id}', [App\Http\Controllers\OrderController::class, 'billingcreate'])->name('billing.create');
    Route::get('edit/billing/{id}', [App\Http\Controllers\OrderController::class, 'billingedit'])->name('billing.edit');
    Route::post('store/billing', [App\Http\Controllers\OrderController::class, 'billingstore'])->name('billing.store');
    Route::post('update/billing/{id}', [App\Http\Controllers\OrderController::class, 'billingupdate'])->name('billing.update');
    Route::get('change/status/billing', [App\Http\Controllers\OrderController::class, 'changeBlillingStatus'])->name('billing.change.status');
    Route::resource('/customer-management', CustomerController::class);
    Route::get('generate/customer/report/{id}', [App\Http\Controllers\CustomerController::class, 'generate_report'])->name('generate.customer.report');

    Route::get('change/driver/status', [App\Http\Controllers\HomeController::class, 'changeDriverStatus'])->name('change.driver.status');
    Route::get('change/tanker/status', [App\Http\Controllers\HomeController::class, 'changeVehicleStatus'])->name('change.tanker.status');
    Route::get('change/customer/status', [App\Http\Controllers\CustomerController::class, 'changeStatus'])->name('change.customer.status');
    Route::post('/profile/update/password',[UserController::class,'updatePassword'])->name('user.profile.update');
    Route::get('/edit/profile', function () {
        return view('pages.profile');
    })->name('profile.update');


});


Route::prefix('/hydrant')->group(function () {
    Route::middleware(['checkhydrant'])->group(function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('hydrant.home');

        //truck
        Route::get('/truck-list', [App\Http\Controllers\HomeController::class, 'truck'])->name('hydrant.truck.list');


        //Order
        Route::get('/order-list', [App\Http\Controllers\OrderController::class, 'index'])->name('hydrant.order.list');


        //Billing
        Route::get('/billing-list', [App\Http\Controllers\OrderController::class, 'billingindex'])->name('hydrant.billing.list');


    });
});
