<x-layout title="Editar Série">
    <x-series.form :action="route('series.update', $serie->id)" :method="'PUT'" :serie="$serie" :buttonText="'Atualizar'" />
</x-layout>