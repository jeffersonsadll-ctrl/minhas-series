<x-layout title="Criar Série">
  <form action="{{ route('series.store') }}" method="POST" class="card p-3" style="max-width: 28rem;">
    @csrf
    <div class="mb-3">
      <label for="nome" class="form-label">Nome da Série</label>
      <input id="nome" type="text" name="nome" placeholder="Nome da Série" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Criar</button>
  </form>
</x-layout>