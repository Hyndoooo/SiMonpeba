<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifikasiOrtu extends Mailable
{
    use Queueable, SerializesModels;

    public $pengirim;
    public $pesan;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pengirim, $pesan)
    {
        $this->pengirim = $pengirim;
        $this->pesan = $pesan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pesan Baru')
                    ->view('emails.notifikasipesan_ortu');
    }
}
