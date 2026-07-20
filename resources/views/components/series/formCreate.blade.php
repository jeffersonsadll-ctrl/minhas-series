@props([
    'action',
    'method' => 'POST',
    'buttonText' => 'Salvar',
    'serie' => null
])

<form action="{{ $action }}" method="POST" class="card p-3" style="max-width: 28rem;">
  @csrf
  @if (!in_array(strtoupper($method), ['GET', 'POST']))
    @method($method)
  @endif

  <div class="mb-3">
    <label for="title" class="form-label">Nome da Série</label>
    <input
      id="title"
      type="text"
      name="title"
      value="{{ old('title', $serie->title ?? '') }}"
      placeholder="Nome da Série"
      class="form-control"
    >
  </div>

  <div class="mb-3">
    <label for="description" class="form-label">Temporadas</label>
    <input
      id="temporadas"
      type="number"
      name="temporadas"
      value="{{ old('temporadas', $serie->temporadas ?? '') }}"
      placeholder="Temporadas"
      class="form-control"
    >
  </div>

  <div class="mb-3">
    <label for="episodios" class="form-label">Episódios por temporada</label>
    <input
      id="episodios"
      type="number"
      name="episodios"
      value="{{ old('episodios', $serie->episodios ?? '') }}"
      placeholder="Episódios"
      class="form-control"
    >
  </div>

  <button type="submit" class="btn btn-success">{{ $buttonText }}</button>
</form>