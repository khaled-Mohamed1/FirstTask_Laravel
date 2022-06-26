<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Order;
use App\Http\Controllers\OrderApiController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/order ', function () {
    return Order::all();
});


Route::controller(OrderApiController::class)->group(function () {
    Route::get('order', 'index');
    Route::post('order', 'store');
    Route::put('order/{id}', 'update');
    Route::delete('order/{id}', 'destroy');
});
