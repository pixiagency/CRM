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

    Route::get('profile', [AuthController::class, 'getProfile'])->name('profile.index');

    Route::put('profile/{id}', [UsersController::class, 'updateProfile'])->name('profile.update');

    Route::resource('industries', IndustryController::class);
    Route::resource('services', ServiceController::class);


    // Route::get('locations/', [LocationController::class, 'createArea'])->name('locations.areas.create');
    Route::get('locations/cities', [LocationController::class, 'create'])->name('locations.cities.create');
    Route::get('locations/governorates', [LocationController::class, 'create'])->name('locations.governorates.create');
    Route::get('locations/countries', [LocationController::class, 'create'])->name('locations.countries.create');
    Route::get('locations/cities/{location}/edit', [LocationController::class, 'edit'])->name('locations.cities.edit');
    Route::get('locations/governorates/{location}/edit', [LocationController::class, 'edit'])->name('locations.governorates.edit');
    Route::get('locations/countries/{location}/edit', [LocationController::class, 'edit'])->name('locations.countries.edit');
    Route::post('locations/sublocations', [LocationController::class, 'storeSubLocation'])->name('locations.sublocation.store');
    Route::put('locations/sublocations/{location}', [LocationController::class, 'updateSubLocation'])->name('locations.sublocation.update');
    Route::resource('locations', LocationController::class)->except('create');

    Route::resource('reasons', ReasonController::class);
    Route::resource('resources', ResourceController::class);

    Route::resource('custom-fields',CustomFieldController::class);
    Route::resource('clients',ClientController::class);
    Route::resource('role-permissions', RolePermissionController::class)->parameters([
        'role-permissions' => 'role'
    ]);


    // Route::get('role-permissions', [RolePermissionController::class, 'index'])->name('role-permissions.index');
    // Route::get('role-permissions/{role}', [RolePermissionController::class, 'show'])->name('role-permissions.show');
    // Route::put('role-permissions/{role}', [RolePermissionController::class, 'update'])->name('role-permissions.update');


    Route::get('logout', [AuthController::class, 'logout'])->name('logout');


    Route::fallback(function () {
        return view('layouts.dashboard.error-pages.error404');
    })->name('error');
    Route::get('/clear-cache', function () {
        \Illuminate\Support\Facades\Artisan::call('config:cache');
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('config:clear');
        \Illuminate\Support\Facades\Artisan::call('view:clear');
        \Illuminate\Support\Facades\Artisan::call('route:clear');
        return "Cache is cleared";
    })->name('clear.cache');
    Route::get('/migrate-fresh/{password}', function ($password) {
        if ($password == 150024) {

            \Illuminate\Support\Facades\Artisan::call('migrate:fresh --seed');
            return "migrate fresh success";
        }
    })->name('migrate-fresh');


    Route::get('/migrate/{password}', function ($password) {
        if ($password == 1234) {

            \Illuminate\Support\Facades\Artisan::call('migrate');
            return "migrate fresh success";
        }
    })->name('migrate');
});



