<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class DonationReceiptMail extends Mailable
{
    use Queueable, SerializesModels;

    public $donation;
    public $pdfContent;
    public $fileName;

    public function __construct($donation, $pdfContent, $fileName)
    {
        $this->donation = $donation;
        $this->pdfContent = $pdfContent;
        $this->fileName = $fileName;
    }

    public function build()
    {
        return $this->subject('🙏 Thank You for Your Donation - Receipt from Smart NGO')
                    ->view('emails.donation-receipt')
                    ->attachData($this->pdfContent, $this->fileName, [
                        'mime' => 'application/pdf',
                    ]);
    }
}
