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

  <button type="submit" class="btn btn-success">{{ $buttonText }}</button>
</form>