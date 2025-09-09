<?php

namespace App\Livewire\Front;

use Livewire\Component;

class TestDriveSection extends Component
{
    public $layout = 'hero'; // hero, overlay-left, banner, banner-thin
    public $sectionData = [];

    private $defaultSectionData = [
        'title' => 'TEST DRIVE',
        'description' => 'Descubre por ti mismo la calidad y tecnología de Geely.',
        'cta_text' => 'Agenda tu Test Drive ahora.',
        'button_text' => 'Agenda ahora',
        'button_url' => '/forms',
        'background_image' => 'frontend/images/vehicles/starray/7080348 1.png',
        'background_image_mobile' => 'frontend/images/vehicles/starray/Geely_Test_Drive_Mobile.jpg',
        'text_color' => '#ffffff',
        'show_image' => true,
        'show_features' => false,
        'image_border_radius' => 'rounded-lg', // rounded-lg, rounded-xl, rounded-none
        'image_shadow' => 'shadow-2xl', // shadow-xl, shadow-2xl, shadow-none
        'image_position' => 'top-half', // top-third, top-half, top-two-thirds, top-three-quarters
        'top_background_color' => '#ffffff',
        'background_color' => 'linear-gradient(135deg, #8B1538 0%, #FF6B35 100%)',
        'overlay_background' => 'bg-black bg-opacity-20 backdrop-blur-sm', // Fondo del contenedor de texto
        'image_overlay' => 'bg-black bg-opacity-40', // Overlay sobre la imagen
        'content_padding' => 'p-8', // Padding del contenedor de texto
        'features' => [
            [
                'title' => '7 Year Unlimited KM Vehicle Warranty',
                'description' => 'Geely vehicles come with a 7-year unlimited kilometre warranty, ensuring you\'re covered for the road ahead.'
            ],
            [
                'title' => '7 Year Unlimited KM Vehicle Warranty',
                'description' => 'Geely vehicles come with a 7-year unlimited kilometre warranty, ensuring you\'re covered for the road ahead.'
            ],
            [
                'title' => '7 Year Unlimited KM Vehicle Warranty',
                'description' => 'Geely vehicles come with a 7-year unlimited kilometre warranty, ensuring you\'re covered for the road ahead.'
            ],
            [
                'title' => '7 Year Unlimited KM Vehicle Warranty',
                'description' => 'Geely vehicles come with a 7-year unlimited kilometre warranty, ensuring you\'re covered for the road ahead.'
            ]
        ],
        'section_height' => 'min-h-[600px]',
        'image_classes' => 'w-full h-full object-cover'
    ];

    public function mount($layout = 'hero', $sectionData = [])
    {
        $currentRoute = request()->route();
        $vehicleSlug = null;

        if ($currentRoute && $currentRoute->hasParameter('slug')) {
            $vehicleSlug = $currentRoute->parameter('slug');
        }

        // Obtener configuración específica del vehículo
        $vehicleConfig = $this->getVehicleConfig($vehicleSlug);

        // Merge: default -> vehicle -> custom
        $this->sectionData = array_merge($this->defaultSectionData, $vehicleConfig, $sectionData);
    }
    private function getVehicleConfig($slug)
    {
        $configs = [
            'starray' => [
                'background_image' => 'frontend/images/vehicles/starray/7080348 1.png',
                'background_image_mobile' => 'frontend/images/vehicles/starray/Geely_Test_Drive_Mobile.jpg',
                'title' => 'TEST DRIVE STARRAY',
                'description' => 'Descubre por ti mismo la potencia y tecnología del Geely Starray.',
            ],

            'gx3-pro' => [
                'background_image' => 'frontend/images/vehicles/gx3pro/Geely_Bolivia_GX3_Test_Drive_Desktop.jpg',
                'background_image_mobile' => 'frontend/images/vehicles/gx3pro/Geely_Bolivia_GX3_PRO_Test_Drive_Mobile.jpg',
                'title' => 'TEST DRIVE GX3 PRO',
                'description' => 'Experimenta la eficiencia y versatilidad del Geely GX3 Pro.',
            ]
        ];

        return $configs[$slug] ?? [];
    }
    public function render()
    {
        return view('livewire.front.test-drive-section');
    }
}
