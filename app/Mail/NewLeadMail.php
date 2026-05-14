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

class NewLeadMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public LeadForm $leadForm,
        public Lead $lead,
    ) {}

    public function envelope(): Envelope
    {
        $subject = $this->leadForm->email_subject
            ?: 'Nuevo lead: ' . $this->leadForm->name;

        $subject = str_replace('{form_name}', $this->leadForm->name, $subject);

        return new Envelope(subject: $subject);
    }

    public function content(): Content
    {
        $fieldLabels = $this->leadForm->fields()->pluck('label', 'name')->toArray();

        return new Content(
            view: 'emails.new-lead',
            with: [
                'leadForm' => $this->leadForm,
                'lead' => $this->lead,
                'fieldLabels' => $fieldLabels,
                'adminUrl' => url('/admin/leads/' . $this->lead->id),
            ],
        );
    }
}
