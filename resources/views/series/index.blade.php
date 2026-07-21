<x-layout title="Melhores Series">
    <a href="{{ route('series.create') }}" class="btn btn-primary mb-3">Adicionar Série</a>

    @if (session('message.success'))
        <div class="alert alert-success">
            {{ session('message.success') }}
        </div>
    @endif

    <ul class="list-group">
        @foreach ($listSeries as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="{{ route('temporadas.index', $serie->id) }}">
                    {{ $serie->title }}
                </a>
                <div>
                    <a href="{{ route('series.edit', $serie->id) }}" class="btn btn-warning btn-sm">
                        Editar
                    </a>
                    <form action="{{ route('series.destroy', $serie->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">X</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</x-layout>