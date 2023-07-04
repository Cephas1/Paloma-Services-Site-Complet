<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class PostResumeMail extends Mailable
{
    use Queueable, SerializesModels;


    protected $data;
    //protected $resume;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail)
    {
        $this->data = $mail;
        //$this->resume = $resume;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'CANDIDATURE SPONTANNEE',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.postResumeMail',
            with: ['data' => $this->data]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments() : array
    {
        return [
            Attachment::fromPath( storage_path('app/' . $this->data['resume']))
                        ->as('Curriculum_Vitae.pdf')
                        ->withMime('application/pdf'),
        ];
    }
}
