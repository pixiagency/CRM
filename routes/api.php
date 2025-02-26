<?php

use App\Http\Controllers\Api\IndustryController;
use App\Http\Controllers\Api\ReasonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ResourceController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

use Stancl\Tenancy\Middleware\InitializeTenancyBySubdomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::domain('{tenant}.crm.test')->middleware([
    'api'
    ])->group(function () {
        Route::apiResource('sources', ResourceController::class)->parameters([
            'sources' => 'int:id'
        ]);


        Route::apiResource('reasons', ReasonController::class);
        Route::apiResource('industries', IndustryController::class);
    });


Route::get('/test-api', function () {
    return response()->json(['message' => 'API is working']);
});
