<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MyEmailWithAttachment extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

     public $data;
     public $attachments;
    public function __construct(array $data, array $attachments = [])
    {
        $this->data = $data;
        $this->attachments = $attachments;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'My Email With Attachment',
        );
    }



    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.my_email_view',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
        $email = $this->view('emails.my_email_view')
        ->with('data', $this->data);

        $this->buildAttachments($email);

        return $email;
    }

    protected function buildAttachments($message)
    {
        foreach ($this->attachments as $attachment) {
            // Ensure each attachment has a file and options defined
            if (isset($attachment['file'])) {
                $options = $attachment['options'] ?? []; // Use default options if not provided
                $message->attach($attachment['file'], $options);
            }
        }
    }
}
