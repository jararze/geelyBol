<?php

namespace App\Livewire\Front;

use App\Models\Vehicle;
use App\Models\VehicleSection;
use Livewire\Component;

class FeatureSliderSection extends Component
{
    public $currentSlide = 0;
    public $featureData = [];

    public $vehicle = [];

    public $sectionAvailable = true;

    private $defaultFeatureData = [
        'section_background' => 'bg-gray-100',
        'section_padding' => 'py-16',

        'header' => [
            'title' => 'POTENTE Y DINÁMICO',
            'title_size' => 'text-3xl lg:text-4xl',
            'title_color' => 'text-gray-900',
            'title_weight' => 'font-bold'
        ],

        'layout' => [
            'direction' => 'left',
            'main_image_size' => 'lg:col-span-2',
            'content_size' => 'lg:col-span-1'
        ],

        'slides' => [
            [
                'id' => 'motor-turbo',
                'title' => 'MOTOR 2.0 TURBO',
                'subtitle' => '2.0 Turbo Motor - 215 hp Potencia',
                'description' => 'Diseño ultra moderno y vanguardista que destaca en todos los espacios urbanos, citadinos y en los viajes más largos.',
                'main_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente0.jpg',
                'thumbnail_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente0.jpg',
                'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
            ],
        ],


        'autoplay' => [
            'enabled' => false,
            'delay' => 7000
        ],

        'navigation' => [
            'dots_enabled' => true,
            'dots_container_class' => 'flex justify-center mt-8 space-x-2',
            'dots_style' => 'w-3 h-3 bg-gray-400 rounded-full',
            'active_dot_style' => 'w-8 h-3 bg-blue-600 rounded-full'
        ]
    ];

    public function mount($vehicle = [], $section = 'potente_dinamico', $featureData = [])
    {
        $this->vehicle = $vehicle;

        $vehicleSlug = $vehicle['slug'] ?? 'default';

        // Try loading from database first
        $sectionConfig = $this->loadFromDatabase($vehicleSlug, $section);

        // Fallback to hardcoded config
        if ($sectionConfig === null) {
            $vehicleConfigs = $this->getVehicleConfigLegacy($vehicleSlug);
            $sectionConfig = $vehicleConfigs[$section] ?? null;
        }

        // If section doesn't exist, mark as unavailable
        if ($sectionConfig === null) {
            $this->sectionAvailable = false;
            return;
        }

        $this->sectionAvailable = true;

        // Apply config: default -> vehicle -> custom
        $this->featureData = $this->defaultFeatureData;

        foreach (['section_background', 'header', 'layout', 'slides'] as $key) {
            if (isset($sectionConfig[$key])) {
                if (in_array($key, ['header', 'layout'])) {
                    $this->featureData[$key] = array_merge($this->featureData[$key], $sectionConfig[$key]);
                } else {
                    $this->featureData[$key] = $sectionConfig[$key];
                }
            }

        }

        $this->featureData['autoplay']['enabled'] = false;
        $this->currentSlide = 0;
    }

    private function loadFromDatabase($slug, $sectionKey)
    {
        $vehicle = Vehicle::where('slug', $slug)->first();
        if (!$vehicle) {
            return null;
        }

        $section = VehicleSection::where('vehicle_id', $vehicle->id)
            ->where('section_type', 'feature_slider')
            ->where('is_active', true)
            ->whereJsonContains('config->section_key', $sectionKey)
            ->with('items')
            ->first();

        if (!$section) {
            return null;
        }

        $config = [
            'header' => ['title' => $section->title ?? ''],
            'layout' => ['direction' => $section->config['direction'] ?? 'left'],
            'slides' => [],
        ];

        foreach ($section->items->where('is_active', true)->sortBy('order') as $item) {
            $config['slides'][] = [
                'id' => 'slide-' . $item->id,
                'title' => $item->title ?? '',
                'subtitle' => $item->subtitle ?? '',
                'description' => $item->description ?? '',
                'main_image' => $item->main_image ?? '',
                'thumbnail_image' => $item->thumbnail_image ?? $item->main_image ?? '',
                'background_overlay' => $item->background_overlay ?? 'bg-gradient-to-r from-blue-600/80 to-transparent',
            ];
        }

        return !empty($config['slides']) ? $config : null;
    }

    // LEGACY - Hardcoded vehicle configurations (fallback)
    private function getVehicleConfigLegacy($slug)
    {
        $configs = [
            'starray' => [
                'potente_dinamico' => [
                    'header' => ['title' => 'POTENTE Y DINAMICO'],
                    'layout' => ['direction' => 'left'],
                    'slides' => [
                        [
                            'id' => 'motor-turbo',
                            'title' => 'Motor 2.0 Turbo',
                            'subtitle' => '218 hp Potencia',
                            'description' => 'Motor 2.0 Turbo con 218 hp que te brinda respuesta rápida en ciudad y potencia constante en carretera. El poder que necesitas, cuando lo necesites.',
                            'main_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente0.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente0.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                        ],
                        [
                            'id' => 'estabilidad-cma',
                            'title' => 'Estabilidad y Seguridad',
                            'subtitle' => 'PLATAFORMA CMA',
                            'description' => 'Una arquitectura modular e inteligente que garantiza agilidad, potencia y la máxima seguridad cada vez que conduzcas.',
                            'main_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente1.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente1.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
                        ],
                    ]
                ],
                'interior_lujoso' => [
                    'header' => ['title' => 'INTERIOR LUJOSO Y TOTALMENTE EQUIPADO'],
                    'layout' => ['direction' => 'right'],
                    'slides' => [
                        [
                            'id' => 'interno-1',
                            'title' => 'Espacios de Almacenamiento',
                            'subtitle' => '',
                            'description' => 'Con 32 espacios de almacenamiento inteligentemente ubicados en toda la cabina.',
                            'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior10.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior10.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                        ],
                    ]
                ],
                'tecnologia' => [
                    'header' => ['title' => 'TECNOLOGÍA: TABLET, HUD HOLOGRÁFICO Y MÁS'],
                    'layout' => ['direction' => 'left'],
                    'slides' => [
                        [
                            'id' => 'tecnologia-1',
                            'title' => 'Pantalla 13.2" HD',
                            'subtitle' => '',
                            'description' => 'Experimenta la pantalla de Starray con una visualización nítida.',
                            'main_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia1.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia1.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                        ],
                    ]
                ],
                'seguridad' => [
                    'header' => ['title' => 'SEGURIDAD TOTAL: MÁS DE 8 ASISTENTES SMART'],
                    'layout' => ['direction' => 'right'],
                    'slides' => [
                        [
                            'id' => 'seguridad-1',
                            'title' => 'Sistema ADAS',
                            'subtitle' => '',
                            'description' => 'Sistema completo de ADAS para prevenir accidentes.',
                            'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad1.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad1.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                        ],
                    ]
                ]
            ],

            'gx3-pro' => [
                'potente_dinamico' => [
                    'header' => ['title' => 'POTENTE Y COMPACTA'],
                    'layout' => ['direction' => 'left'],
                    'slides' => [
                        [
                            'id' => 'motor-turbo',
                            'title' => '1.5 Motor',
                            'subtitle' => '103 HP Potencia',
                            'description' => 'La SUV que necesitas para la ciudad y la vida urbana.',
                            'main_image' => 'frontend/images/vehicles/gx3pro/potenteydinamico/GX3 Pro Aro.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/gx3pro/potenteydinamico/GX3 Pro Aro.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                        ],
                    ]
                ],
                'interior_lujoso' => [
                    'header' => ['title' => 'TOTALMENTE EQUIPADA'],
                    'layout' => ['direction' => 'right'],
                    'slides' => [
                        [
                            'id' => 'interno-1',
                            'title' => '',
                            'subtitle' => '',
                            'description' => 'Pantalla de 8" con CarLink, asientos de ecocuero y techo solar',
                            'main_image' => 'frontend/images/vehicles/gx3pro/interior/Geely_Bolivia_GX3_PRO_Interior_1.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/gx3pro/interior/Geely_Bolivia_GX3_PRO_Interior_1.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                        ],
                    ]
                ],
                'seguridad' => [
                    'header' => ['title' => 'SEGURIDAD INTEGRAL'],
                    'layout' => ['direction' => 'left'],
                    'slides' => [
                        [
                            'id' => 'seguridad-1',
                            'title' => '',
                            'subtitle' => '',
                            'description' => 'Carrocería diseñada para absorber y disipar la energía de un impacto.',
                            'main_image' => 'frontend/images/vehicles/gx3pro/seguridad/Geely_Bolivia_GX3_PRO_5.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/gx3pro/seguridad/Geely_Bolivia_GX3_PRO_5.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                        ],
                    ]
                ]
            ],

            'cityray' => [
                'potente_dinamico' => [
                    'header' => ['title' => 'POTENTE Y DINÁMICO'],
                    'layout' => ['direction' => 'left'],
                    'slides' => [['id' => 'motor-turbo', 'title' => 'Motor', 'subtitle' => '1.5 Turbo', 'description' => 'Con 174 hp para un desempeño dinámico', 'main_image' => 'frontend/images/vehicles/cityray/potenteydinamico/1.jpg', 'thumbnail_image' => 'frontend/images/vehicles/cityray/potenteydinamico/1.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent']]
                ],
                'interior_lujoso' => [
                    'header' => ['title' => 'INTERIOR LUJOSO Y TOTALMENTE EQUIPADO'],
                    'layout' => ['direction' => 'right'],
                    'slides' => [['id' => 'interno-1', 'title' => 'Interior Premium', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/cityray/interior/1 Geely_Bolivia_Techo Solar Pano.jpg', 'thumbnail_image' => 'frontend/images/vehicles/cityray/interior/1 Geely_Bolivia_Techo Solar Pano.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent']]
                ],
                'tecnologia' => [
                    'header' => ['title' => 'TECNOLOGÍA: TABLET, HUD HOLOGRÁFICO Y MÁS'],
                    'layout' => ['direction' => 'left'],
                    'slides' => [['id' => 'tecnologia-1', 'title' => 'Pantalla táctil HD de 13.2"', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/cityray/tecnologia/1 Geely_Bolivia_Pantalla Tactil HD.jpg', 'thumbnail_image' => 'frontend/images/vehicles/cityray/tecnologia/1 Geely_Bolivia_Pantalla Tactil HD.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent']]
                ],
                'seguridad' => [
                    'header' => ['title' => 'SEGURIDAD TOTAL: MÁS DE 8 ASISTENTES SMART'],
                    'layout' => ['direction' => 'right'],
                    'slides' => [['id' => 'seguridad-1', 'title' => 'Cámara 360°', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/cityray/seguridad/6.jpg', 'thumbnail_image' => 'frontend/images/vehicles/cityray/seguridad/6.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent']]
                ]
            ],

            'coolray' => [
                'potente_dinamico' => [
                    'header' => ['title' => 'MODERNA Y EXCLUSIVA'],
                    'layout' => ['direction' => 'left'],
                    'slides' => [['id' => 'motor-turbo', 'title' => 'Motor 1.5 Turbo', 'subtitle' => '122 HP Potencia', 'description' => 'La SUV que necesitas para la ciudad y la vida urbana', 'main_image' => 'frontend/images/vehicles/coolray/potenteydinamico/1.png', 'thumbnail_image' => 'frontend/images/vehicles/coolray/potenteydinamico/1.png', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent']]
                ],
                'interior_lujoso' => [
                    'header' => ['title' => 'TOTALMENTE EQUIPADA Y VERSÁTIL'],
                    'layout' => ['direction' => 'right'],
                    'slides' => [['id' => 'interno-1', 'title' => 'Elegancia en Cada Detalle', 'subtitle' => '', 'description' => 'Asientos de ecocuero que brindan comodidad y estilo', 'main_image' => 'frontend/images/vehicles/coolray/interior/1.png', 'thumbnail_image' => 'frontend/images/vehicles/coolray/interior/1.png', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent']]
                ],
                'seguridad' => [
                    'header' => ['title' => 'SEGURIDAD INTEGRAL'],
                    'layout' => ['direction' => 'left'],
                    'slides' => [['id' => 'seguridad-1', 'title' => 'Seguridad al Estacionar', 'subtitle' => '', 'description' => 'Sensores traseros que cuidan cada maniobra.', 'main_image' => 'frontend/images/vehicles/coolray/seguridad/1.png', 'thumbnail_image' => 'frontend/images/vehicles/coolray/seguridad/1.png', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent']]
                ]
            ],
        ];

        return $configs[$slug] ?? [];
    }

    public function goToSlide($index)
    {
        $this->currentSlide = $index;
    }

    public function nextSlide()
    {
        $totalSlides = count($this->featureData['slides']);
        $this->currentSlide = ($this->currentSlide + 1) % $totalSlides;

    }

    public function prevSlide()
    {
        $totalSlides = count($this->featureData['slides']);
        $this->currentSlide = ($this->currentSlide - 1 + $totalSlides) % $totalSlides;
    }

    public function getFirstVisibleThumbnailIndex()
    {
        for ($i = 0; $i < count($this->featureData['slides']); $i++) {
            if ($i !== $this->currentSlide) {
                return $i;
            }
        }
        return null;
    }


    public function getCurrentSlide()
    {
        $slide = $this->featureData['slides'][$this->currentSlide] ?? [];

        if (!isset($slide['main_image']) || empty($slide['main_image'])) {
            $slide['main_image'] = 'frontend/images/default-placeholder.png';
        }

        return $slide;
    }
    public function getOrderedThumbnails()
    {
        $totalSlides = count($this->featureData['slides']);
        $thumbnails = [];

        for ($i = 1; $i < $totalSlides; $i++) {
            $index = ($this->currentSlide + $i) % $totalSlides;
            $thumbnails[] = [
                'index' => $index,
                'slide' => $this->featureData['slides'][$index]
            ];
        }

        return $thumbnails;
    }

    public function shouldShowDescription($thumbnailPosition, $direction = 'left')
    {
        if ($direction === 'right') {
            $totalThumbnails = count($this->featureData['slides']) - 1;
            return $thumbnailPosition === ($totalThumbnails - 1);
        }

        return $thumbnailPosition === 0;
    }
    public function render()
    {
        return view('livewire.front.feature-slider-section');
    }
}
