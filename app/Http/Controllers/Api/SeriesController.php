<?php 

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;
use App\Models\series;

class SeriesController extends Controller
{
  public function __construct(private SeriesRepository $seriesRepository) {
  }

  public function index()
  {
    return series::all()->sortByDesc('id');
  }

  public function show(int $id)
  {
    $serie = series::with('temporadas.episodios')->findOrFail($id);
    return $serie;
  }

  public function store(SeriesFormRequest $request)
  {
    // se existir capaPath, adicionar no lugar do capa
    if($request->capaPath) $request->merge(['capa' => $request->capaPath]);

    return $this->seriesRepository->add($request);
  }

  public function update(SeriesFormRequest $request, $id)
  {
    $serie = series::findOrFail($id);
    $serie->update($request->all());
    return $serie;
  }

  public function destroy($id)
  {
    $serie = series::findOrFail($id);
    $serie->delete();
    return response()->noContent();
  }

  public function capaUpload(Request $request)
  {
    $request->validate([
      'capa' => ['required', 'image', 'mimes:jpeg,png'],
    ]);

    $path = $request->file('capa')->store('capas', 'public');

    return response()->json(['path' => $path]);
  }

}
