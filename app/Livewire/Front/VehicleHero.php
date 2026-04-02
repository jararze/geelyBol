<?php

namespace App\Livewire\Front;

use AllowDynamicProperties;
use App\Models\Vehicle;
use App\Models\VehicleHeroConfig;
use Livewire\Component;

#[AllowDynamicProperties]
class VehicleHero extends Component
{
    public $layout = 'left'; // center, left, right, top-left, top-right, bottom-left
    public $heroData = [];
    public $vehicle = [];

    private $defaultHeroData = [
        'background_image' => 'frontend/images/vehicles/starray/Geely_Bolivia_Starray_Hero_Desktop.jpg',
        'background_image_mobile' => 'frontend/images/vehicles/starray/Geely_Bolivia_Starray_Hero_Mobile.jpg',
        'background_overlay' => 'bg-black bg-opacity-30',
        'background_position' => 'center',
        'section_height' => 'min-h-[90vh]',

        'fadeout_enabled' => true,
        'fadeout_direction' => 'to-bottom',
        'fadeout_color' => '#ffffff',
        'fadeout_opacity' => '1',
        'fadeout_height' => '20%',
        'fadeout_position' => 'bottom',

        'title_type' => 'image',
        'title_image' => 'frontend/images/vehicles/starray/Geely_Starray_Logo.png',
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
        'specs_position' => 'bottom-center',
        'specs_background' => '',
        'specs_text_color' => '#000000',
        'specs_font_family' => 'font-geely-title',
        'specs_value_size' => 'text-3xl lg:text-4xl',
        'specs_unit_size' => 'text-lg',
        'specs_label_size' => 'text-sm',
        'specs_prefix_size' => 'text-lg',

        'selected_specs' => [
            'motor' => ['prefix' => 'Hasta', 'value' => '2.0', 'unit' => 'Turbo', 'label' => 'Motor'],
            'potencia' => ['prefix' => 'Hasta', 'value' => '218', 'unit' => 'hp', 'label' => 'Potencia'],
            'velocidades' => ['prefix' => '', 'value' => '7', 'unit' => 'Velocidades', 'label' => 'Transmisión DCT'],
            'plataforma' => ['prefix' => '', 'value' => 'CMA', 'unit' => '', 'label' => 'Plataforma Europea']
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

    public function mount($vehicle = [], $layout = 'center', $heroData = [])
    {
        $this->vehicle = $vehicle;
        $this->layout = $layout;
        $this->heroData = array_merge($this->defaultHeroData, $heroData);

        $vehicleSlug = $vehicle['slug'] ?? 'default';

        // Load from database first
        $vehicleConfig = $this->loadFromDatabase($vehicleSlug);

        // Fallback to hardcoded config if DB is empty
        if (empty($vehicleConfig)) {
            $vehicleConfig = $this->getVehicleConfigLegacy($vehicleSlug);
        }

        $this->heroData = array_merge($this->defaultHeroData, $vehicleConfig, $heroData);
    }

    private function loadFromDatabase($slug)
    {
        $vehicle = Vehicle::where('slug', $slug)->first();
        if (!$vehicle) {
            return [];
        }

        $heroConfig = VehicleHeroConfig::where('vehicle_id', $vehicle->id)
            ->where('is_active', true)
            ->first();

        if (!$heroConfig) {
            return [];
        }

        $config = [
            'background_image' => $heroConfig->background_image,
            'background_image_mobile' => $heroConfig->background_image_mobile,
            'title_type' => $heroConfig->title_type ?? 'image',
            'title' => $heroConfig->title,
            'subtitle' => $heroConfig->subtitle,
        ];

        if ($heroConfig->title_image) {
            $config['title_image'] = $heroConfig->title_image;
        }

        if ($heroConfig->title_color) {
            $config['title_color'] = $heroConfig->title_color;
        }

        if ($heroConfig->subtitle_color) {
            $config['subtitle_color'] = $heroConfig->subtitle_color;
        }

        if ($heroConfig->specs_text_color) {
            $config['specs_text_color'] = $heroConfig->specs_text_color;
        }

        if ($heroConfig->text_color) {
            $config['text_color'] = $heroConfig->text_color;
        }

        // Convert DB spec format to component format
        if ($heroConfig->selected_specs && is_array($heroConfig->selected_specs)) {
            $specs = [];
            foreach ($heroConfig->selected_specs as $spec) {
                $key = $spec['key'] ?? '';
                if ($key) {
                    $specs[$key] = [
                        'prefix' => $spec['prefix'] ?? '',
                        'value' => $spec['value'] ?? '',
                        'unit' => $spec['unit'] ?? '',
                        'label' => $spec['label'] ?? '',
                    ];
                }
            }
            if (!empty($specs)) {
                $config['selected_specs'] = $specs;
            }
        }

        return $config;
    }

    // LEGACY - Hardcoded vehicle configurations (fallback)
    private function getVehicleConfigLegacy($slug)
    {
        $configs = [
            'starray' => [
                'background_image' => 'frontend/images/vehicles/starray/Geely_Bolivia_Starray_Hero_Desktop.jpg',
                'background_image_mobile' => 'frontend/images/vehicles/starray/Geely_Bolivia_Starray_Hero_Mobile.jpg',
                'title_image' => 'frontend/images/vehicles/starray/Geely_Starray_Logo.png',
                'title' => 'STARRAY',
                'subtitle' => 'El SUV más impactante',
                'selected_specs' => [
                    'motor' => ['prefix' => 'Hasta', 'value' => '2.0', 'unit' => 'Turbo', 'label' => 'Motor'],
                    'potencia' => ['prefix' => 'Hasta', 'value' => '218', 'unit' => 'hp', 'label' => 'Potencia'],
                    'velocidades' => ['prefix' => '', 'value' => '7', 'unit' => 'Velocidades', 'label' => 'Transmisión DCT'],
                    'plataforma' => ['prefix' => '', 'value' => 'CMA', 'unit' => '', 'label' => 'Plataforma Europea']
                ]
            ],

            'gx3-pro' => [
                'background_image' => 'frontend/images/vehicles/gx3pro/Geely_Bolivia_GX3PRO_Hero_Desktop.jpg',
                'background_image_mobile' => 'frontend/images/vehicles/gx3pro/Geely_Bolivia_GX3PRO_Hero_Mobile.jpg',
                'title_type' => 'text',
                'title' => 'GX3 PRO',
                'title_color' => '#000',
                'title_size' => 'text-5xl lg:text-7xl',
                'title_weight' => 'font-bold',
                'title_spacing' => 'tracking-wider',
                'subtitle' => 'SUV Práctico y dinámico',
                'subtitle_color' => '#000',
                'subtitle_size' => 'text-xl lg:text-2xl',
                'subtitle_weight' => 'font-light',
                'subtitle_spacing' => 'tracking-wide',
                'selected_specs' => [
                    'motor' => ['prefix' => '', 'value' => '1.5', 'unit' => '', 'label' => 'Motor'],
                    'potencia' => ['prefix' => '', 'value' => '103', 'unit' => 'hp', 'label' => 'Potencia'],
                    'velocidades' => ['prefix' => '', 'value' => '8', 'unit' => '', 'label' => 'Velocidades'],
                    'traccion' => ['prefix' => '', 'value' => 'CVT', 'unit' => '', 'label' => 'Transmisión']
                ]
            ],

            'cityray' => [
                'background_image' => 'frontend/images/vehicles/cityray/Geely_Bolivia_Cityray_Hero_Desktop_blanco.jpg.jpeg',
                'background_image_mobile' => 'frontend/images/vehicles/cityray/Geely_Bolivia_Cityray_Hero_Mobile_blanco.jpg.jpeg',
                'title_type' => 'text',
                'title' => 'CITYRAY',
                'title_color' => '#FFF',
                'title_size' => 'text-5xl lg:text-7xl',
                'title_weight' => 'font-bold',
                'title_spacing' => 'tracking-wider',
                'subtitle' => 'La SUV que impone Estilo y Tecnología ',
                'subtitle_color' => '#FFF',
                'subtitle_size' => 'text-xl lg:text-2xl',
                'subtitle_weight' => 'font-light',
                'subtitle_spacing' => 'tracking-wide',
                'specs_text_color' => '#ffffff',
                'selected_specs' => [
                    'motor' => ['prefix' => '', 'value' => '1.5', 'unit' => 'Turbo', 'label' => 'Motor'],
                    'potencia' => ['prefix' => '', 'value' => '174', 'unit' => 'hp', 'label' => 'Potencia'],
                    'velocidades' => ['prefix' => '', 'value' => '7', 'unit' => 'Velocidades', 'label' => 'Transmisión DCT'],
                    'traccion' => ['prefix' => '', 'value' => '4', 'unit' => '', 'label' => 'Modos de conducción']
                ]
            ],

            'coolray' => [
                'background_image' => 'frontend/images/vehicles/coolray/1 GEELY_BOLIVIA_COOLRAY.jpg',
                'background_image_mobile' => 'frontend/images/vehicles/coolray/Geely_Bolivia_Coolray_Hero_Mobile.jpg',
                'title_type' => 'text',
                'title' => 'COOLRAY',
                'title_color' => '#FFF',
                'title_size' => 'text-5xl lg:text-7xl',
                'title_weight' => 'font-bold',
                'title_spacing' => 'tracking-wider',
                'subtitle' => 'SUV PERFECTA PARA LA VIDA URBANA',
                'subtitle_color' => '#FFF',
                'subtitle_size' => 'text-xl lg:text-2xl',
                'subtitle_weight' => 'font-light',
                'subtitle_spacing' => 'tracking-wide',
                'selected_specs' => [
                    'motor' => ['prefix' => '', 'value' => '1.5', 'unit' => '', 'label' => 'Motor'],
                    'potencia' => ['prefix' => '', 'value' => '122', 'unit' => 'hp', 'label' => 'Potencia'],
                    'velocidades' => ['prefix' => '', 'value' => '5', 'unit' => '', 'label' => 'Velocidades'],
                    'traccion' => ['prefix' => '', 'value' => '5', 'unit' => 'MT|CVT', 'label' => 'Transmisión']
                ]
            ],

            'galaxy-e5' => [
                'background_image' => 'frontend/images/vehicles/ex5/Geely_Bolivia_EX5_Desktop.jpg',
                'background_image_mobile' => 'frontend/images/vehicles/ex5/Geely_Bolivia_EX5_Mobile.jpg',
                'title_type' => 'image',
                'title_image' => 'frontend/images/vehicles/ex5/logo_EX5_web.png',
                'subtitle' => '',
                'subtitle_color' => '#FFF',
                'subtitle_size' => 'text-xl lg:text-2xl',
                'subtitle_weight' => 'font-light',
                'subtitle_spacing' => 'tracking-wide',
                'selected_specs' => [
                    'motor' => ['prefix' => '', 'value' => '', 'unit' => '', 'label' => ''],
                    'potencia' => ['prefix' => '', 'value' => '', 'unit' => '', 'label' => ''],
                    'velocidades' => ['prefix' => '', 'value' => '', 'unit' => '', 'label' => ''],
                    'traccion' => ['prefix' => '', 'value' => '', 'unit' => '', 'label' => '']
                ]
            ],
        ];

        return $configs[$slug] ?? [];
    }

    public function render()
    {
        return view('livewire.front.vehicle-hero');
    }
}
