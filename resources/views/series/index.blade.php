<x-layout title="Melhores Series">
    <a href="{{ route('series.create') }}">Adicionar Série</a>
    <ul>
        @foreach ($listSeries as $serie)
            <li>{{ $serie }}</li>
        @endforeach
    </ul>
</x-layout>