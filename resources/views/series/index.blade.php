<x-layout title="Melhores Series">
    <ul>
        @foreach ($listSeries as $serie)
            <li>{{ $serie }}</li>
        @endforeach
    </ul>
</x-layout>