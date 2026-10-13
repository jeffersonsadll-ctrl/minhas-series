<x-layout title="Temporadas de {{ $serie->title }}">
    <div class="d-flex justify-content-center">
        <img src="{{ $serie->capa ? asset('storage/' . $serie->capa) : asset('storage/sem-foto.jpg') }}" 
             alt="Capa da Série {{ $serie->title }}" style="height: 200px;">
    </div>
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