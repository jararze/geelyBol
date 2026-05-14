<?php

namespace App\Listeners;

use App\Events\LeadCaptured;
use App\Mail\LeadConfirmationMail;
use App\Mail\NewLeadMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendLeadNotifications implements ShouldQueue
{
    public function handle(LeadCaptured $event): void
    {
        $leadForm = $event->leadForm;
        $lead = $event->lead;

        $recipients = is_array($leadForm->notification_emails)
            ? array_filter($leadForm->notification_emails, fn ($e) => filter_var($e, FILTER_VALIDATE_EMAIL))
            : [];

        foreach ($recipients as $email) {
            try {
                Mail::to($email)->send(new NewLeadMail($leadForm, $lead));
            } catch (\Throwable $e) {
                Log::error('Error enviando NewLeadMail', [
                    'recipient' => $email,
                    'lead_id' => $lead->id,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        if ($leadForm->send_confirmation_to_user && $leadForm->confirmation_email_field) {
            $customerEmail = $lead->data[$leadForm->confirmation_email_field] ?? null;
            if ($customerEmail && filter_var($customerEmail, FILTER_VALIDATE_EMAIL)) {
                $customerName = $lead->data['nombre_completo']
                    ?? $lead->data['nombre']
                    ?? $lead->data['first_name']
                    ?? $lead->data['name']
                    ?? null;
                try {
                    Mail::to($customerEmail)->send(new LeadConfirmationMail($leadForm, $lead, $customerName));
                } catch (\Throwable $e) {
                    Log::error('Error enviando LeadConfirmationMail', [
                        'recipient' => $customerEmail,
                        'lead_id' => $lead->id,
                        'error' => $e->getMessage(),
                    ]);
                }
            }
        }
    }
}
