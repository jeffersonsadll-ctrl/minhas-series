<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Series;

class EpisodiosController extends Controller
{
  function index(int $series)
  {
    $serie = Series::with('episodios')->find($series);
    return $serie->episodios;
  }
}