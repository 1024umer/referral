<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EventMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $name;
    protected $email;
    protected $number;
    protected $people;
    protected $event_title;
    /**
     * Create a new message instance.
     */
    public function __construct($name,$email,$number,$people,$event_title)
    {
        $this->name = $name;
        $this->email = $email;
        $this->number = $number;
        $this->people = $people;
        $this->event_title = $event_title;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Event Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->markdown('mail.event')
            ->with([
                'name' => $this->name,
                'email' => $this->email,
                'number' => $this->number,
                'people' => $this->people,
                'event_title' => $this->event_title,
            ])
            ->subject('Event Mail');
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
