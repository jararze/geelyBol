<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'interest_rate_annual',
        'min_initial_percentage',
        'max_finance_percentage',
        'available_terms',
        'min_amount',
        'max_amount',
        'currency',
        'legal_disclaimer',
    ];

    protected $casts = [
        'available_terms' => 'array',
        'interest_rate_annual' => 'decimal:2',
        'min_initial_percentage' => 'decimal:2',
        'max_finance_percentage' => 'decimal:2',
        'min_amount' => 'decimal:2',
        'max_amount' => 'decimal:2',
    ];

    public static function current(): self
    {
        return self::query()->first() ?? self::create([
            'interest_rate_annual' => 12.00,
            'min_initial_percentage' => 20.00,
            'max_finance_percentage' => 80.00,
            'available_terms' => [12, 24, 36, 48, 60],
            'min_amount' => 5000.00,
            'max_amount' => 80000.00,
            'currency' => 'USD',
            'legal_disclaimer' => 'Esta simulación es referencial. Los valores definitivos están sujetos a aprobación crediticia y evaluación por parte de la entidad financiera.',
        ]);
    }

    public function calculateMonthlyPayment(float $principal, int $termMonths): float
    {
        if ($principal <= 0 || $termMonths <= 0) {
            return 0.0;
        }

        $monthlyRate = ((float) $this->interest_rate_annual / 100) / 12;

        if ($monthlyRate == 0.0) {
            return round($principal / $termMonths, 2);
        }

        $factor = (1 + $monthlyRate) ** $termMonths;
        $payment = ($principal * $monthlyRate * $factor) / ($factor - 1);

        return round($payment, 2);
    }
}
