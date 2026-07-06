<x-layout title="Melhores Series">
    <a href="{{ route('series.create') }}" class="btn btn-primary mb-3">Adicionar Série</a>
    <ul class="list-group">
        @foreach ($listSeries as $serie)
            <li class="list-group-item">{{ $serie }}</li>
        @endforeach
    </ul>
</x-layout>