<?php

use App\Http\Controllers\Web\IndustryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('industries', IndustryController::class);
