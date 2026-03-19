<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class CertificateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $certificate;
    public $pdfContent;
    public $fileName;

    public function __construct($certificate, $pdfContent, $fileName)
    {
        $this->certificate = $certificate;
        $this->pdfContent = $pdfContent;
        $this->fileName = $fileName;
    }

    public function build()
    {
        return $this->subject('🏆 Your Certificate from Smart NGO')
                    ->view('emails.certificate')
                    ->attachData($this->pdfContent, $this->fileName, [
                        'mime' => 'application/pdf',
                    ]);
    }
}
