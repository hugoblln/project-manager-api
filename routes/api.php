<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\TacheController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register', [SecurityController::class, 'register']);

Route::post('login', [SecurityController::class, 'login']);

Route::middleware('auth:sanctum')->group(function() {
    Route::apiResource('taches', TacheController::class)->parameters([
        'taches' => 'tache'
    ]);
    Route::apiResource('projects', ProjectController::class);
});
