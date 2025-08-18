<?php

namespace App\Livewire\Front;

use Livewire\Component;

class VehicleHero extends Component
{
    public $layout = 'left'; // center, left, right, top-left, top-right, bottom-left
    public $heroData = [];

    private $defaultHeroData = [
        'background_image' => 'frontend/images/heroinner.png',
        'background_overlay' => 'bg-black bg-opacity-30',
        'background_position' => 'center',
        'section_height' => 'min-h-[90vh]',

        'fadeout_enabled' => true,
        'fadeout_direction' => 'to-bottom', // to-bottom, to-top, to-left, to-right
        'fadeout_color' => '#ffffff', // Color al que se desvanece
        'fadeout_opacity' => '1', // Opacidad del fadeout (0.1 - 1)
        'fadeout_height' => '20%', // Altura del fadeout (30%, 50%, 70%)
        'fadeout_position' => 'bottom', // bottom, top

        'title_type' => 'image', // 'text' o 'image'
        'title_image' => 'frontend/images/logostarray.png', // Ruta de la imagen del título
        'title_image_alt' => '',
        'title_image_width' => 'w-auto',
        'title_image_height' => 'h-20 lg:h-32',
        'title' => 'STARRAY',
        'title_color' => '#ffffff',
        'title_size' => 'text-5xl lg:text-7xl',
        'title_weight' => 'font-bold',
        'title_spacing' => 'tracking-wider',

        'subtitle' => 'El SUV más impactante',
        'subtitle_color' => '#ffffff',
        'subtitle_size' => 'text-xl lg:text-2xl',
        'subtitle_weight' => 'font-light',
        'subtitle_spacing' => 'tracking-wide',

        'show_specs' => true,
        'specs_position' => 'bottom-center', // bottom-center, bottom-left, bottom-right
        'specs_background' => '',
        'specs_text_color' => '#000000',
        'specs_font_family' => 'font-geely-title',
        'specs_value_size' => 'text-3xl lg:text-4xl',
        'specs_unit_size' => 'text-lg',
        'specs_label_size' => 'text-sm',

        'selected_specs' => [
            'motor' => ['value' => '1.5', 'unit' => 'Turbo', 'label' => 'Motor'],
            'potencia' => ['value' => '215', 'unit' => 'hp', 'label' => 'Potencia'],
            'velocidades' => ['value' => '7', 'unit' => 'Velocidades', 'label' => 'Transmisión DCT'],
            'plataforma' => ['value' => 'CMA', 'unit' => '', 'label' => 'Plataforma Europea']
        ],

        'available_specs' => [
            'motor' => ['value' => '1.5', 'unit' => 'Turbo', 'label' => 'Motor'],
            'motor_electrico' => ['value' => '180', 'unit' => 'kW', 'label' => 'Motor Eléctrico'],
            'potencia' => ['value' => '215', 'unit' => 'hp', 'label' => 'Potencia'],
            'potencia_electrica' => ['value' => '241', 'unit' => 'hp', 'label' => 'Potencia Eléctrica'],
            'velocidades' => ['value' => '7', 'unit' => 'Velocidades', 'label' => 'Transmisión DCT'],
            'velocidades_cvt' => ['value' => 'CVT', 'unit' => '', 'label' => 'Transmisión CVT'],
            'plataforma' => ['value' => 'CMA', 'unit' => '', 'label' => 'Plataforma Europea'],
            'traccion' => ['value' => 'AWD', 'unit' => '', 'label' => 'Tracción Integral'],
            'traccion_fwd' => ['value' => 'FWD', 'unit' => '', 'label' => 'Tracción Delantera'],
            'autonomia' => ['value' => '450', 'unit' => 'km', 'label' => 'Autonomía'],
            'bateria' => ['value' => '70', 'unit' => 'kWh', 'label' => 'Batería'],
            'carga_rapida' => ['value' => '30', 'unit' => 'min', 'label' => 'Carga Rápida 80%'],
            'capacidad' => ['value' => '5', 'unit' => 'pasajeros', 'label' => 'Capacidad'],
            'year' => ['value' => '2024', 'unit' => '', 'label' => 'Año']
        ]
    ];

    public function mount($layout = 'center', $heroData = [])
    {
        $this->layout = $layout;
        $this->heroData = array_merge($this->defaultHeroData, $heroData);
    }
    public function render()
    {
        return view('livewire.front.vehicle-hero');
    }
}
