<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('series.index');
});
Route::get('/series', [App\Http\Controllers\seriesController::class, 'index'])->name('series.index');

Route::middleware('guest')->group(function () {    
    Route::get('/login', [App\Http\Controllers\loginController::class, 'index'])->name('login.index');
    Route::post('/login', [App\Http\Controllers\loginController::class, 'autenticar'])->name('login.autenticar');
    Route::get('/registrar', [App\Http\Controllers\usuarioController::class, 'create'])->name('usuario.create');
    Route::post('/registrar', [App\Http\Controllers\usuarioController::class, 'store'])->name('usuario.store');
});

Route::middleware('autenticador')->group(function () {
    Route::get('/logout', [App\Http\Controllers\loginController::class, 'deslogar'])->name('login.deslogar');

    Route::get('/series/create', [App\Http\Controllers\seriesController::class, 'create'])->name('series.create');
    Route::post('/series', [App\Http\Controllers\seriesController::class, 'store'])->name('series.store');
    Route::get('/series/edit/{id}', [App\Http\Controllers\seriesController::class, 'edit'])->name('series.edit')->whereNumber('id');
    Route::put('/series/update/{id}', [App\Http\Controllers\seriesController::class, 'update'])->name('series.update')->whereNumber('id');
    Route::delete('/series/destroy/{id}', [App\Http\Controllers\seriesController::class, 'destroy'])->name('series.destroy')->whereNumber('id');

    Route::get('/series/{id}/temporadas', [App\Http\Controllers\temporadasController::class, 'index'])->name('temporadas.index')->whereNumber('id');
    Route::get('/temporada/{id}/episodios', [App\Http\Controllers\episodiosController::class, 'index'])->name('episodios.index')->whereNumber('id');
    Route::post('/temporada/{id}/assistido', [App\Http\Controllers\episodiosController::class, 'assistido'])->name('episodios.assistido')->whereNumber('id');
});

Route::get('/email', fn () => new App\Mail\SerieCriada(
    1,
    'Nome da Série',
    3,
    10
));