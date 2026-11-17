<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
  return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function() {
  Route::apiResource('series', \App\Http\Controllers\Api\SeriesController::class)->names([
      'index' => 'api.series.index',
      'store' => 'api.series.store',
      'show' => 'api.series.show',
      'update' => 'api.series.update',
      'destroy' => 'api.series.destroy',
  ]);
  Route::post('capaUpload', [\App\Http\Controllers\Api\SeriesController::class, 'capaUpload']);
  Route::get('series/{id}/temporadas', [\App\Http\Controllers\Api\TemporadasController::class, 'index'])->name('series.temporadas');
  Route::get('series/{id}/episodios', [\App\Http\Controllers\Api\EpisodiosController::class, 'index'])->name('series.episodios');
  Route::patch('episodios/{id}/assistido', [\App\Http\Controllers\Api\EpisodiosController::class, 'assistido']);
});

Route::post('token/criar', [\App\Http\Controllers\Api\Auth\TokenController::class, 'criarToken']);
