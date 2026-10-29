<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Series;

class TemporadasController extends Controller
{
    public function index(int $serie) {
      $serie = Series::findOrFail($serie);

      return $serie->temporadas;
    }
}