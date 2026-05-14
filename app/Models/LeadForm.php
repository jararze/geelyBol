<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class LeadForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'success_message',
        'submit_button_text',
        'notification_emails',
        'email_subject',
        'public_url',
        'redirect_url',
        'send_confirmation_to_user',
        'confirmation_email_field',
        'is_active',
        'submit_count',
    ];

    protected $casts = [
        'notification_emails' => 'array',
        'is_active' => 'boolean',
        'submit_count' => 'integer',
        'send_confirmation_to_user' => 'boolean',
    ];

    protected $attributes = [
        'success_message' => 'Gracias, hemos recibido tu información.',
        'submit_button_text' => 'Enviar',
    ];

    public function fields(): HasMany
    {
        return $this->hasMany(LeadFormField::class)->orderBy('order');
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }

    public function getResolvedUrlAttribute(): string
    {
        return $this->public_url
            ? '/' . ltrim($this->public_url, '/')
            : '/lead/' . $this->slug;
    }

    public function getFieldsBySection(): Collection
    {
        return $this->fields
            ->groupBy(fn (LeadFormField $field) => $field->section ?: '__default__')
            ->map(fn (Collection $group) => $group->values());
    }
}
