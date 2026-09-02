<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use App\Events\SerieCriada;
use App\Listeners\EmailEnviarUsuariosSerieCriada;
use App\Listeners\SalvarLogSerieCriada;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        SerieCriada::class => [
            EmailEnviarUsuariosSerieCriada::class,
            SalvarLogSerieCriada::class,
        ],
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Illuminate\Support\ServiceProvider nao le $listen automaticamente; registrar manualmente
        foreach ($this->listen as $event => $listeners) {
            foreach ($listeners as $listener) {
                Event::listen($event, $listener);
            }
        }
    }
}
