<?php

namespace App\Livewire\Front;

use Livewire\Component;

class VehicleFeatures extends Component
{

    public $layout = 'three-columns'; // three-columns, two-columns, four-columns
    public $featuresData = [];
    public $vehicle = [];

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

    public function mount($vehicle = [], $layout = 'three-columns', $featuresData = [])
    {
        $this->vehicle = $vehicle;
        $this->layout = $layout;

        $vehicleSlug = $vehicle['slug'] ?? 'default';
        $vehicleConfig = $this->getVehicleConfig($vehicleSlug);

        // Merge profundo para el header
        $defaultHeader = $this->defaultFeaturesData['header'];
        $vehicleHeader = $vehicleConfig['header'] ?? [];
        $customHeader = $featuresData['header'] ?? [];
        $mergedHeader = array_merge($defaultHeader, $vehicleHeader, $customHeader);

        // Merge el resto de datos (orden de prioridad: default -> vehicle -> custom)
        $this->featuresData = array_merge($this->defaultFeaturesData, $vehicleConfig, $featuresData);
        $this->featuresData['header'] = $mergedHeader;

    }

    private function getVehicleConfig($slug)
    {
        $configs = [
            'starray' => [
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
            ],

            'gx3-pro' => [
                'header' => [
                    'title' => 'Multiplica tus posibilidades',
                    'title_color' => '#1f2937', // text-gray-900
                    'title_size' => 'text-3xl lg:text-4xl',
                    'title_weight' => 'font-bold',
                    'subtitle' => '3 razones para elegir a Geely GX3 Pro:',
                    'subtitle_color' => '#6b7280', // text-gray-600
                    'subtitle_size' => 'text-lg',
                    'text_align' => 'text-left', // AGREGAR ESTA LÍNEA
                    'margin_bottom' => 'mb-12'
                ],

                'features' => [
                    [
                        'id' => 'lujo',
                        'title' => 'Totalmente equipado',
                        'subtitle' => 'El equipamiento que necesitas y más',
                        'image' => 'frontend/images/vehicles/gx3pro/features/GX3 Pro Pasajero.jpg',
                        'text_position' => 'bottom-left', // bottom-left, bottom-right, bottom-center, top-left, top-right, top-center, center
                        'text_color' => '#ffffff',
                        'text_background' => 'bg-black bg-opacity-50',
                        'overlay' => 'bg-black bg-opacity-30',
                        'hover_effect' => true
                    ],
                    [
                        'id' => 'tecnologia',
                        'title' => 'Seguridad integral ',
                        'subtitle' => 'La tranquilidad que necesitas',
                        'image' => 'frontend/images/vehicles/gx3pro/features/GX3 Pro Airbags.jpg',
                        'text_position' => 'bottom-left',
                        'text_color' => '#ffffff',
                        'text_background' => 'bg-black bg-opacity-50',
                        'overlay' => 'bg-black bg-opacity-30',
                        'hover_effect' => true
                    ],
                    [
                        'id' => 'diseno',
                        'title' => 'Amplitud',
                        'subtitle' => 'El espacio que necesitas',
                        'image' => 'frontend/images/vehicles/gx3pro/features/GX3 Pro Maletera.jpg',
                        'text_position' => 'bottom-left',
                        'text_color' => '#ffffff',
                        'text_background' => 'bg-black bg-opacity-50',
                        'overlay' => 'bg-black bg-opacity-30',
                        'hover_effect' => true
                    ]
                ],
            ],

            'cityray' => [
                'header' => [
                    'title' => 'El SUV Tecnológico',
                    'title_color' => '#1f2937', // text-gray-900
                    'title_size' => 'text-3xl lg:text-4xl',
                    'title_weight' => 'font-bold',
                    'subtitle' => '3 razones para elegir a Geely Cityray:',
                    'subtitle_color' => '#6b7280', // text-gray-600
                    'subtitle_size' => 'text-lg',
                    'text_align' => 'text-left', // AGREGAR ESTA LÍNEA
                    'margin_bottom' => 'mb-12'
                ],

                'features' => [
                    [
                        'id' => 'lujo',
                        'title' => 'Elegancia',
                        'subtitle' => 'Interior de cuero y techo solar panorámico',
                        'image' => 'frontend/images/vehicles/cityray/features/Geely_Bolivia_Elegancia.jpg',
                        'text_position' => 'bottom-left', // bottom-left, bottom-right, bottom-center, top-left, top-right, top-center, center
                        'text_color' => '#ffffff',
                        'text_background' => 'bg-black bg-opacity-50',
                        'overlay' => 'bg-black bg-opacity-30',
                        'hover_effect' => true
                    ],
                    [
                        'id' => 'tecnologia',
                        'title' => 'Innovación',
                        'subtitle' => 'Pantalla táctil HD de 13.2',
                        'image' => 'frontend/images/vehicles/cityray/features/Geely_Bolivia_Innovacion.jpg',
                        'text_position' => 'bottom-left',
                        'text_color' => '#ffffff',
                        'text_background' => 'bg-black bg-opacity-50',
                        'overlay' => 'bg-black bg-opacity-30',
                        'hover_effect' => true
                    ],
                    [
                        'id' => 'diseno',
                        'title' => 'Modernidad',
                        'subtitle' => 'Cargador inalámbrico',
                        'image' => 'frontend/images/vehicles/cityray/features/Geely_Bolivia_Modernidad.jpg',
                        'text_position' => 'bottom-left',
                        'text_color' => '#ffffff',
                        'text_background' => 'bg-black bg-opacity-50',
                        'overlay' => 'bg-black bg-opacity-30',
                        'hover_effect' => true
                    ]
                ],
            ],

            'coolray' => [
                'header' => [
                    'title' => 'Donde lo urbano se vuelve Premium',
                    'title_color' => '#1f2937', // text-gray-900
                    'title_size' => 'text-3xl lg:text-4xl',
                    'title_weight' => 'font-bold',
                    'subtitle' => '3 razones para elegir a Geely COOLRAY',
                    'subtitle_color' => '#6b7280', // text-gray-600
                    'subtitle_size' => 'text-lg',
                    'text_align' => 'text-left', // AGREGAR ESTA LÍNEA
                    'margin_bottom' => 'mb-12'
                ],

                'features' => [
                    [
                        'id' => 'lujo',
                        'title' => 'Confort',
                        'subtitle' => 'Asientos de ecocuero',
                        'image' => 'frontend/images/vehicles/coolray/features/1_GEELY_BOLIVIA_CONFORT.png',
                        'text_position' => 'bottom-left', // bottom-left, bottom-right, bottom-center, top-left, top-right, top-center, center
                        'text_color' => '#ffffff',
                        'text_background' => 'bg-black bg-opacity-50',
                        'overlay' => 'bg-black bg-opacity-30',
                        'hover_effect' => true
                    ],
                    [
                        'id' => 'tecnologia',
                        'title' => 'Estilo',
                        'subtitle' => 'Diseño deportivo',
                        'image' => 'frontend/images/vehicles/coolray/features/2_GEELY_BOLIVIA_ESTILO.png',
                        'text_position' => 'bottom-left',
                        'text_color' => '#ffffff',
                        'text_background' => 'bg-black bg-opacity-50',
                        'overlay' => 'bg-black bg-opacity-30',
                        'hover_effect' => true
                    ],
                    [
                        'id' => 'diseno',
                        'title' => 'Comodidad',
                        'subtitle' => 'Amplio espacio interior',
                        'image' => 'frontend/images/vehicles/coolray/features/3_GEELY_BOLIVIA_COMODIDAD.png',
                        'text_position' => 'bottom-left',
                        'text_color' => '#ffffff',
                        'text_background' => 'bg-black bg-opacity-50',
                        'overlay' => 'bg-black bg-opacity-30',
                        'hover_effect' => true
                    ]
                ],
            ],

        ];

        return $configs[$slug] ?? [];
    }
    public function render()
    {
        return view('livewire.front.vehicle-features');
    }
}
