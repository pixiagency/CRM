<?php

use App\Http\Controllers\Web\IndustryController;

use App\Http\Controllers\Web\ServiceController;

use App\Http\Controllers\Web\LocationController;
use App\Http\Controllers\web\ReasonController;
use App\Http\Controllers\Web\ResourceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('industries', IndustryController::class);
Route::resource('services', ServiceController::class);
Route::resource('locations', LocationController::class);
Route::resource('reasons', ReasonController::class);
Route::resource('resources', ResourceController::class);

