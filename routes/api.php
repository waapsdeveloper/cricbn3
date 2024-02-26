<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\AllMatchController;
use App\Http\Controllers\AllTeamController;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::group(['prefix' => 'auth'], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});



Route::group(['prefix' => 'tournaments'], function () {
    // Index - List all tournaments
    Route::get('/', [TournamentController::class, 'index']);

    // Store - Store a newly created tournament in the database
    Route::post('/', [TournamentController::class, 'store']);

    // Update - Update the specified tournament in the database
    Route::put('/{id}', [TournamentController::class, 'update']);

    // Destroy - Remove the specified tournament from the database
    Route::delete('/{id}', [TournamentController::class, 'destroy']);
});



Route::group(['prefix' => 'all-matches'], function () {
    // Index - List all tournaments
    Route::get('/', [AllMatchController::class, 'index']);

    // Store - Store a newly created tournament in the database
    Route::post('/', [AllMatchController::class, 'store']);

    // Update - Update the specified tournament in the database
    Route::put('/{id}', [AllMatchController::class, 'update']);

    // Destroy - Remove the specified tournament from the database
    Route::delete('/{id}', [AllMatchController::class, 'destroy']);
});



Route::group(['prefix' => 'all-teams'], function () {
    // Index - List all tournaments
    Route::get('/', [AllTeamController::class, 'index']);

    // Store - Store a newly created tournament in the database
    Route::post('/', [AllTeamController::class, 'store']);

    // Update - Update the specified tournament in the database
    Route::put('/{id}', [AllTeamController::class, 'update']);

    // Destroy - Remove the specified tournament from the database
    Route::delete('/{id}', [AllTeamController::class, 'destroy']);
});
