<?php

namespace App\Events;

use App\Models\Lead;
use App\Models\LeadForm;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LeadCaptured
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public LeadForm $leadForm,
        public Lead $lead,
    ) {}
}
