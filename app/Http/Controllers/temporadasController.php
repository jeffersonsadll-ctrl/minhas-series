<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Series;

class temporadasController extends Controller
{
    function index(Request $request, $id)
    {
        $serie = Series::with(['temporadas' => function($query) {
            $query->orderBy('numero_temporada', 'asc');
        }, 'temporadas.episodios'])->find($id);

        if (!$serie) {
            return redirect()->route('series.index')->with('message.error', 'Série não encontrada.');
        }

        return view('temporadas.index')
            ->with('serie', $serie)
            ->with('temporadas', $serie->temporadas);
    }
}
