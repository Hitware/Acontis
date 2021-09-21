<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventoMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $subject= "Invitación a Evento";
    public $nombre_empresa;
    public $nombre_evento;
    public $descripcion_evento;
    public function __construct($data)
    {
        $this->nombre_empresa= $data['nombre_empresa'];
        $this->nombre_evento= $data['nombre_evento'];
        $this->descripcion_evento= $data['descripcion_evento'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.evento');
    }
}
