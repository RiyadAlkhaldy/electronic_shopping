<?php

namespace App\Http\Controllers\Api;

use App\Events\DeliveryLocationUpdatedEvent;
use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeliveryLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order = Order::where('id', $request->input('order_id'))->firstOrFail();
        $request->validate([
            'lat' => ['required', 'numeric'],
            'lng' => ['required', 'numeric']
        ]);
        $delivery = Delivery::create([
            'order_id' => $order->id,
            'status' => 'in-progress',
            'current_location' => DB::raw("point({$request->lat}, {$request->lng})"),
        ]);
        return Delivery::getDelivery($delivery->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $delivery = Delivery::getDelivery($id);
        return $delivery;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Delivery $delivery)
    {
        
        $request->validate([
            'lat' => ['required', 'numeric'],
            'lng' => ['required', 'numeric']
        ]);
        $delivery->update([
            'current_location' => DB::raw("point({$request->lat}, {$request->lng})"),
        ]);
        $delivery = Delivery::getDelivery($delivery->id);
        
        event(new DeliveryLocationUpdatedEvent($delivery->toArray()));
        return $delivery;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
