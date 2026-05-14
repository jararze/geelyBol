<?php

namespace App\Livewire\Leads;

use App\Models\CreditSetting;
use App\Models\LeadForm;
use App\Models\Vehicle;
use App\Models\VehicleVersion;

class CreditForm extends LeadDynamicForm
{
    public ?float $vehicle_price = null;

    public ?float $initial_amount = null;

    public ?int $term_months = null;

    public CreditSetting $creditSettings;

    public function mount(?LeadForm $leadForm = null, ?Vehicle $vehicle = null, ?VehicleVersion $version = null): void
    {
        $leadForm = $leadForm ?: LeadForm::where('slug', 'credito')->where('is_active', true)->firstOrFail();

        parent::mount($leadForm, $vehicle, $version);

        $this->creditSettings = CreditSetting::current();

        if ($vehicle && ! $this->vehicle_price) {
            $price = $vehicle->price_now ?? $vehicle->price_before ?? null;
            if ($price) {
                $this->vehicle_price = (float) preg_replace('/[^0-9.]/', '', (string) $price);
            }
        }

        if (! $this->vehicle_price) {
            $this->vehicle_price = (float) $this->creditSettings->min_amount;
        }

        $this->initial_amount = round($this->vehicle_price * ((float) $this->creditSettings->min_initial_percentage / 100), 2);

        $terms = $this->creditSettings->available_terms ?: [12, 24, 36, 48, 60];
        $this->term_months = (int) $terms[(int) floor(count($terms) / 2)];
    }

    public function updatedVehiclePrice(): void
    {
        $minPct = (float) $this->creditSettings->min_initial_percentage / 100;
        if ($this->vehicle_price && $this->initial_amount < $this->vehicle_price * $minPct) {
            $this->initial_amount = round($this->vehicle_price * $minPct, 2);
        }
    }

    public function getAvailableTermsProperty(): array
    {
        return $this->creditSettings->available_terms ?: [12, 24, 36, 48, 60];
    }

    public function getMinInitialAmountProperty(): float
    {
        return round(((float) $this->vehicle_price) * ((float) $this->creditSettings->min_initial_percentage / 100), 2);
    }

    public function getMaxInitialAmountProperty(): float
    {
        $maxFinanced = (float) $this->vehicle_price * ((float) $this->creditSettings->max_finance_percentage / 100);
        return round(((float) $this->vehicle_price) - $maxFinanced, 2);
    }

    public function getFinancedAmountProperty(): float
    {
        return max(0.0, round(((float) $this->vehicle_price) - ((float) $this->initial_amount), 2));
    }

    public function getMonthlyPaymentProperty(): float
    {
        return $this->creditSettings->calculateMonthlyPayment(
            $this->financedAmount,
            (int) ($this->term_months ?: 0)
        );
    }

    public function getTotalToPayProperty(): float
    {
        return round($this->monthlyPayment * (int) $this->term_months + (float) $this->initial_amount, 2);
    }

    public function getCurrencyProperty(): string
    {
        return $this->creditSettings->currency ?: 'USD';
    }

    protected function rules(): array
    {
        $rules = parent::rules();
        $rules['vehicle_price'] = ['required', 'numeric', 'min:' . $this->creditSettings->min_amount, 'max:' . $this->creditSettings->max_amount];
        $rules['initial_amount'] = ['required', 'numeric', 'min:' . $this->minInitialAmount];
        $rules['term_months'] = ['required', 'integer', 'in:' . implode(',', $this->availableTerms)];
        return $rules;
    }

    public function submit()
    {
        $this->data['vehicle_price'] = $this->vehicle_price;
        $this->data['initial_amount'] = $this->initial_amount;
        $this->data['term_months'] = $this->term_months;
        $this->data['financed_amount'] = $this->financedAmount;
        $this->data['monthly_payment'] = $this->monthlyPayment;
        $this->data['total_to_pay'] = $this->totalToPay;
        $this->data['currency'] = $this->currency;

        return parent::submit();
    }

    public function render()
    {
        return view('livewire.leads.credit-form')
            ->layout('components.layouts.frontend.front');
    }
}
