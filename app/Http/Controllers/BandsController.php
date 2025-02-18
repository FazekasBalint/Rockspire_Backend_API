<?php

namespace App\Http\Controllers;

use App\Models\Bands;
use Illuminate\Http\Request;


class BandsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Bands::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image_url' => 'nullable|string',
            'description' => 'nullable|string',
            'duration' => 'required',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Bands $bands)
    {
        return response()->json($band);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBandsRequest $request, Bands $bands)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bands $bands)
    {
        //
    }
}
