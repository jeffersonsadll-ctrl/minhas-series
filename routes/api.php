<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('series', \App\Http\Controllers\Api\SeriesController::class);
Route::post('capaUpload', [\App\Http\Controllers\Api\SeriesController::class, 'capaUpload']);
Route::get('series/{id}/temporadas', [\App\Http\Controllers\Api\TemporadasController::class, 'index']);
Route::get('series/{id}/episodios', [\App\Http\Controllers\Api\EpisodiosController::class, 'index']);