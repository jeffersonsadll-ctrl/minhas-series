<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/series', [App\Http\Controllers\seriesController::class, 'index'])->name('series.index');

Route::get('/series/create', [App\Http\Controllers\seriesController::class, 'create'])->name('series.create');

Route::post('/series', [App\Http\Controllers\seriesController::class, 'store'])->name('series.store');