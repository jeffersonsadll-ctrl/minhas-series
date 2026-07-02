<x-layout title="Criar Série">
  <form action="{{ route('series.store') }}" method="POST">
    @csrf
    <input type="text" name="nome" placeholder="Nome da Série">
    <button type="submit">Criar</button>
  </form>
</x-layout>