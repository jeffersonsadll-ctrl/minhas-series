<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SeriesRepositoryProvider extends ServiceProvider
{
    public array $bindings = [
        \App\Repositories\SeriesInterface::class => \App\Repositories\SeriesRepository::class,
    ];
}
