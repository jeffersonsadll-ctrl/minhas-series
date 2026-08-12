<?php 

namespace App\Http\Controllers;

use App\Models\Temporadas;
use App\Models\Episodios;
use Illuminate\Foundation\Http\FormRequest;

class episodiosController extends Controller
{
    function index(int $idTemporada)
    {
        $temporada = Temporadas::with('episodios')->find($idTemporada);

        return view('episodios.index', [
            'episodios' => $temporada->episodios,
            'temporada' => $temporada,
            'mensagem' => session('mensagem.sucesso')
        ]);
    }

    function assistido(FormRequest $request, int $idEpisodio)
    {
        $episodio = Episodios::find($idEpisodio);
        $episodio->assistido = !$episodio->assistido;
        $episodio->save();

        $temporada = Temporadas::find($request->input('temporada_id'));

        return to_route('episodios.index', ['id' => $temporada->id])
            ->with('mensagem.sucesso', 'Episódio atualizado com sucesso!');
    }
}