<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewStudentRegisteredNotification extends Mailable
{
    use Queueable, SerializesModels;

    public string $registeredAt;

    public function __construct(public readonly User $student)
    {
        $this->registeredAt = $student->created_at->format('d M Y \a\t g:i A');
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Student Registration — ' . $this->student->name,
        );
    }

    public function content(): Content
    {
        return new Content(view: 'mail.admin-new-student');
    }
}
