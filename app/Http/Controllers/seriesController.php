<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SeriesFormRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Series;

class seriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $listSeries = Series::query()
            ->select('title', 'id')
            ->orderBy('title', 'asc')
            ->get();

        $message_success = $request->session()->get('message.success');

        return view('series.index')
            ->with('listSeries', $listSeries)
            ->with('message_success', $message_success);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('series.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SeriesFormRequest $request)
    {
        $serie = Series::create($request->all());

        for( $i = 1; $i <= $request->temporadas; $i++ ) {
            $temporada = $serie->temporadas()->create([
                'numero_temporada' => $i
            ]);

            for( $j = 1; $j <= $request->episodios; $j++ ) {
                $temporada->episodios()->create([
                    'numero_episodio' => $j
                ]);
            }
        }

        $request->session()->flash('message.success', "Série '{$serie->title}' adicionada com sucesso!");

        if( $serie ) {
            return redirect()->route('series.index');
        } else {
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $serie = Series::find($id);
        
        if( !$serie ) {
            return redirect()->route('series.index');
        }

        return view('series.edit')->with('serie', $serie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SeriesFormRequest $request, int $id)
    {
        $serie = Series::find($id);
        
        if( !$serie ) {
            return redirect()->route('series.index');
        }

        $serie->update($request->all());

        $request->session()->flash('message.success', "Série '{$serie->title}' atualizada com sucesso!");

        return redirect()->route('series.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id, Request $request)
    {
        Series::destroy($id);

        $request->session()->flash('message.success', "Série removida com sucesso!");

        return redirect()->route('series.index');
    }
}
