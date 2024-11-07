<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $responseBody;
    public $responseTitle;

    public function __construct($responseTitle, $responseBody)
    {
        $this->responseTitle = $responseTitle;
        $this->responseBody = $responseBody;
    }

    public function build()
    {
        return $this->from('where25.inquiry@gmail.com', 'Where To Go')
                    ->subject($this->responseTitle)
                    ->view('admin.inquiries.emails.reply')
                    ->with([
                        'responseBody' => $this->responseBody,
                    ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reply Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'admin.inquiries.emails.reply',
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
