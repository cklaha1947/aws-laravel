<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Welcomeemail extends Mailable
{
    use Queueable, SerializesModels;

    public $request;
    public $fileName1;
    public $fileName2;
    public $fileName3;
    public $fileName4;
    public $fileName5;

    public function __construct(
        $request,
        $fileName1,
        $fileName2,
        $fileName3,
        $fileName4,
        $fileName5
    ) {
        $this->request = $request;
        $this->fileName1 = $fileName1;
        $this->fileName2 = $fileName2;
        $this->fileName3 = $fileName3;
        $this->fileName4 = $fileName4;
        $this->fileName5 = $fileName5;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contact Form Submission',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.welcomeemail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];

        $fileNames = [
            $this->fileName1,
            $this->fileName2,
            $this->fileName3,
            $this->fileName4,
            $this->fileName5,
        ];

        foreach ($fileNames as $fileName) {
            if ($fileName) {
                $path = public_path('uploads/' . $fileName);

                if (file_exists($path)) {
                    $attachments[] = Attachment::fromPath($path);
                }
            }
        }

        return $attachments;
    }
}
