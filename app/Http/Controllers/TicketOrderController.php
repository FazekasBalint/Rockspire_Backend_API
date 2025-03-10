<?php

namespace App\Http\Controllers;

use App\Models\TicketOrder;
use App\Http\Requests\StoreTicketOrderRequest;
use App\Http\Requests\UpdateTicketOrderRequest;
use Illuminate\Container\Attributes\Auth;

class TicketOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ticketOrders=TicketOrder::all();
        return response()->json($ticketOrders);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketOrderRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->cannot('create', TicketOrder::class)) {
            return response()->json(['message' => 'You are not authorized to create a ticket order'], 403);
        }

        $validated = $request->validated();
        $validated['user_id'] = $user->id;
        $order = TicketOrder::create($validated);

        return response()->json($order, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TicketOrder $ticketOrder)
    {
        $order = TicketOrder::find($ticketOrder);
        if (!$order) {
            return response()->json(['message' => 'Ticket order not found'], 404);
        }

        return response()->json($order);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketOrder $ticketOrder)
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->cannot('delete', $ticketOrder)) {
            return response()->json(['message' => 'You are not authorized to delete this order'], 403);
        }

        $ticketOrder->delete();
        return response()->noContent();
    }
    }

