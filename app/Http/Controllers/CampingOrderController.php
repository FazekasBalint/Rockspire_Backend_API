<?php

namespace App\Http\Controllers;

use App\Models\CampingOrder;
use App\Http\Requests\StoreCampingOrderRequest;
use App\Http\Requests\UpdateCampingOrderRequest;
use App\Models\Camping;
use Illuminate\Support\Facades\Auth;

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
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $validated = $request->validated();
        $order = CampingOrder::create(['user_id' => $user->id]);
        foreach ($validated['campings'] as $camping) {
            $campingItem = Camping::find($camping['camping_id']);
            if (!$campingItem) {
                return response()->json(['message' => 'Invalid camping ID'], 400);
            }

            $campingItem->availability -= $camping['quantity'];
            $campingItem->save();

            $order->campings()->attach($camping['camping_id'], [
                'quantity' => $camping['quantity'],
                'totalprice' => $camping['quantity'] * $campingItem->price,
            ]);
        }
        return response()->json([
            'message' => 'Camping order created successfully',
            'order' => $order
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($userId)
    {
        $campingOrders = CampingOrder::with(['campings' => function ($query) {
            $query->withPivot('quantity', 'totalprice');
        }])->where('user_id', $userId)->get();
        if ($campingOrders->isEmpty()) {
            return response()->json(['message' => 'No camping orders found for this user.'], 404);
        }
        $formattedData = $campingOrders->map(function ($order) {
            return [
                'id' => $order->id,
                'user_id' => $order->user_id,
                'created_at' => $order->created_at,
                'updated_at' => $order->updated_at,
                'campings' => $order->campings->map(function ($camping) {
                    return [
                        'id' => $camping->id,
                        'type' => $camping->type,
                        'price' => $camping->price,
                        'availability' => $camping->availability,
                        'description' => $camping->description,
                        'quantity' => $camping->pivot->quantity,
                        'totalprice' => $camping->pivot->totalprice
                    ];
                })
            ];
        });

        return response()->json($formattedData);
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
