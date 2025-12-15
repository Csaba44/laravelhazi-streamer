<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genre::with("games")->get();
        return response()->json($genres, 200);
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
                "name" => "A műfaj név",
            ]
        );

        $genre = Genre::create($validated);

        return response()->json(["message" => "Műfaj hozzáadása sikeres.", "genre" => $genre], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $name)
    {
        $genre = Genre::with("games")->where("name", "=", $name)->get();


        return response()->json($genre, 200);
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
