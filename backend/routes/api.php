<?php

use App\Http\Controllers\{
    BookController, 
    WeatherController,
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers'
], function ($router) {
    Route::post('login', 'AuthController@login');
});

Route::middleware('VerifyJwtMiddleware')->group(function () {
    Route::resource('books', BookController::class)
    ->except(['create', 'edit']);

    Route::resource('weather', WeatherController::class)
        ->only('show');
});