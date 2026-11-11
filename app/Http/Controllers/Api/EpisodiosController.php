<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Series;
use App\Models\Episodios;

class EpisodiosController extends Controller
{
  function index(int $series)
  {
    $serie = Series::with('episodios')->find($series);
    return $serie->episodios;
  }

  function assistido(int $episodio, Request $request)
  {
    $episodio = Episodios::find($episodio);
    $episodio->assistido = $request->assistido;
    $episodio->save();

    return $episodio;
  }
}