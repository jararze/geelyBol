<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeadFormField extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_form_id',
        'order',
        'type',
        'name',
        'label',
        'placeholder',
        'help_text',
        'is_required',
        'options',
        'validation_rules',
        'default_value',
        'conditional_logic',
        'width',
        'section',
    ];

    protected $casts = [
        'options' => 'array',
        'validation_rules' => 'array',
        'conditional_logic' => 'array',
        'is_required' => 'boolean',
        'order' => 'integer',
    ];

    public const TYPES_INPUT = [
        'text', 'email', 'tel', 'number', 'url', 'textarea',
        'select', 'multi_select', 'radio', 'checkbox_group', 'checkbox',
        'date', 'datetime', 'file', 'hidden',
    ];

    public const TYPES_PRESENTATIONAL = [
        'heading', 'paragraph', 'divider',
    ];

    public function leadForm(): BelongsTo
    {
        return $this->belongsTo(LeadForm::class);
    }

    public function isInput(): bool
    {
        return in_array($this->type, self::TYPES_INPUT, true);
    }

    public function isPresentational(): bool
    {
        return in_array($this->type, self::TYPES_PRESENTATIONAL, true);
    }

    public function getValidationRules(): array
    {
        if (! $this->isInput()) {
            return [];
        }

        $rules = [];

        if ($this->is_required) {
            $rules[] = $this->type === 'checkbox' ? 'accepted' : 'required';
        } else {
            $rules[] = 'nullable';
        }

        $rules = array_merge($rules, $this->typeRules());

        if (is_array($this->validation_rules)) {
            $rules = array_merge($rules, $this->validation_rules);
        }

        return array_values(array_unique($rules));
    }

    public function isVisible(array $data): bool
    {
        $logic = $this->conditional_logic;
        if (! is_array($logic) || empty($logic['field'])) {
            return true;
        }

        $targetField = $logic['field'];
        $operator = $logic['operator'] ?? '=';
        $expectedValue = $logic['value'] ?? null;
        $actualValue = $data[$targetField] ?? null;

        return match ($operator) {
            '=', '==' => (string) $actualValue === (string) $expectedValue,
            '!=' => (string) $actualValue !== (string) $expectedValue,
            'in' => is_array($expectedValue) && in_array($actualValue, $expectedValue, true),
            'not_in' => is_array($expectedValue) && ! in_array($actualValue, $expectedValue, true),
            'contains' => is_array($actualValue)
                ? in_array($expectedValue, $actualValue, true)
                : str_contains((string) $actualValue, (string) $expectedValue),
            'filled' => ! empty($actualValue),
            'empty' => empty($actualValue),
            default => true,
        };
    }

    protected function typeRules(): array
    {
        return match ($this->type) {
            'email' => ['email'],
            'url' => ['url'],
            'number' => ['numeric'],
            'tel' => ['string'],
            'date', 'datetime' => ['date'],
            'multi_select', 'checkbox_group' => ['array'],
            'checkbox' => ['boolean'],
            'file' => ['file'],
            default => [],
        };
    }
}
