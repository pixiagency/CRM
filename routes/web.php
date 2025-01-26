<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\IndustryController;

use App\Http\Controllers\Web\ServiceController;

use App\Http\Controllers\Web\LocationController;
use App\Http\Controllers\web\ReasonController;
use App\Http\Controllers\Web\ResourceController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'authentication', 'middleware' => 'guest'], function () {
    Route::get('login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('signin');
});

Route::get('/', function () {
    return view('welcome');
});

Route::resource('industries', IndustryController::class);
Route::resource('services', ServiceController::class);
Route::resource('locations', LocationController::class);
Route::get('locations/{id}/create-areas', [LocationController::class, 'createArea'])->name('locations.areas.create');
Route::post('locations/areas', [LocationController::class, 'storeArea'])->name('locations.areas.store');



//auth routes
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('livewire.index');
    })->name('home');

    Route::resource('industries', IndustryController::class);
    Route::resource('services', ServiceController::class);

    Route::resource('locations', LocationController::class);
    Route::get('locations/{id}/create-areas', [LocationController::class, 'createArea'])->name('locations.areas.create');
    Route::post('locations/areas', [LocationController::class, 'storeArea'])->name('locations.areas.store');
  
    Route::resource('reasons', ReasonController::class);
    Route::resource('resources', ResourceController::class);

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

});



