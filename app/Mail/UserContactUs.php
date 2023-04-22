<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserContactUs extends Mailable
{
    use Queueable, SerializesModels;
    public $email;
    public $content;

    /**
     * Create a new message instance.
     */
    public function __construct($content)
    {
        $this->email = $content->email;
        $this->content = $content;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'CLB Customer Support',
            from: $this->email,
            to: 'romanricakam@gmail.com',
            tags: ['customer support'],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content($content): Content
    {
        return new Content(
            view: 'emails.customer.mail',
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

}
