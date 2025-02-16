<?php

use Illuminate\Support\Facades\Route;

Route::domain('{tenant}.crm.test')
    ->group(function () {
    Route::get('/', function () {
        return \App\Models\Tenant\User::all();
    });
});

