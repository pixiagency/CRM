<?php

use App\Http\Controllers\Web\IndustryController;
use App\Http\Controllers\Web\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('industries', IndustryController::class);
Route::resource('services', ServiceController::class);
