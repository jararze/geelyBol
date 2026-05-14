<?php

namespace App\Console\Commands;

use App\Models\LeadForm;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ExportLeadForm extends Command
{
    protected $signature = 'leads:export {slug : Slug del LeadForm a exportar}';

    protected $description = 'Exporta un LeadForm y sus campos a JSON portable en storage/app/forms/{slug}.json';

    public function handle(): int
    {
        $slug = $this->argument('slug');

        $form = LeadForm::where('slug', $slug)->first();
        if (! $form) {
            $this->error("No se encontro un LeadForm con slug '{$slug}'.");
            return self::FAILURE;
        }

        $payload = [
            'form' => $form->only([
                'name', 'slug', 'description', 'success_message', 'submit_button_text',
                'notification_emails', 'email_subject', 'public_url', 'redirect_url',
                'send_confirmation_to_user', 'confirmation_email_field', 'is_active',
            ]),
            'fields' => $form->fields()->orderBy('order')->get()->map(fn ($f) => $f->only([
                'order', 'type', 'name', 'label', 'placeholder', 'help_text',
                'is_required', 'options', 'validation_rules', 'default_value',
                'conditional_logic', 'width', 'section',
            ]))->all(),
            'exported_at' => now()->toIso8601String(),
        ];

        Storage::disk('local')->makeDirectory('forms');
        $filename = "forms/{$slug}.json";
        Storage::disk('local')->put($filename, json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        $path = Storage::disk('local')->path($filename);

        $this->info("Exportado a: {$path}");
        $this->info('Campos exportados: ' . count($payload['fields']));

        return self::SUCCESS;
    }
}
