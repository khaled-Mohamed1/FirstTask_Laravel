<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Order;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = Driver::get();
        $orders = Order::latest()->paginate(3);
        return view('order', compact('drivers', 'orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'quantity' => 'required',
            'item' => 'required',
            'driver_id' => 'required',
            'kind' => 'required'
        ]);

        if (!$validator->fails()) {
            Order::create([
                'driver_id' => $request->driver_id,
                'item' => $request->item,
                'quantity' => $request->quantity,
                'kind' => $request->kind,
                'condition' => $request->condition,
            ]);
        }

        return redirect()->back()->with('success', 'product updated successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::findorFail($id);
        $order->update([
            'condition' => 'تم الإيقاف',
        ]);
        return redirect()->back()->with('success', 'product deleted successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::findorFail($id)->delete();
        return redirect()->back()->with('success', 'product deleted successfully');
    }
}
