<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $games = Game::with("streamers")->get();

        return response()->json($games, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                "name" => "required|string|unique:games,name",
                "genre_id" => "required|integer|exists:genres,id",
                "release_date" => "required|date",
            ],
            [
                "required" => ":attribute megadása szükséges.",
                "string" => ":attribute mező szöveges kell legyen",
                "unique" => ":attribute mező már létezik",
                "integer" => ":attribute mezőnek szám értéknek kell lennie",
                "exists" => ":attribute nem létezik",
                "date" => ":attribute mezőnek Date tipusunak kell lennie"
            ],
            [
                "name" => "A játék név",
                "genre_id" => "A játék müfaja",
                "release_date" => "A játék kiadási ideje"
            ]
        );

        $game = Game::create($validated);

        return response()->json(["message" => "Játék hozzáadása sikeres.", "game" => $game], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $name)
    {
        $game = Game::with("streamers")->where("name", "=", $name)->get();

        return response()->json($game, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        $validated = $request->validate(
            [
                "name" => "required|string|unique:games,name",
                "genre_id" => "required|integer|exists:genres,id",
                "release_date" => "required|date",
            ],
            [
                "required" => ":attribute megadása szükséges.",
                "string" => ":attribute mező szöveges kell legyen",
                "unique" => ":attribute mező már létezik",
                "integer" => ":attribute mezőnek szám értéknek kell lennie",
                "exists" => ":attribute nem létezik",
                "date" => ":attribute mezőnek Date tipusunak kell lennie"
            ],
            [
                "name" => "A játék név",
                "genre_id" => "A játék müfaja",
                "release_date" => "A játék kiadási ideje"
            ]
        );

        $game->update($validated);

        return response()->json(["message" => "Játék sikeresen módositva.", "game" => $game], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        $game->delete();
        return response()->json(["message" => "Játék sikeresen törölve"], 200);
    }
}
