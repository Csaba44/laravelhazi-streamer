<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Platform;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $platforms = Platform::with("streamers")->get();
        return response()->json($platforms, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                "name" => "required|string",
            ],
            [
                "required" => ":attribute megadása szükséges.",
                "string" => ":attribute mező szöveges kell legyen",
            ],
            [
                "name" => "A platform név",
            ]
        );

        $platform = Platform::create($validated);

        return response()->json(["message" => "Platform hozzáadása sikeres.", "platform" => $platform], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Platform $platform)
    {
        $validated = $request->validate(
            [
                "name" => "required|string"
            ],
            [
                "required" => ":attribute megadása szükséges.",
                "string" => ":attribute mező szöveges kell legyen"
            ],
            [
                "name" => "A név"
            ]
        );

        $platform->update($validated);

        return response()->json(["message" => "A platform sikeresen módosítva."], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Platform $platform)
    {
        $platform->delete();
        return response()->json(["message" => "Platform sikeresen törölve"], 200);
    }
}
