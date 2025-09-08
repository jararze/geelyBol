<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_formulario',
        'nombre',
        'email',
        'telefono',
        'codigo_pais',
        'ciudad',
        'vehiculo',
        'mensaje',
        'receive_offers',
        'categoria_vehiculo',
        'slug_vehiculo',
        'datos_completos'
    ];

    protected $casts = [
        'receive_offers' => 'boolean',
        'datos_completos' => 'array'
    ];
}
