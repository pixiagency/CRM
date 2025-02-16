<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\LeadController;
use App\Http\Controllers\Web\UsersController;
use App\Http\Controllers\Web\ClientController;
use App\Http\Controllers\web\ReasonController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\PiplineController;
use App\Http\Controllers\Web\ServiceController;
use App\Http\Controllers\Web\IndustryController;
use App\Http\Controllers\Web\LocationController;
use App\Http\Controllers\Web\ResourceController;
use App\Http\Controllers\Web\CustomFieldController;
use App\Http\Controllers\Web\RolePermissionController;

Route::domain('{tenant}.crm.test')->middleware('tenant')->group(function () {

    // Route::get('/', function () {
    //     return \App\Models\Tenant\User::all();
    // });

    // Route::group(['prefix' => 'authentication', 'middleware' => 'guest'], function () {
    //     Route::get('login', [AuthController::class, 'loginForm'])->name('login');
    //     Route::get('signup', [AuthController::class, 'signupForm'])->name('signup');
    //     Route::post('signup', [AuthController::class, 'signup'])->name('signup');
    //     Route::post('login', [AuthController::class, 'login'])->name('signin');
    // });

    // Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    //     Route::get('/', function () {
    //         return view('livewire.index');
    //     })->name('home');
    //     Route::get('profile', [AuthController::class, 'getProfile'])->name('profile.index');
    //     Route::put('profile/', [AuthController::class, 'updateProfile'])->name('profile.update');
    //     Route::resource('industries', IndustryController::class);
    //     Route::resource('services', ServiceController::class);
    //     Route::get('locations/cities', [LocationController::class, 'create'])->name('locations.cities.create');
    //     Route::get('locations/governorates', [LocationController::class, 'create'])->name('locations.governorates.create');
    //     Route::get('locations/countries', [LocationController::class, 'create'])->name('locations.countries.create');
    //     Route::get('locations/cities/{location}/edit', [LocationController::class, 'edit'])->name('locations.cities.edit');
    //     Route::get('locations/governorates/{location}/edit', [LocationController::class, 'edit'])->name('locations.governorates.edit');
    //     Route::get('locations/countries/{location}/edit', [LocationController::class, 'edit'])->name('locations.countries.edit');
    //     Route::post('locations/sublocations', [LocationController::class, 'storeSubLocation'])->name('locations.sublocation.store');
    //     Route::put('locations/sublocations/{location}', [LocationController::class, 'updateSubLocation'])->name('locations.sublocation.update');
    //     Route::resource('locations', LocationController::class)->except('create');
    //     Route::resource('reasons', ReasonController::class);
    //     Route::resource('resources', ResourceController::class);
    //     Route::resource('custom-fields', CustomFieldController::class);
    //     Route::resource('clients', ClientController::class);
    //     Route::resource('piplines', PiplineController::class);
    //     Route::resource('contacts', ContactController::class);
    //     Route::resource('leads', LeadController::class);
    //     Route::resource('role-permissions', RolePermissionController::class)->parameters([
    //         'role-permissions' => 'role'
    //     ]);
    //     Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    // });
});
