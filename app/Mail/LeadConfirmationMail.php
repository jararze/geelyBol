<?php

namespace App\Mail;

use App\Models\Lead;
use App\Models\LeadForm;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LeadConfirmationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public LeadForm $leadForm,
        public Lead $lead,
        public ?string $customerName = null,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Hemos recibido tu información - Geely Bolivia',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.lead-confirmation',
            with: [
                'leadForm' => $this->leadForm,
                'lead' => $this->lead,
                'customerName' => $this->customerName,
            ],
        );
    }
}
