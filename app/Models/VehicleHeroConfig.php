<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleHeroConfig extends Model
{
    protected $guarded = [];

    protected $casts = [
        'selected_specs' => 'array',
        'is_active' => 'boolean',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
