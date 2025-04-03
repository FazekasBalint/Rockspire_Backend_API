<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::with('days')->get();

        $ticketsData = $tickets->map(function ($ticket) {
            return [
                'id' => $ticket->id,
                'type' => $ticket->type,
                'availability' => $ticket->availability,
                'price' => $ticket->price,
                'description' => $ticket->description,
                'days' => $ticket->days->map(function ($day) {
                    return [
                        'id' => $day->id,
                        'date' => $day->date,
                    ];
                }),
            ];
        });
        return response()->json($ticketsData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        $ticket = Ticket::create($request->validated());
        $dayId = $request->input('day_id');
        if ($dayId) {
            $ticket->days()->attach($dayId);
        }
        return response()->json(['message' => 'Ticket created successfully', 'ticket' => $ticket], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $ticket->update($request->validated());
        return response()->json(['message' => 'Ticket updated successfully', 'ticket' => $ticket]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ticket = Ticket::find($id);
        if (!$ticket) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }
        $ticketOrders = $ticket->orders;
        foreach ($ticketOrders as $order) {
            $order->delete();
        }
        $ticket->delete();
        return response()->json(['message' => 'Ticket and related orders deleted']);
    }
}
