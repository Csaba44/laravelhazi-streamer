<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\StreamController;
use App\Http\Controllers\StreamerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/games", [GameController::class, 'index']);
Route::get("/games/name/{name}", [GameController::class, 'show']);
Route::get("/games/id/{id}", [GameController::class, 'show2']);
Route::get("/games/name-ordered", [GameController::class, 'index2']);
Route::get("/games/released-ordered", [GameController::class, 'index3']);
Route::get("/streamers", [StreamerController::class, 'index']);
Route::get("/genres",[GenreController::class,'index']);
Route::get("/genres/{name}",[GenreController::class,'show']);
Route::get("/platforms",[PlatformController::class,'index']);
Route::get("/platforms",[PlatformController::class,'index']);
Route::get("streams",[StreamController::class,'index']);

Route::post("/new/platform", [PlatformController::class, 'store']);
Route::post("/new/genre", [GenreController::class, 'store']);
Route::post("/new/game", [GameController::class, 'store']);
Route::post("/new/streamer",[StreamerController::class,'store']);
Route::post("/new/stream",[StreamController::class,'store']);

Route::put("/update/platform/{platform}", [PlatformController::class, 'update']);
Route::put("/update/genre/{genre}", [GenreController::class, 'update']);
Route::put("/update/game/{game}", [GameController::class, 'update']);
Route::put("/update/streamer/{streamer}", [StreamerController::class, 'update']);

Route::delete("/delete/platform/{platform}", [PlatformController::class, 'destroy']);
Route::delete("/delete/genre/{genre}", [GenreController::class, 'destroy']);
Route::delete("/delete/game/{game}", [GameController::class, 'destroy']);
Route::delete("/delete/streamer/{streamer}", [StreamerController::class, 'destroy']);
