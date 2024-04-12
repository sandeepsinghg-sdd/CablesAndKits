<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DecryptionKeyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $decryptionKey;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($decryptionKey)
    {
        $this->decryptionKey = $decryptionKey;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.decryption_key')
                    ->with([
                        'decryptionKey' => $this->decryptionKey,
                    ]);
    }
}