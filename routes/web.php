<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => ['web','tenant']], function () {
    Route::get('/test', function () {
        return view('welcome');
    });
});
