<?php

namespace App\Livewire\Front;

use App\Models\Vehicle;
use App\Services\VehicleBlocksDefaults;
use Livewire\Component;

class VehicleShow extends Component
{
    public Vehicle $vehicle;

    public array $blocks = [];

    public function mount(string $slug): void
    {
        $this->vehicle = Vehicle::with(['category', 'versions'])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $stored = $this->vehicle->page_blocks;
        $this->blocks = ! empty($stored)
            ? $stored
            : VehicleBlocksDefaults::generate($this->vehicle);
    }

    public function render()
    {
        return view('livewire.front.vehicle-show', [
            'vehicle' => $this->vehicle,
            'blocks' => $this->blocks,
            'versions' => $this->vehicle->versions,
        ])->layout('components.layouts.frontend.front');
    }
}
