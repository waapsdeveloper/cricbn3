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


use App\Http\Controllers\MatchhController;
use App\Http\Controllers\MatchDetailController;


use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\TournamentOrganizerController;



use App\Http\Controllers\OngoingSeriesController;
use App\Http\Controllers\OngoingSeriesDetailController;



use App\Http\Controllers\TrendingNewController;



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



Route::group(['prefix' => 'matches'], function () {
    Route::get('/', [MatchhController::class, 'index']);
    Route::post('/', [MatchhController::class, 'store']);
    Route::post('/{id}', [MatchhController::class, 'update']);
    Route::delete('/{id}', [MatchhController::class, 'destroy']);
});



Route::group(['prefix' => 'matchdetails'], function () {
    Route::get('/', [MatchDetailController::class, 'index']);
    Route::post('/', [MatchDetailController::class, 'store']);
    Route::post('/{id}', [MatchDetailController::class, 'update']);
    Route::delete('/{id}', [MatchDetailController::class, 'destroy']);
});




Route::group(['prefix' => 'organizers'], function () {
    Route::get('/', [OrganizerController::class, 'index']);
    Route::post('/', [OrganizerController::class, 'store']);
    Route::post('/{id}', [OrganizerController::class, 'update']);
    Route::delete('/{id}', [OrganizerController::class, 'destroy']);
});





Route::group(['prefix' => 'tournament-organizers'], function () {
    Route::get('/', [TournamentOrganizerController::class, 'index']);
    Route::post('/', [TournamentOrganizerController::class, 'store']);
    Route::post('/{id}', [TournamentOrganizerController::class, 'update']);
    Route::delete('/{id}', [TournamentOrganizerController::class, 'destroy']);
});





Route::group(['prefix' => 'ongoing-series'], function () {
    Route::get('/', [OngoingSeriesController::class, 'index']);
    Route::post('/', [OngoingSeriesController::class, 'store']);
    Route::post('/{id}', [OngoingSeriesController::class, 'update']);
    Route::delete('/{id}', [OngoingSeriesController::class, 'destroy']);
});




Route::group(['prefix' => 'ongoing-series-detail'], function () {
    Route::get('/', [OngoingSeriesDetailController::class, 'index']);
    Route::post('/', [OngoingSeriesDetailController::class, 'store']);
    Route::post('/{id}', [OngoingSeriesDetailController::class, 'update']);
    Route::delete('/{id}', [OngoingSeriesDetailController::class, 'destroy']);
});






Route::group(['prefix' => 'news'], function () {
    Route::get('/', [TrendingNewController::class, 'index']);
    Route::post('/', [TrendingNewController::class, 'store']);
    Route::post('/{id}', [TrendingNewController::class, 'update']);
    Route::delete('/{id}', [TrendingNewController::class, 'destroy']);
});
