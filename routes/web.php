<?php

use App\Http\Controllers\Web\IndustryController;
use App\Http\Controllers\Web\LocationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('industries', IndustryController::class);
Route::resource('locations', LocationController::class);
