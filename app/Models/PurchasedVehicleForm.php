<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasedVehicleForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'second_last_name',
        'gender',
        'nationality',
        'id_document',
        'birth_date',
        'mobile_phone',
        'email',
        'wants_promotions',
        'promo_whatsapp',
        'promo_email',
        'promo_sms',
        'no_promotions',
        'city',
        'neighborhood',
        'full_address',
        'marital_status',
        'has_children',
        'number_of_children',
        'work_field',
        'sales_advisor_name',
        'purchased_vehicle',
        'vehicle_attractive_feature',
        'hobbies',
        'education_level',
        'main_driver'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'wants_promotions' => 'boolean',
        'promo_whatsapp' => 'boolean',
        'promo_email' => 'boolean',
        'promo_sms' => 'boolean',
        'no_promotions' => 'boolean',
        'has_children' => 'boolean',
        'hobbies' => 'array'
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name . ' ' . $this->second_last_name;
    }
}
