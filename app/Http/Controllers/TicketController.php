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
        $tickets=Ticket::all();
        return response()->json($tickets);
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
    public function update(UpdateTicketRequest $request, Ticket $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->update($request->validated());
        return response()->json(['message' => 'Ticket updated successfully', 'ticket' => $ticket]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $id)
    {
        $ticket = Ticket::find($id);
        $ticket->delete();
        return response()->json(['message' => 'Ticket deleted']);
    }
}
