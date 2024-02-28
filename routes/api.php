<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


use App\Http\Controllers\SquadController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamPlayerController;


use App\Http\Controllers\TournamentController;
use App\Http\Controllers\TournamentPlayerController;
use App\Http\Controllers\TournamentTeamController;
use App\Http\Controllers\TournamentTeamPlayerController;


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



Route::group(['prefix' => 'squads'], function () {
    Route::get('/', [SquadController::class, 'index']);
    Route::post('/', [SquadController::class, 'store']);
    Route::post('/{id}', [SquadController::class, 'update']);
    Route::delete('/{id}', [SquadController::class, 'destroy']);
});




Route::group(['prefix' => 'teams'], function () {
    Route::get('/', [TeamController::class, 'index']);
    Route::post('/', [TeamController::class, 'store']);
    Route::post('/{id}', [TeamController::class, 'update']);
    Route::delete('/{id}', [TeamController::class, 'destroy']);
});



Route::group(['prefix' => 'countries'], function () {
    Route::get('/', [CountryController::class, 'index']);
    Route::post('/', [CountryController::class, 'store']);
    Route::post('/{id}', [CountryController::class, 'update']);
    Route::delete('/{id}', [CountryController::class, 'destroy']);
});



Route::group(['prefix' => 'players'], function () {
    Route::get('/', [PlayerController::class, 'index']);
    Route::post('/', [PlayerController::class, 'store']);
    Route::post('/{id}', [PlayerController::class, 'update']);
    Route::delete('/{id}', [PlayerController::class, 'destroy']);
});



Route::group(['prefix' => 'teamplayers'], function () {
    Route::get('/', [TeamPlayerController::class, 'index']);
    Route::post('/', [TeamPlayerController::class, 'store']);
    Route::post('/{id}', [TeamPlayerController::class, 'update']);
    Route::delete('/{id}', [TeamPlayerController::class, 'destroy']);
});




Route::group(['prefix' => 'tournaments'], function () {
    Route::get('/', [TournamentController::class, 'index']);
    Route::post('/', [TournamentController::class, 'store']);
    Route::post('/{id}', [TournamentController::class, 'update']);
    Route::delete('/{id}', [TournamentController::class, 'destroy']);
});




Route::group(['prefix' => 'tournamentplayers'], function () {
    Route::get('/', [TournamentPlayerController::class, 'index']);
    Route::post('/', [TournamentPlayerController::class, 'store']);
    Route::post('/{id}', [TournamentPlayerController::class, 'update']);
    Route::delete('/{id}', [TournamentPlayerController::class, 'destroy']);
});



Route::group(['prefix' => 'tournamentteams'], function () {
    Route::get('/', [TournamentTeamController::class, 'index']);
    Route::post('/', [TournamentTeamController::class, 'store']);
    Route::post('/{id}', [TournamentTeamController::class, 'update']);
    Route::delete('/{id}', [TournamentTeamController::class, 'destroy']);
});



Route::group(['prefix' => 'tournamentteamplayers'], function () {
    Route::get('/', [TournamentTeamPlayerController::class, 'index']);
    Route::post('/', [TournamentTeamPlayerController::class, 'store']);
    Route::post('/{id}', [TournamentTeamPlayerController::class, 'update']);
    Route::delete('/{id}', [TournamentTeamPlayerController::class, 'destroy']);
});
