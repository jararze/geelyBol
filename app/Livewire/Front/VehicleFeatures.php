<?php

namespace App\Livewire\Front;

use Livewire\Component;

class VehicleFeatures extends Component
{

    public $layout = 'three-columns'; // three-columns, two-columns, four-columns
    public $featuresData = [];

    private $defaultFeaturesData = [
        'section_background' => 'bg-gray-50',
        'section_padding' => 'py-16',

        'header' => [
            'title' => 'EL SUV ULTRA MODERNO',
            'title_color' => '#1f2937', // text-gray-900
            'title_size' => 'text-3xl lg:text-4xl',
            'title_weight' => 'font-bold',
            'subtitle' => '3 Razones para elegir a Geely Starray:',
            'subtitle_color' => '#6b7280', // text-gray-600
            'subtitle_size' => 'text-lg',
            'text_align' => 'text-left', // AGREGAR ESTA LÍNEA
            'margin_bottom' => 'mb-12'
        ],

        'features' => [
            [
                'id' => 'lujo',
                'title' => 'Lujo',
                'subtitle' => 'Acabados premium',
                'image' => 'frontend/images/image.png',
                'text_position' => 'bottom-left', // bottom-left, bottom-right, bottom-center, top-left, top-right, top-center, center
                'text_color' => '#ffffff',
                'text_background' => 'bg-black bg-opacity-50',
                'overlay' => 'bg-black bg-opacity-30',
                'hover_effect' => true
            ],
            [
                'id' => 'tecnologia',
                'title' => 'Tecnología',
                'subtitle' => 'Pantalla de 13.2',
                'image' => 'frontend/images/image tablet.png',
                'text_position' => 'bottom-left',
                'text_color' => '#ffffff',
                'text_background' => 'bg-black bg-opacity-50',
                'overlay' => 'bg-black bg-opacity-30',
                'hover_effect' => true
            ],
            [
                'id' => 'diseno',
                'title' => 'Diseño futurista',
                'subtitle' => 'En exterior e interior',
                'image' => 'frontend/images/Foto inferior.png',
                'text_position' => 'bottom-left',
                'text_color' => '#ffffff',
                'text_background' => 'bg-black bg-opacity-50',
                'overlay' => 'bg-black bg-opacity-30',
                'hover_effect' => true
            ]
        ],

        'grid_settings' => [
            'gap' => 'gap-0',
            'columns_mobile' => 'grid-cols-2',
            'columns_tablet' => 'md:grid-cols-2',
            'columns_desktop' => 'lg:grid-cols-3',
            'aspect_ratio' => 'aspect-[4/3]'
        ]
    ];

    public function mount($layout = 'three-columns', $featuresData = [])
    {
        $this->layout = $layout;

        // Merge profundo para el header
        $defaultHeader = $this->defaultFeaturesData['header'];
        $customHeader = $featuresData['header'] ?? [];
        $mergedHeader = array_merge($defaultHeader, $customHeader);

        // Merge el resto de datos
        $this->featuresData = array_merge($this->defaultFeaturesData, $featuresData);
        $this->featuresData['header'] = $mergedHeader;
    }
    public function render()
    {
        return view('livewire.front.vehicle-features');
    }
}
