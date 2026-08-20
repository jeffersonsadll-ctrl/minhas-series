<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SerieCriada extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public int $idSerie,
        public string $nomeSerie,
        public int $qtdTemporadas,
        public int $episodiosPorTemporada,
    )
    {
        $this->subject = 'Série Criada';
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Série Criada',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'email.serie-criada',
            with: [
                'idSerie' => $this->idSerie,
                'nomeSerie' => $this->nomeSerie,
                'qtdTemporadas' => $this->qtdTemporadas,
                'episodiosPorTemporada' => $this->episodiosPorTemporada,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
