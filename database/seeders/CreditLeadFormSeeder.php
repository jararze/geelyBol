<?php

namespace Database\Seeders;

use App\Models\LeadForm;
use App\Models\LeadFormField;
use Illuminate\Database\Seeder;

class CreditLeadFormSeeder extends Seeder
{
    public function run(): void
    {
        $form = LeadForm::updateOrCreate(
            ['slug' => 'credito'],
            [
                'name' => 'Solicitud de Crédito',
                'description' => 'Simula tu crédito y solicita aprobación. Te contactaremos en las próximas 24 horas.',
                'success_message' => '¡Gracias! Hemos recibido tu solicitud. Te contactaremos en las próximas 24 horas.',
                'submit_button_text' => 'Solicitar crédito',
                'notification_emails' => [],
                'email_subject' => 'Nueva solicitud de crédito - {form_name}',
                'public_url' => 'credito',
                'send_confirmation_to_user' => true,
                'confirmation_email_field' => 'email',
                'is_active' => true,
            ]
        );

        $form->fields()->delete();

        $cityOptions = [];
        foreach (['La Paz', 'Santa Cruz', 'Cochabamba', 'Oruro', 'Potosí', 'Tarija', 'Sucre', 'Trinidad', 'El Alto'] as $c) {
            $cityOptions[] = ['label' => $c, 'value' => $c];
        }

        $fields = [
            // Vehículo (campos hidden alimentados por la URL /credito/{vehicle:slug} o el bloque del page builder)
            ['type' => 'hidden', 'name' => 'vehicle_id', 'label' => 'ID vehiculo', 'section' => 'Tu vehículo'],
            ['type' => 'hidden', 'name' => 'vehicle_version_id', 'label' => 'ID version', 'section' => 'Tu vehículo'],
            ['type' => 'hidden', 'name' => 'vehicle_name', 'label' => 'Nombre vehiculo', 'section' => 'Tu vehículo'],

            // Datos del cliente
            ['type' => 'text', 'name' => 'nombre_completo', 'label' => 'Nombre completo', 'is_required' => true, 'section' => 'Tus datos', 'width' => 'full'],
            ['type' => 'email', 'name' => 'email', 'label' => 'Email', 'is_required' => true, 'section' => 'Tus datos', 'width' => 'half'],
            ['type' => 'tel', 'name' => 'telefono', 'label' => 'Teléfono', 'is_required' => true, 'section' => 'Tus datos', 'width' => 'half'],
            ['type' => 'number', 'name' => 'ingresos_mensuales', 'label' => 'Ingresos mensuales (USD)', 'is_required' => true, 'section' => 'Tus datos', 'width' => 'half'],
            ['type' => 'select', 'name' => 'ciudad', 'label' => 'Ciudad', 'is_required' => true, 'section' => 'Tus datos', 'width' => 'half',
                'options' => $cityOptions],

            // Aceptación
            ['type' => 'checkbox', 'name' => 'acepta_disclaimer', 'label' => 'He leído y acepto el disclaimer legal', 'is_required' => true, 'section' => 'Aceptación', 'width' => 'full'],
        ];

        foreach ($fields as $index => $f) {
            $f['order'] = $index + 1;
            $f['lead_form_id'] = $form->id;
            LeadFormField::create($f);
        }

        $this->command?->info("Lead Form 'credito' creado con " . count($fields) . ' campos.');
    }
}
