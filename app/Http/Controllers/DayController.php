<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Http\Requests\StoreDayRequest;
use App\Http\Requests\UpdateDayRequest;

class DayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $day=Day::all();
        return response()->json($day);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDayRequest $request)
    {
        $day=Day::create($request->validated());
        return response()->json(['message'=>'Day created succesfully','ticket'=>$day],201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Day $day)
    {
        return response()->json(Day::findOrFail($day));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDayRequest $request, Day $day)
    {
        $day=Day::findOrFail($request);
        $day->update($request->validated());
        return response()->json(['message'=>'Day updated succesfully','day'=>$day]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Day $day)
    {
        $day=Day::findOrFail($day);
        $day->delete();
        return response()->json(['message'=>'Day has been deleted succesfully']);
    }
}
