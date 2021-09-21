<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class PeriodoMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $subject= "Documentos solicitados";
    public $mensaje;
    public $documentos;

    public function __construct($data)
    {
        $this->mensaje= $data['mensaje'];
        $this->documentos = $data['documentos'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->view('emails.documentos');
        
        foreach($this->documentos as $doc) {
            $file = Storage::path("documentosperiodo/{$doc->url_documento}");

            $mail->attach($file, [
                "as" => $doc->nombre_documento
            ]);
        }

        return $mail;
    }

}
