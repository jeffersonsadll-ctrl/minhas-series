<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('series', \App\Http\Controllers\Api\SeriesController::class);
Route::post('capaUpload', [\App\Http\Controllers\Api\SeriesController::class, 'capaUpload']);
