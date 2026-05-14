<?php

namespace App\Livewire\Leads;

use App\Models\Lead;
use App\Models\LeadForm;
use App\Models\LeadFormField;
use App\Models\Vehicle;
use App\Models\VehicleVersion;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;

class LeadDynamicForm extends Component
{
    use WithFileUploads;

    public LeadForm $leadForm;

    public ?Vehicle $vehicle = null;

    public ?VehicleVersion $version = null;

    public array $data = [];

    public bool $submitted = false;

    public ?string $successMessage = null;

    public function mount(LeadForm $leadForm, ?Vehicle $vehicle = null, ?VehicleVersion $version = null): void
    {
        if (! $leadForm->is_active) {
            abort(404);
        }

        $this->leadForm = $leadForm;
        $this->vehicle = $vehicle;
        $this->version = $version;

        $this->initializeData();
    }

    protected function initializeData(): void
    {
        foreach ($this->leadForm->fields as $field) {
            if (! $field->isInput()) {
                continue;
            }

            $default = $field->default_value;

            if (in_array($field->type, ['multi_select', 'checkbox_group'], true)) {
                $this->data[$field->name] = is_array($default)
                    ? $default
                    : (filled($default) ? [$default] : []);
            } elseif ($field->type === 'checkbox') {
                $this->data[$field->name] = (bool) $default;
            } else {
                $this->data[$field->name] = $default;
            }
        }

        if ($this->vehicle) {
            $this->data['vehicle_id'] = $this->vehicle->id;
            $this->data['vehicle_name'] = $this->vehicle->name;
            if ($this->vehicle->price_now ?? null) {
                $this->data['vehicle_price'] = (float) str_replace(['.', ','], ['', '.'], (string) $this->vehicle->price_now);
            }
        }

        if ($this->version) {
            $this->data['vehicle_version_id'] = $this->version->id;
            $this->data['vehicle_version_name'] = $this->version->name;
        }
    }

    public function getSectionsProperty(): Collection
    {
        return $this->leadForm->getFieldsBySection();
    }

    public function getLiveFieldNamesProperty(): array
    {
        return $this->leadForm->fields
            ->pluck('conditional_logic.field')
            ->filter()
            ->unique()
            ->values()
            ->all();
    }

    public function isFieldVisible(LeadFormField $field): bool
    {
        return $field->isVisible($this->data);
    }

    protected function rules(): array
    {
        $rules = [];
        foreach ($this->leadForm->fields as $field) {
            if (! $field->isInput() || ! $this->isFieldVisible($field)) {
                continue;
            }
            $fieldRules = $field->getValidationRules();
            if (! empty($fieldRules)) {
                $rules['data.' . $field->name] = $fieldRules;
            }
        }
        return $rules;
    }

    protected function messages(): array
    {
        $messages = [];
        foreach ($this->leadForm->fields as $field) {
            $key = 'data.' . $field->name;
            $messages[$key . '.required'] = 'Este campo es obligatorio.';
            $messages[$key . '.email'] = 'Email invalido.';
            $messages[$key . '.url'] = 'URL invalida.';
            $messages[$key . '.numeric'] = 'Debe ser un numero.';
            $messages[$key . '.date'] = 'Fecha invalida.';
            $messages[$key . '.array'] = 'Selecciona al menos una opcion.';
            $messages[$key . '.accepted'] = 'Debes aceptar esta opcion.';
        }
        return $messages;
    }

    public function submit()
    {
        $this->validate();

        $payload = collect($this->data)->mapWithKeys(function ($value, $key) {
            if (is_string($value)) {
                $value = trim($value);
            }
            return [$key => $value];
        })->toArray();

        $lead = Lead::create([
            'lead_form_id' => $this->leadForm->id,
            'data' => $payload,
            'ip_address' => $this->getClientIp(),
            'user_agent' => request()->userAgent(),
            'referer' => request()->headers->get('referer'),
            'status' => Lead::STATUS_NEW,
            'vehicle_id' => $this->vehicle?->id ?? ($payload['vehicle_id'] ?? null),
            'vehicle_version_id' => $this->version?->id ?? ($payload['vehicle_version_id'] ?? null),
        ]);

        $this->leadForm->increment('submit_count');

        if (class_exists(\App\Events\LeadCaptured::class)) {
            event(new \App\Events\LeadCaptured($this->leadForm->fresh(), $lead));
        }

        if ($this->leadForm->redirect_url) {
            return redirect($this->leadForm->redirect_url);
        }

        $this->submitted = true;
        $this->successMessage = $this->leadForm->success_message ?: 'Gracias, hemos recibido tu información.';

        return null;
    }

    protected function getClientIp(): ?string
    {
        if ($ip = request()->header('CF-Connecting-IP')) {
            return $ip;
        }
        if ($forwarded = request()->header('X-Forwarded-For')) {
            return trim(explode(',', $forwarded)[0]);
        }
        return request()->ip();
    }

    public function render()
    {
        return view('livewire.leads.lead-dynamic-form')
            ->layout('components.layouts.frontend.front');
    }
}
