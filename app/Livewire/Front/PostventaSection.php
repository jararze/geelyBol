<?php

namespace App\Livewire\Front;

use Livewire\Component;

class PostventaSection extends Component
{

    public $layout = 'split-right'; // split-right, compact, overlay-left
    public $sectionData = [];

    private $defaultSectionData = [
        'title' => 'POSVENTA',
        'subtitle' => '',
        'description' => 'En Geely, tu tranquilidad continúa después de la compra. Disfruta hasta 5 años de garantía, repuestos originales y un servicio técnico especializado que cuida tu vehículo como el primer día. Porque para nosotros, lo importante no es solo venderte un auto, sino acompañarte en cada kilómetro.',
        'button_text' => 'Agenda ahora',
        'button_url' => '#',
        'building_image' => 'frontend/images/geely-building.png',
        'building_image_mobile' => 'frontend/images/Geely_Bolivia_building_mobile.jpg',
        'background_color' => '#ffffff',
        'text_color' => '#333333',
        'show_image' => true,
        'section_height' => 'min-h-[500px]',
        'image_classes' => 'w-full h-full object-cover'
    ];

    public function mount($layout = 'split-right', $sectionData = [])
    {
        $this->layout = $layout;
        $this->sectionData = array_merge($this->defaultSectionData, $sectionData);
    }
    public function render()
    {
        return view('livewire.front.postventa-section');
    }
}
