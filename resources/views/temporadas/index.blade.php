<x-layout title="Temporadas de {{ $serie->title }}">
    <ul class="list-group">
        @foreach ($temporadas as $temporada)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Temporada {{ $temporada->numero_temporada }}
                <span class="badge bg-secondary">
                    {{ $temporada->episodios->count() }}
                </span>
            </li>
        @endforeach
    </ul>
</x-layout>