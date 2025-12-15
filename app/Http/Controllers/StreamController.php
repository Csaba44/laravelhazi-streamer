<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Streamer;
use Illuminate\Http\Request;

class StreamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $streams = Streamer::with(["games", "platforms"])->get();
        return response()->json($streams, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                "streamer_id" => "required|exists:streamers,id",
                "game_id" => "required|exists:games,id",
                "title" => "required|string",
                "duration_seconds" => "required|integer",
                "views" => "required|integer",
            ],
            [
                "required" => ":attribute megadása szükséges.",
                "string" => ":attribute mező szöveges kell legyen",
                "integer" => ":attribute mező szám kell legyen",
                "exists" => ":attribute nem létezik",
            ],
            [
                "streamer_id"=>"A streamer id",
                "game_id"=>"A játék id",
                "title"=>"A stream cím",
                "duration_seconds"=>"Hossz másodpercekben",
                "views"=>"Megtekintések"
            ]
        );

        $streamer = Streamer::find($validated['streamer_id']);
        $streamer->games()->attach($validated['game_id'],[
            "title"=>$validated['title'],
            "duration_seconds"=>$validated['duration_seconds'],
            "views"=>$validated['views']
        ]);

        return response()->json(["message" => "Streamer hozzáadása sikeres.", "streamer" => $streamer], 201);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
