<?php

namespace App\Http\Controllers;

use App\Models\TicketOrder;
use App\Http\Requests\StoreTicketOrderRequest;
use App\Http\Requests\UpdateTicketOrderRequest;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

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
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Jogosulatlan'], 401);
        }
        $validated = $request->validated();
        $order = TicketOrder::create(['user_id' => $user->id]);
        foreach ($validated['tickets'] as $ticket) {
            $ticketModel = Ticket::find($ticket['ticket_id']);

            if (!$ticketModel) {
                return response()->json(['message' => 'Hibás jegy ID'], 400);
            }

            $ticketModel->availability -= $ticket['quantity'];
            $ticketModel->save();

            $order->tickets()->attach($ticket['ticket_id'], [
                'quantity' => $ticket['quantity'],
                'totalprice' => $ticket['quantity'] * $ticketModel->price
            ]);
        }
        return response()->json(['message' => 'Jegy rendelés sikeresen létrehozva', 'order' => $order], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($userId)
    {
        $ticketOrders = TicketOrder::with(['tickets' => function ($query) {
            $query->withPivot('quantity', 'totalprice');
        }])->where('user_id', $userId)->get();

        if ($ticketOrders->isEmpty()) {
            return response()->json(['message' => 'Nem található jegy rendelés ehhez a felhasználóhoz.'], 404);
        }

        $formattedData = $ticketOrders->map(function ($order) {
            return [
                'id' => $order->id,
                'user_id' => $order->user_id,
                'created_at' => $order->created_at,
                'updated_at' => $order->updated_at,
                'tickets' => $order->tickets->map(function ($ticket) {
                    return [
                        'id' => $ticket->id,
                        'type' => $ticket->type,
                        'price' => $ticket->price,
                        'availability' => $ticket->availability,
                        'description' => $ticket->description,
                        'quantity' => $ticket->pivot->quantity,
                        'totalprice' => $ticket->pivot->totalprice
                    ];
                })
            ];
        });

        return response()->json($formattedData);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketOrder $ticketOrder)
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->cannot('delete', $ticketOrder)) {
            return response()->json(['message' => 'Nincs jogosultsága hogy törölje ezt a rendelést'], 403);
        }

        $ticketOrder->delete();
        return response()->noContent();
    }



    public function getMyOrders()
    {
        $user = Auth::user();
        $orders = TicketOrder::with(['tickets'])
                    ->where('user_id', $user->id)
                    ->get();
        return response()->json([
            'orders' => $orders
        ]);
    }

    }

