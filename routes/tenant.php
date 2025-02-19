<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\IndustryController;


// Subdomain Routes
Route::domain('{tenant}.crm.test')->middleware(['web', 'tenant'])->group(function () {
    // Route::get('/ahmed', function () {
    //     return "Subdomain Route";
    // });

    // Add other subdomain-specific routes here

    Route::resource('industries', IndustryController::class);
    

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
