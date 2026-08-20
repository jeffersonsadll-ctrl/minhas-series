<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SerieCriada;
use App\Repositories\SeriesInterface;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Models\User;

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
        $serie = $this->repository->add($request);

        $listaUsuarios = User::all();
        // enviar email para usuario logado
        foreach ($listaUsuarios as $usuario) {
            Mail::to($usuario)->send(new SerieCriada(
                $serie->id,
                $serie->title,
                $request->input('temporadas'),
                $request->input('episodios')
            ));    
            
            sleep(10); // Adiciona um atraso de 3 segundos entre os envios
        }

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
        try{

            Series::destroy($id);    

            $request->session()->flash('message.success', "Série removida com sucesso!");

        }catch(\Exception $e) {

            $request->session()->flash('message.error', "Erro ao remover a série: {$e->getMessage()}");

        }

        return redirect()->route('series.index');
    }
}
