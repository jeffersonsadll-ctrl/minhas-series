<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SerieCriada;

class EmailEnviarUsuariosSerieCriada implements ShouldQueue
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
        $listaUsuarios = User::all();
        // enviar email para usuario logado
        foreach ($listaUsuarios as $ind => $usuario) {
            $timeQuando = now()->addSeconds($ind * 20);
            Mail::to($usuario)->later($timeQuando, new SerieCriada(
                $event->id,
                $event->title,
                $event->temporadas,
                $event->episodios
            ));    
        }
    }
}
