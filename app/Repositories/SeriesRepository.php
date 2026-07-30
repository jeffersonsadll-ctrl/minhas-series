<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;

class SeriesRepository implements SeriesInterface
{

  public function add(SeriesFormRequest $request): Series{

    try{

        DB::beginTransaction();
        $serie = Series::create($request->all());

        for( $i = 1; $i <= $request->temporadas; $i++ ) {
            $temporada = $serie->temporadas()->create([
                'numero_temporada' => $i
            ]);

            for( $j = 1; $j <= $request->episodios; $j++ ) {
                $temporada->episodios()->create([
                    'numero_episodio' => $j,
                    'descricao' => "Episódio {$j} da temporada {$i}"
                ]);
            }
        }

        $request->session()->flash('message.success', "Série '{$serie->title}' adicionada com sucesso!");
        DB::commit();

    }catch(\Exception $e) {

        DB::rollBack();
        $request->session()->flash('message.error', "Erro ao adicionar a série: {$e->getMessage()}");
        $serie = null;
    }

    return $serie;

  }

}