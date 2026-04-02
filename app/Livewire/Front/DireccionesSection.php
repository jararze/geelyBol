<?php

namespace App\Livewire\Front;

use App\Models\Branch;
use Livewire\Component;

class DireccionesSection extends Component
{
    public $layout = 'map-cards';
    public $sectionData = [];

    public function mount($layout = 'map-cards', $sectionData = [])
    {
        $this->layout = $layout;

        $defaultData = [
            'title' => 'DIRECCIONES',
            'subtitle' => 'Encuentra la sucursal Geely más cercana:',
            'map_image' => 'frontend/images/mapa.png',
            'background_color' => '#ffffff',
            'text_color' => '#333333',
            'button_text' => 'Agenda ahora',
            'button_url' => '#',
            'show_map' => true,
            'show_button' => false,
            'locations' => $this->loadLocationsFromDatabase(),
        ];

        $this->sectionData = array_merge($defaultData, $sectionData);
    }

    private function loadLocationsFromDatabase(): array
    {
        $branches = Branch::active()->ordered()->get();

        if ($branches->isNotEmpty()) {
            return $branches->map(function ($branch) {
                return [
                    'name' => $branch->name,
                    'address' => $branch->address ?? '',
                    'phone' => $branch->phone ?? '',
                    'hours' => $branch->hours ?? '',
                    'city' => ($branch->city ?? '') . ' - Bolivia',
                    'map_link' => $branch->map_link ?? '',
                    'icon' => 'location',
                ];
            })->toArray();
        }

        // LEGACY - datos hardcodeados
        return [
            ['name' => 'SANTA CRUZ', 'address' => 'Av. Doble Vía La Guardia N° 3325 Esq. Calle Rio Vilcas, entre 3er y 4to anillo', 'phone' => '', 'hours' => '', 'city' => 'Santa Cruz - Bolivia', 'map_link' => 'https://maps.app.goo.gl/YQfPVMbUyNH6RjrU8', 'icon' => 'location'],
            ['name' => 'LA PAZ', 'address' => 'Calacoto, Calle 15 esq. Roberto Prudencio #520', 'phone' => '', 'hours' => '', 'city' => 'La Paz - Bolivia', 'map_link' => 'https://maps.app.goo.gl/veuGtGn2iECCP9Ez8', 'icon' => 'location'],
            ['name' => 'El Alto', 'address' => 'Av. 6 de Marzo N° 1306 Frente Regimiento Ingavi', 'phone' => '', 'hours' => '', 'city' => 'El Alto - Bolivia', 'map_link' => 'https://maps.app.goo.gl/veuGtGn2iECCP9Ez8', 'icon' => 'location'],
            ['name' => 'Cochabamba', 'address' => 'Av. Pando N° 1191, Recoleta', 'phone' => '', 'hours' => '', 'city' => 'Cochabamba - Bolivia', 'map_link' => 'https://maps.app.goo.gl/veuGtGn2iECCP9Ez8', 'icon' => 'location'],
            ['name' => 'ORURO', 'address' => 'Av. 6 de Agosto #853', 'phone' => '', 'hours' => '', 'city' => 'Oruro - Bolivia', 'map_link' => 'https://maps.app.goo.gl/DBPsGLxpBea5TroT6', 'icon' => 'location'],
        ];
    }

    public function render()
    {
        return view('livewire.front.direcciones-section');
    }
}
