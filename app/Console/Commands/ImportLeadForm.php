<?php

namespace App\Console\Commands;

use App\Models\LeadForm;
use App\Models\LeadFormField;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportLeadForm extends Command
{
    protected $signature = 'leads:import {file : Ruta absoluta o relativa al JSON exportado}';

    protected $description = 'Importa un LeadForm desde un JSON exportado. updateOrCreate por slug, sincroniza campos.';

    public function handle(): int
    {
        $file = $this->argument('file');

        if (! file_exists($file)) {
            $this->error("Archivo no encontrado: {$file}");
            return self::FAILURE;
        }

        $payload = json_decode(file_get_contents($file), true);
        if (! is_array($payload) || ! isset($payload['form']['slug'])) {
            $this->error('El archivo JSON no tiene la estructura esperada (form.slug requerido).');
            return self::FAILURE;
        }

        DB::transaction(function () use ($payload) {
            $formData = $payload['form'];
            $slug = $formData['slug'];

            $form = LeadForm::updateOrCreate(['slug' => $slug], $formData);

            $incomingFields = collect($payload['fields'] ?? []);
            $incomingNames = $incomingFields->pluck('name')->all();

            $form->fields()->whereNotIn('name', $incomingNames)->delete();

            foreach ($incomingFields as $fieldData) {
                LeadFormField::updateOrCreate(
                    [
                        'lead_form_id' => $form->id,
                        'name' => $fieldData['name'],
                    ],
                    $fieldData + ['lead_form_id' => $form->id]
                );
            }

            $this->info("Importado: {$form->name} ({$slug}) con " . count($incomingFields) . ' campos.');
        });

        return self::SUCCESS;
    }
}
