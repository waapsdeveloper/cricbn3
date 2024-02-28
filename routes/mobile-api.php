<?php

use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')->group(function () {

    Route::prefix('home')->group(function () {
        Route::get('/matches', 'MobileApi\DashboardHomeController@matches');
    });


    // Add more routes for the dashboard as needed
});

// Route::prefix('matches')->group(function () {
//     Route::get('/', 'MatchController@index');
//     Route::post('/', 'MatchController@store');
//     Route::get('/{id}', 'MatchController@show');
//     // Add more routes for matches as needed
// });
