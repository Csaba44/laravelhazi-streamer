<?php

namespace App\Http\Controllers;

use App\Models\Streamer;
use Illuminate\Http\Request;

class StreamerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $streamers = Streamer::orderBy('followers', 'ASC')->get();

        $min = $request->input('min');
        $max = $request->input('max');

        if ($min != null) {
            $streamers = Streamer::where('followers', '>=', $min)->get();
        } else if ($max != null) {
            $streamers = Streamer::where('followers', '<=', $max)->get();
        }

        return response()->json($streamers, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                "name" => "required|string|unique:streamers,name",
                "platform" => "sometimes|exists:platforms,name",
                "followers" => "prohibited",
            ],
            [
                "required" => ":attribute megadása szükséges.",
                "string" => ":attribute mező szöveges kell legyen",
                "unique" => ":attribute mező már létezik",
                "prohibited" => ":attribute mező nem adható meg",
            ],
            [
                "name" => "A streamer név",
                "platform" => "A platform név",
                "followers" => "A követők száma",
            ]
        );

        $streamer = Streamer::create($validated);

        return response()->json(["message" => "Streamer hozzáadása sikeres.", "streamer" => $streamer], 201);
    }

    /**
     * Display the specified resource.
     */

    public function show(Request $request) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Streamer $streamer)
    {
        $validated = $request->validate(
            ["followers" => "required|integer|min:0"],
            [
                "required" => ":attribute megadása szükséges.",
                "integer" => ":attribute mező szám érték kell legyen",
                "min" => ":attribute mező minimum értéke :min"
            ],
            [
                "followers" => "A követők"
            ]
        );

        $streamer->update($validated);

        return response()->json(["message" => "A streamer sikeresen módosítva."], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Streamer $streamer)
    {
        
        $streamer->delete();
        return response()->json(["message" => "Streamer sikeresen törölve"], 200);
    }
}
