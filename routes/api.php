<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;
use App\Http\Controllers\Api\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');





Route::middleware([
    'api',
    \Stancl\Tenancy\Middleware\InitializeTenancyBySubdomain::class,
    \Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/sanctum/csrf-cookie', [CsrfCookieController::class, 'show']);
    // Public routes (accessible without authentication)
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/signup', [AuthController::class, 'signup']);

    Route::get('/tenant-test', function () {
        return response()->json(['message' => 'You are inside a tenant scope!']);
    });

    Route::middleware('auth:sanctum')->group(function () {
        //  Route::apiResource('reasons', ReasonController::class);
    //  Route::apiResource('industries', IndustryController::class);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/user', function () {
            return response()->json(auth()->user());
        });
    });



});


Route::get('/user-json', function (Request $request) {
    return response()->json($request->user()); // Returns authenticated user data
});
