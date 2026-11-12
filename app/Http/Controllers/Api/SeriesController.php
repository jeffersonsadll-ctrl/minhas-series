<?php 

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;
use App\Models\series;
use App\Http\Resources\SeriesResource;

class SeriesController extends Controller
{
  public function __construct(private SeriesRepository $seriesRepository) {
  }

  public function index(Request $request)
  {

    $query = series::query();

    if( $request->has("title") ){
      $query->where("title", "like", "%{$request->title}%");
    }

    return SeriesResource::collection($query->paginate(5));
  }

  public function show(int $id)
  {
    $serie = series::with('temporadas.episodios')->findOrFail($id);
    return new SeriesResource($serie);
  }

  public function store(SeriesFormRequest $request)
  {
    // se existir capaPath, adicionar no lugar do capa
    if($request->capaPath) $request->merge(['capa' => $request->capaPath]);

    $serie = $this->seriesRepository->add($request);

    return $serie ? new SeriesResource($serie) : response()->json(['message' => 'Não foi possível criar a série.'], 500);
  }

  public function update(SeriesFormRequest $request, $id)
  {
    $serie = series::findOrFail($id);
    $serie->update($request->all());
    return new SeriesResource($serie);
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
