<?php

use App\Http\Controllers\{
    BookController, 
    WeatherController
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('books', BookController::class)
    ->except(['create', 'edit']);

Route::resource('weather', WeatherController::class)
    ->only('show');