@props([
    'action',
    'method' => 'POST',
    'buttonText' => 'Salvar',
    'serie' => null
])

<form action="{{ $action }}" method="POST" class="card p-3" style="max-width: 28rem;" enctype="multipart/form-data">
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
    <img src="{{ $serie->capa ? asset('storage/' . $serie->capa) : asset('storage/sem-foto.jpg') }}" alt="Capa da Série {{ $serie->title }}" style="height: 200px;">
  </div>
  

  <div class="mb-3">
    <label for="capa" class="form-label">Capa da Série</label>
    <input type="file"
      id="capa"
      name="capa"
      class="form-control"
      accept="image/png, image/jpeg"
    >
  </div>

  <button type="submit" class="btn btn-success">{{ $buttonText }}</button>
</form>