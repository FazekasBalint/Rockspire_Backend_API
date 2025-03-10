<?php

namespace App\Http\Controllers;

use App\Models\Camping;
use App\Http\Requests\StoreCampingRequest;
use App\Http\Requests\UpdateCampingRequest;

class CampingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Camping::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCampingRequest $request)
    {
        $camping = Camping::create($request->validated());

        return response()->json([
            'message' => 'Camping created successfully!',
            'camping' => $camping,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Camping $camping)
    {
        return response()->json(Camping::findOrFail($camping));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCampingRequest $request, Camping $camping)
    {
        $camping = Camping::findOrFail($camping);
        $camping->update($request->validated());

        return response()->json([
            'message' => 'Camping updated successfully!',
            'camping' => $camping,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $camping = Camping::find($id);

        if (!$camping) {
            return response()->json(['message' => 'Camping not found!'], 404);
        }

        $camping->delete();
        return response()->json(['message' => 'Camping deleted successfully!']);
    }
}
