<x-layout title="Criar Série">
  <x-series.form :action="route('series.store')" :method="'POST'" :buttonText="'Criar'" />
</x-layout>