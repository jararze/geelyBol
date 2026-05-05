<?php

namespace App\Livewire\Front;

use App\Models\Vehicle;
use Livewire\Component;

class VehicleShow extends Component
{
    public Vehicle $vehicle;

    public array $blocks = [];

    public function mount(string $slug): void
    {
        $this->vehicle = Vehicle::with(['category'])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $this->blocks = $this->vehicle->page_blocks ?? [];
    }

    public function render()
    {
        return view('livewire.front.vehicle-show', [
            'vehicle' => $this->vehicle,
            'blocks' => $this->blocks,
        ])->layout('components.layouts.frontend.front');
    }
}
