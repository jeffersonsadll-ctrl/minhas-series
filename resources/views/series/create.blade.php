<x-layout title="Criar Série">
  <x-series.formCreate :action="route('series.store')" :method="'POST'" :buttonText="'Criar'" />
</x-layout>