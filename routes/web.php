<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('series.index');
});

Route::controller(App\Http\Controllers\seriesController::class)->group(function () {
    Route::get('/series', 'index')->name('series.index');
    Route::get('/series/create', 'create')->name('series.create');
    Route::get('/series/edit/{id}', 'edit')->name('series.edit')->whereNumber('id', '[0-9]+');
    Route::put('/series/update/{id}', 'update')->name('series.update')->whereNumber('id', '[0-9]+');
    Route::post('/series', 'store')->name('series.store');
    Route::delete('/series/destroy/{id}', 'destroy')->name('series.destroy')->whereNumber('id', '[0-9]+');
});

Route::controller(App\Http\Controllers\temporadasController::class)->group(function (){
    Route::get('/series/{id}/temporadas', 'index')->name('temporadas.index')->whereNumber('id', '[0-9]+');
});