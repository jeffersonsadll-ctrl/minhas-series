<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('series.index');
});

Route::controller(App\Http\Controllers\seriesController::class)->group(function () {
    Route::get('/series', 'index')->name('series.index')->middleware('autenticador');
    Route::get('/series/create', 'create')->name('series.create')->middleware('autenticador');
    Route::get('/series/edit/{id}', 'edit')->name('series.edit')->whereNumber('id', '[0-9]+')->middleware('autenticador');
    Route::put('/series/update/{id}', 'update')->name('series.update')->whereNumber('id', '[0-9]+')->middleware('autenticador');
    Route::post('/series', 'store')->name('series.store')->middleware('autenticador');
    Route::delete('/series/destroy/{id}', 'destroy')->name('series.destroy')->whereNumber('id', '[0-9]+')->middleware('autenticador');
});

Route::controller(App\Http\Controllers\temporadasController::class)->group(function (){
    Route::get('/series/{id}/temporadas', 'index')->name('temporadas.index')->whereNumber('id', '[0-9]+')->middleware('autenticador');
});

Route::controller(App\Http\Controllers\episodiosController::class)->group(function (){
    Route::get('/temporada/{id}/episodios', 'index')->name('episodios.index')->whereNumber('id', '[0-9]+')->middleware('autenticador');
    Route::post('/temporada/{id}/assistido', 'assistido')->name('episodios.assistido')->whereNumber('id', '[0-9]+')->middleware('autenticador');
});

Route::controller(App\Http\Controllers\loginController::class)->group(function (){
    Route::get('/login', 'index')->name('login.index');
    Route::post('/login', 'autenticar')->name('login.autenticar');
    Route::get('/logout', 'deslogar')->name('login.deslogar');
});

Route::controller(App\Http\Controllers\usuarioController::class)->group(function (){
    Route::get('/registrar', 'create')->name('usuario.create');
    Route::post('/registrar', 'store')->name('usuario.store');
});