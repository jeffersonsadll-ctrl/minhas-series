<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SerieCriada;
use App\Repositories\SeriesInterface;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Models\User;
use App\Events\SerieCriada as SerieCriadaEvent;
use Illuminate\Support\Facades\Storage;

class seriesController extends Controller
{

    public function __construct(private SeriesInterface $repository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $listSeries = Series::query()
            ->select('title', 'id', 'capa')
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
        // caso nao tenha imagem, usar default que esta em public sem-foto.jpg
        $capaPath = $request->file('capa')?->store('capas', 'public');
        $request->merge(['capa' => $capaPath]);

        $serie = $this->repository->add($request);

        if (!$serie) {
            if ($capaPath) {
                Storage::disk('public')->delete($capaPath);
            }

            return redirect()->back()->withInput();
        }

        SerieCriadaEvent::dispatch(
            $serie->id,
            $serie->title,
            $serie->capa,
            (int) $request->input('temporadas'),
            (int) $request->input('episodios')
        );

        return redirect()->route('series.index');
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

        $dados = $request->safe()->only(['title']);
        $capaAntiga = $serie->capa;
        $capaNova = null;

        if ($request->hasFile('capa')) {
            $capaNova = $request->file('capa')->store('capas', 'public');

            if( $capaNova !== false ) {
                $dados['capa'] = $capaNova;
            }
        }

        $serie->update($dados);

        if ($capaNova !== null && $capaAntiga) {
            Storage::disk('public')->delete($capaAntiga);
        }

        $request->session()->flash('message.success', "Série '{$serie->title}' atualizada com sucesso!");

        return redirect()->route('series.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id, Request $request)
    {
        try{

            // deletar capa da série antes de remover o registro
            $serie = Series::find($id);
            if ($serie && $serie->capa) {
                Storage::disk('public')->delete($serie->capa);
            }

            Series::destroy($id);    

            $request->session()->flash('message.success', "Série removida com sucesso!");

        }catch(\Exception $e) {

            $request->session()->flash('message.error', "Erro ao remover a série: {$e->getMessage()}");

        }

        return redirect()->route('series.index');
    }
}
