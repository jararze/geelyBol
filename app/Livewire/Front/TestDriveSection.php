<?php

namespace App\Livewire\Front;

use App\Models\Vehicle;
use App\Models\VehicleSection;
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
        'text_color' => '#fff',
        'text_color_phone' => '#fff',
        'show_image' => true,
        'show_features' => false,
        'image_border_radius' => 'rounded-lg',
        'image_shadow' => 'shadow-2xl',
        'image_position' => 'top-half',
        'top_background_color' => '#ffffff',
        'background_color' => 'linear-gradient(135deg, #8B1538 0%, #FF6B35 100%)',
        'overlay_background' => 'bg-black bg-opacity-20 backdrop-blur-sm',
        'image_overlay' => 'bg-black bg-opacity-40',
        'content_padding' => 'p-8',
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

        // Load from database first
        $vehicleConfig = $this->loadFromDatabase($vehicleSlug);

        // Fallback to hardcoded config
        if (empty($vehicleConfig)) {
            $vehicleConfig = $this->getVehicleConfigLegacy($vehicleSlug);
        }

        // Merge: default -> vehicle -> custom
        $this->sectionData = array_merge($this->defaultSectionData, $vehicleConfig, $sectionData);
    }

    private function loadFromDatabase($slug)
    {
        if (!$slug) {
            return [];
        }

        $vehicle = Vehicle::where('slug', $slug)->first();
        if (!$vehicle) {
            return [];
        }

        $section = VehicleSection::where('vehicle_id', $vehicle->id)
            ->where('section_type', 'test_drive')
            ->where('is_active', true)
            ->first();

        if (!$section) {
            return [];
        }

        $config = [
            'title' => $section->title,
            'description' => $section->description,
        ];

        if ($section->config) {
            if (isset($section->config['background_image'])) {
                $config['background_image'] = $section->config['background_image'];
            }
            if (isset($section->config['background_image_mobile'])) {
                $config['background_image_mobile'] = $section->config['background_image_mobile'];
            }
            if (isset($section->config['text_color'])) {
                $config['text_color'] = $section->config['text_color'];
            }
            if (isset($section->config['button_text'])) {
                $config['button_text'] = $section->config['button_text'];
            }
            if (isset($section->config['button_url'])) {
                $config['button_url'] = $section->config['button_url'];
            }
        }

        return $config;
    }

    // LEGACY - Hardcoded vehicle configurations (fallback)
    private function getVehicleConfigLegacy($slug)
    {
        $configs = [
            'starray' => [
                'background_image' => 'frontend/images/vehicles/starray/7080348 1.png',
                'background_image_mobile' => 'frontend/images/vehicles/starray/Geely_Test_Drive_Mobile.jpg',
                'title' => 'TEST DRIVE STARRAY',
                'description' => 'Descubre por ti mismo la potencia y tecnología del Geely Starray.',
                'text_color' => 'black',
            ],

            'gx3-pro' => [
                'background_image' => 'frontend/images/vehicles/gx3pro/Geely_Bolivia_GX3_Test_Drive_Desktop.jpg',
                'background_image_mobile' => 'frontend/images/vehicles/gx3pro/Geely_Bolivia_GX3_PRO_Test_Drive_Mobile.jpg',
                'title' => 'TEST DRIVE GX3 PRO',
                'description' => 'Experimenta la eficiencia y versatilidad del Geely GX3 Pro.',
                'text_color' => 'black',
            ],

            'cityray' => [
                'background_image' => 'frontend/images/vehicles/cityray/Geely_Test_Drive_Desktop_Cityray.jpg',
                'background_image_mobile' => 'frontend/images/vehicles/cityray/Geely_Test_Drive_Mobile_Cityray.jpg',
                'title' => 'TEST DRIVE CITYRAY',
                'description' => 'Experimenta la eficiencia y versatilidad del Geely Cityray.',
                'text_color' => 'black',
            ],

            'coolray' => [
                'background_image' => 'frontend/images/vehicles/coolray/Geely_Test_Drive_Desktop_Coolray.jpg',
                'background_image_mobile' => 'frontend/images/vehicles/coolray/Geely_Test_Drive_Mobile_Coolray.jpg',
                'title' => 'TEST DRIVE COOLRAY',
                'description' => 'Experimenta la eficiencia y versatilidad del Geely Coolray.',
                'text_color' => 'white',
            ],
        ];

        return $configs[$slug] ?? [];
    }
    public function render()
    {
        return view('livewire.front.test-drive-section');
    }
}
