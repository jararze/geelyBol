<?php

namespace App\Livewire\Front;

use Livewire\Component;

class DireccionesSection extends Component
{
    public $layout = 'map-cards'; // map-cards, list-only
    public $sectionData = [];

    private $defaultSectionData = [
        'title' => 'DIRECCIONES',
        'subtitle' => 'Encuentra la sucursal Geely más cercana:',
        'map_image' => 'frontend/images/mapa.png',
        'background_color' => '#ffffff',
        'text_color' => '#333333',
        'button_text' => 'Agenda ahora',
        'button_url' => '#',
        'show_map' => true,
        'show_button' => true,
        'locations' => [
            [
                'name' => 'SANTA CRUZ',
                'address' => 'Av. Doble vía La Guardia, esquina calle Yuruma, entre 3er y 4to anillo.',
                'phone' => 'Telf. 336 1909',
                'hours' => '800-125000',
                'city' => 'Santa Cruz - Bolivia',
                'map_link' => '#',
                'icon' => 'location'
            ],
            [
                'name' => 'LA PAZ',
                'address' => 'Av. Doble vía La Guardia, esquina calle Yuruma, entre 3er y 4to anillo.',
                'phone' => 'Telf. 336 1909',
                'hours' => '800-125000',
                'city' => 'Santa Cruz - Bolivia',
                'map_link' => '#',
                'icon' => 'location'
            ]
        ]
    ];

    public function mount($layout = 'map-cards', $sectionData = [])
    {
        $this->layout = $layout;
        $this->sectionData = array_merge($this->defaultSectionData, $sectionData);
    }

    public function render()
    {
        return view('livewire.front.direcciones-section');
    }
}
