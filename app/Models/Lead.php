<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lead extends Model
{
    use HasFactory;

    public const STATUS_NEW = 'new';
    public const STATUS_READ = 'read';
    public const STATUS_CONTACTED = 'contacted';
    public const STATUS_CONVERTED = 'converted';
    public const STATUS_ARCHIVED = 'archived';

    protected $fillable = [
        'lead_form_id',
        'data',
        'ip_address',
        'user_agent',
        'referer',
        'status',
        'notes',
        'vehicle_id',
        'vehicle_version_id',
        'handled_by',
        'handled_at',
    ];

    protected $casts = [
        'data' => 'array',
        'handled_at' => 'datetime',
    ];

    public function leadForm(): BelongsTo
    {
        return $this->belongsTo(LeadForm::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function vehicleVersion(): BelongsTo
    {
        return $this->belongsTo(VehicleVersion::class);
    }

    public function handler(): BelongsTo
    {
        return $this->belongsTo(User::class, 'handled_by');
    }

    public function scopeNew(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_NEW);
    }

    public function scopeUnread(Builder $query): Builder
    {
        return $query->whereIn('status', [self::STATUS_NEW]);
    }
}
