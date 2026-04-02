<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleSectionItem extends Model
{
    protected $guarded = [];

    protected $casts = [
        'overlay' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function section()
    {
        return $this->belongsTo(VehicleSection::class, 'vehicle_section_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
