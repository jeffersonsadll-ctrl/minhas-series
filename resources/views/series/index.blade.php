<x-layout title="Melhores Series">
    <a href="{{ route('series.create') }}" class="btn btn-primary mb-3">Adicionar Série</a>
    <ul class="list-group">
        @foreach ($listSeries as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $serie->title }}
                <form action="{{ route('series.destroy', $serie->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">X</button>
                </form>
            </li>
        @endforeach
    </ul>
</x-layout>