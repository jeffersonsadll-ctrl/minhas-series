<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('series.index');
});

Route::controller(App\Http\Controllers\seriesController::class)->group(function () {
    Route::get('/series', 'index')->name('series.index');
    Route::get('/series/create', 'create')->name('series.create');
    Route::post('/series', 'store')->name('series.store');
    Route::delete('/series/destroy/{id}', 'destroy')->name('series.destroy')->whereNumber('id', '[0-9]+');
});