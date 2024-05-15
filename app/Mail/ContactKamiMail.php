<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\kontak\Kontak;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactKamiMail extends Mailable
{
    use Queueable, SerializesModels;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $kontak;
    public function __construct($data = array())
    {
        $this->kontak = $data; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.contact.saran-kami')
            ->with(
            [
                'nama' => $this->kontak['nama'],
                'email' => $this->kontak['email'],
                'telphone' => $this->kontak['telphone'],
                'subject' => $this->kontak['subject'],
                'user_message' => $this->kontak['saran'],
            ]);
    }
}
