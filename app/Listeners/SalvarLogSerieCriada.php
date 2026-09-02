<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SalvarLogSerieCriada implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        Log::info('Serie criada', [
            'id' => $event->id,
            'title' => $event->title,
            'temporadas' => $event->temporadas,
            'episodios' => $event->episodios,
        ]);
    }
}
