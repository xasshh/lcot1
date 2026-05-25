<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyEmailMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly User $user,
        public readonly string $url,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            to: $this->user->email,
            subject: 'Verify Your Email Address — LCOT Student Portal',
        );
    }

    public function content(): Content
    {
        return new Content(view: 'mail.verify-email');
    }
}
