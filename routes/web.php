<?php

use App\Http\Controllers\Web\IndustryController;

use App\Http\Controllers\Web\ServiceController;

use App\Http\Controllers\Web\LocationController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('industries', IndustryController::class);
Route::resource('services', ServiceController::class);
Route::resource('locations', LocationController::class);
Route::get('locations/{id}/create-areas', [LocationController::class, 'createArea'])->name('locations.areas.create');
Route::post('locations/areas', [LocationController::class, 'storeArea'])->name('locations.areas.store');
