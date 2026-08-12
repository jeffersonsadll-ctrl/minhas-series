<x-layout title="Temporadas de {{ $serie->title }}">
    <ul class="list-group">
        @foreach ($temporadas as $temporada)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="{{ route('episodios.index', $temporada->id) }}">
                    Temporada {{ $temporada->numero_temporada }}
                </a>
                <span class="badge bg-secondary">
                   {{ $temporada->numeroEpisodiosAssistidos()['episodiosAssistidos'] }} / {{ $temporada->numeroEpisodiosAssistidos()['totalEpisodios'] }}
                </span>
            </li>
        @endforeach
    </ul>
</x-layout>