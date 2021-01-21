<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QRMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $subject= "Aqui esta tu Codigo QR";
    public $qr;
    public $nombre_empresa;

    public function __construct($data)
    {   
        $this->qr= $data['qr'];
        $this->nombre_empresa= $data['nombre_empresa'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.qr');
    }
}
