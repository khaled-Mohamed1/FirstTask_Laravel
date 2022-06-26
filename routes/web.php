<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
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
    return view('welcome');
});


// Route::get('order', [OrderController::class, 'index'])->name('order');
// Route::post('order', [OrderController::class, 'index'])->name('order.store');

Route::controller(OrderController::class)->group(function () {
    Route::get('order', 'index')->name('order');
    Route::post('order/store', 'store')->name('order.store');
    Route::get('order/update/{id}', 'update')->name('order.update');
    Route::delete('order/destroy/{id}', 'destroy')->name('order.destroy');
});
