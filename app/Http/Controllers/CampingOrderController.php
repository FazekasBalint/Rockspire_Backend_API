<?php

namespace App\Http\Controllers;

use App\Models\CampingOrder;
use App\Http\Requests\StoreCampingOrderRequest;
use App\Http\Requests\UpdateCampingOrderRequest;
use App\Models\Camping;
use App\Models\OrdersCampingConnection;

class CampingOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(CampingOrder::with('campings')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCampingOrderRequest $request)
    {
        $order = CampingOrder::create(['user_id' => $request->user_id]);

        foreach ($request->campings as $camping) {
            $campingItem = Camping::findOrFail($camping['camping_id']);

            OrdersCampingConnection::create([
                'order_id' => $order->id,
                'camping_id' => $campingItem->id,
                'quantity' => $camping['quantity'],
                'totalprice' => $camping['quantity'] * $campingItem->price,
            ]);
        }

        return response()->json(['message' => 'Camping order created successfully', 'order' => $order], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(CampingOrder $campingOrder)
    {
        $order = CampingOrder::with('campings')->findOrFail($campingOrder);
        return response()->json($order);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CampingOrder $campingOrder)
    {
        $order = CampingOrder::findOrFail($campingOrder);
        $order->campings()->detach();
        $order->delete();

        return response()->json(['message' => 'Camping order deleted successfully!']);
    }
}
