<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/create/order',[App\Http\Controllers\OrderController::class,'create_ots_order']);
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

    Route::get('/get-truck/list', [HomeController::class, 'truck']);
    Route::post('/edit/{id}', [HomeController::class, 'TruckEdit']);
    Route::post('/update/truck/{id}', [HomeController::class, 'TruckUpdate']);

    Route::get('/get-driver/list', [HomeController::class, 'driver']);
    Route::post('/driver/edit/{id}', [HomeController::class, 'edit']);
    Route::post('/update/driver/{id}', [HomeController::class, 'update']);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
