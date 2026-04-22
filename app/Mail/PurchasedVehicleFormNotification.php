<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PurchasedVehicleFormNotification extends Mailable
{
    use Queueable, SerializesModels;

    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function envelope(): Envelope
    {
        $fullName = trim(
            ($this->data['first_name'] ?? '') . ' ' .
            ($this->data['last_name'] ?? '') . ' ' .
            ($this->data['second_last_name'] ?? '')
        );

        $vehicleMap = [
            'starray' => 'Starray',
            'gx3-pro' => 'GX3 Pro',
            'cityray' => 'Cityray',
            'coolray' => 'Coolray Lite',
        ];

        $vehicleKey = $this->data['purchased_vehicle'] ?? '';
        $vehicle = $vehicleMap[$vehicleKey] ?? $vehicleKey;

        return new Envelope(
            subject: "Nuevo registro de cliente - {$fullName} - {$vehicle}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.purchased-vehicle-notification',
            with: [
                'data' => $this->data,
            ],
        );
    }
}
