<x-layout title="Episódios">
    <ul class="list-group">
        @foreach ($episodios as $episodio)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>
                    Titulo: {{ $episodio->titulo }}
                </span>
                <span> 
                    {{ $episodio->descricao }}
                </span>
                <span class="d-flex gap-2 align-items-center">
                    <form action="{{ route('episodios.assistido', $episodio->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="temporada_id" value="{{ $temporada->id }}">
                            @if( $episodio->assistido)                            
                                <button type="submit" class="btn btn-secondary btn-sm">Marcar como não assistido</button>
                            @else                            
                                <button type="submit" class="btn btn-success btn-sm">Marcar como assistido</button>
                            @endif
                        </form>
                </span>
            </li>
        @endforeach
    </ul>
</x-layout>