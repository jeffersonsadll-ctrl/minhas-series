<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;

class SeriesRepository implements SeriesInterface
{

  public function add(SeriesFormRequest $request): ?Series{

    try{

        DB::beginTransaction();
        $serie = Series::create([
            'title' => $request->input('title'),
            'capa' => $request->input('capa'),
        ]);

        for( $i = 1; $i <= (int) $request->input('temporadas'); $i++ ) {
            $temporada = $serie->temporadas()->create([
                'numero_temporada' => $i
            ]);

            for( $j = 1; $j <= (int) $request->input('episodios'); $j++ ) {
                $temporada->episodios()->create([
                    'numero_episodio' => $j,
                    'descricao' => "Episódio {$j} da temporada {$i}"
                ]);
            }
        }

        // se for api, não usar session
        DB::commit();

        if(!request()->wantsJson())
            $request->session()->flash('message.success', "Série '{$serie->title}' adicionada com sucesso!");

    }catch(\Exception $e) {

        DB::rollBack();

        if(!request()->wantsJson())
            $request->session()->flash('message.error', "Erro ao adicionar a série: {$e->getMessage()}");
        $serie = null;
    }

    return $serie;

  }

}