<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MobileApi\DashboardHomeController;


Route::get('test', function(){
    return "F";
});

Route::prefix('dashboard')->group(function () {

    Route::prefix('home')->group(function () {
        Route::get('/matches', [DashboardHomeController::class, 'matches']);
        Route::get('/upcommingmatches', [DashboardHomeController::class, 'upcommingmatches']);
        Route::get('/recentmatches', [DashboardHomeController::class, 'recentmatches']);
        Route::get('/ongoingseries', [DashboardHomeController::class, 'ongoingseries']);
        Route::get('/ongoingseriesdetail', [DashboardHomeController::class, 'ongoingseriesdetail']);
        Route::get('/news', [DashboardHomeController::class, 'trendingnew']);
        Route::get('/about-us', [DashboardHomeController::class, 'aboutus']);
        Route::get('/term-condition', [DashboardHomeController::class, 'terms']);
        Route::get('/privacy-policy', [DashboardHomeController::class, 'privacy']);
    });


    // Add more routes for the dashboard as needed
});

// Route::prefix('matches')->group(function () {
//     Route::get('/', 'MatchController@index');
//     Route::post('/', 'MatchController@store');
//     Route::get('/{id}', 'MatchController@show');
//     // Add more routes for matches as needed
// });
