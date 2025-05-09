<?php

namespace App\Http\Controllers;

use App\Models\Band;
use App\Http\Requests\StoreBandRequest;
use App\Http\Requests\UpdateBandRequest;

class BandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bands=Band::with('days')->get();
        return response()->json($bands);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBandRequest $request)
    {
        $band = Band::create($request->validated());

        return response()->json([
            'message' => 'Banda sikersen hozzáadva!',
            'band' => $band,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Band $band)
    {
        $band->load('days');
        return response()->json($band);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBandRequest $request, Band $band)
    {
        $band->update($request->validated());

        return response()->json([
            'message' => 'Banda sikersen frissítve!',
            'band' => $band,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Band $band)
    {
        $band->delete();
        return response()->json(['message'=>'Banda sikeresen törölve']);
    }
}
