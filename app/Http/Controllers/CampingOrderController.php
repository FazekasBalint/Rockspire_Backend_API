<?php

namespace App\Http\Controllers;

use App\Models\CampingOrder;
use App\Http\Requests\StoreCampingOrderRequest;
use App\Http\Requests\UpdateCampingOrderRequest;
use App\Models\Camping;
use App\Models\OrdersCampingConnection;
use Illuminate\Container\Attributes\Auth;

class CampingOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = CampingOrder::all();
        return response()->json($orders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCampingOrderRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->cannot('create', CampingOrder::class)) {
            return response()->json(['message' => 'You are not authorized to create a camping order'], 403);
        }

        $validated = $request->validated();
        $validated['user_id'] = $user->id;
        $order = CampingOrder::create($validated);

        return response()->json($order, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(CampingOrder $campingOrder)
    {
        $order = CampingOrder::find($campingOrder);
        if (!$order) {
            return response()->json(['message' => 'Camping order not found'], 404);
        }

        return response()->json($order);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CampingOrder $campingOrder)
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->cannot('delete', $campingOrder)) {
            return response()->json(['message' => 'You are not authorized to delete this order'], 403);
        }

        $campingOrder->delete();
        return response()->noContent();
    }
}
