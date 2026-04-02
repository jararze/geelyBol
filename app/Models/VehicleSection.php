<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleSection extends Model
{
    protected $guarded = [];

    protected $casts = [
        'config' => 'array',
        'is_active' => 'boolean',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function items()
    {
        return $this->hasMany(VehicleSectionItem::class)->orderBy('order');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function scopeOfType($query, string $type)
    {
        return $query->where('section_type', $type);
    }
}
