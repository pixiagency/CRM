<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\ClientController;
use App\Http\Controllers\Web\UsersController;
use App\Http\Controllers\web\ReasonController;
use App\Http\Controllers\Web\ServiceController;
use App\Http\Controllers\Web\IndustryController;
use App\Http\Controllers\Web\LocationController;
use App\Http\Controllers\Web\ResourceController;
use App\Http\Controllers\Web\CustomFieldController;
use App\Http\Controllers\Web\RolePermissionController;

Route::group(['prefix' => 'authentication', 'middleware' => 'guest'], function () {
    Route::get('login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('signin');
});

Route::get('/', function () {
    return view('welcome');
});

//auth routes
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('livewire.index');
    })->name('home');

    Route::put('profile/{id}', [UsersController::class, 'updateProfile'])->name('profile.update');
    Route::get('profile', function () {
        return view('layouts.dashboard.users.profile');
    })->name('profile.index');

    Route::resource('industries', IndustryController::class);
    Route::resource('services', ServiceController::class);

    Route::resource('locations', LocationController::class);
    Route::get('locations/{id}/create-areas', [LocationController::class, 'createArea'])->name('locations.areas.create');
    Route::post('locations/areas', [LocationController::class, 'storeArea'])->name('locations.areas.store');

    Route::resource('reasons', ReasonController::class);
    Route::resource('resources', ResourceController::class);

    Route::resource('custom-fields',CustomFieldController::class);
    Route::resource('clients',ClientController::class);

    Route::get('role-permissions', [RolePermissionController::class, 'index'])->name('role-permissions.index');
    Route::get('role-permissions/{role}', [RolePermissionController::class, 'show'])->name('role-permissions.show');
    Route::put('role-permissions/{role}', [RolePermissionController::class, 'update'])->name('role-permissions.update');


    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

});



