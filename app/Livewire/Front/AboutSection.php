<?php

namespace App\Livewire\Front;

use Livewire\Component;

class AboutSection extends Component
{

    public $layout = 'centered'; // centered, split-left, split-right, compact-left, compact-right
    public $sectionData = [];

    private $defaultSectionData = [
        'logo' => 'frontend/images/logo-negro.svg',
        'title' => 'GEELY',
        'description' => 'En Geely Bolivia, ofrecemos vehículos que combinan seguridad, tecnología avanzada y un diseño de vanguardia. Creemos que la movilidad de calidad debe ser una experiencia al alcance de todos. Es por eso que cada uno de nuestros autos está creado para quienes valoran la innovación, la eficiencia y las nuevas formas de moverse con libertad y confianza.',
        'button_text' => 'Descubre más',
        'button_url' => 'https://global.geely.com/',
        'background_color' => '#000000',
        'text_color' => '#fff',
        'car_image' => 'frontend/images/7080348 1.png',
        'car_alt' => 'Geely Starray',
        'image_height' => 'h-[400px] lg:h-[500px]', // Nueva configuración
        'image_classes' => 'w-full object-cover' // Clases base de imagen
    ];

    public function mount($layout = 'centered', $sectionData = [])
    {
        $this->layout = $layout;
        $this->sectionData = array_merge($this->defaultSectionData, $sectionData);
    }

    public function render()
    {
        return view('livewire.front.about-section');
    }
}
