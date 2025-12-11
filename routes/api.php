<?php

use App\Http\Controllers\GameController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/games", [GameController::class, 'index']);
Route::get("/games/{name}", [GameController::class, 'show']);
Route::post("/games", [GameController::class, 'store']);
Route::put("/games/{game}", [GameController::class, 'update']);
Route::delete("/games/{game}", [GameController::class, 'destroy']);
