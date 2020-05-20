<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailSender extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $subject = '';
    public $message = '';
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $message, $data)
    {
        $this->subject = $subject;
        $this->message = $message;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from('dvpgridtest@gmail.com')
            ->view('mail', [
                'subject' => $this->subject,
                'contentMessage' => $this->message,
                'username' => $this->data,
            ]);
    }
}