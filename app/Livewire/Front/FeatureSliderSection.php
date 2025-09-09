<?php

namespace App\Livewire\Front;

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
            'direction' => 'left', // left o right
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
        $vehicleConfigs = $this->getVehicleConfig($vehicleSlug);

        // Obtener configuración de la sección específica
        $sectionConfig = $vehicleConfigs[$section] ?? null;

        // Si no existe la sección, marcar como no disponible
        if ($sectionConfig === null) {
            $this->sectionAvailable = false;
            return; // Salir temprano
        }

        $this->sectionAvailable = true;

        // Aplicar configuración: default -> vehicle -> custom
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
    private function getVehicleConfig($slug)
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
                        [
                            'id' => 'tecnologia-avanzada',
                            'title' => 'POTENTE Y DINAMICO',
                            'subtitle' => 'Máxima Fluidez / Transmisión DCT de 7 Velocidades',
                            'description' => 'Te ofrece el arranque perfecto para cada situación, asegurando una respuesta inmediata al acelerador y una conducción excepcionalmente fluida.',
                            'main_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente2.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente2.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
                        ],
                        [
                            'id' => 'motor-turbo1',
                            'title' => 'Máxima Fluidez',
                            'subtitle' => 'Transmisión DCT de 7 Velocidades',
                            'description' => 'Te ofrece el arranque perfecto para cada situación, asegurando una respuesta inmediata al acelerador y una conducción excepcionalmente fluida.',
                            'main_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente02.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente02.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                        ],
                        [
                            'id' => 'estabilidad-cma1',
                            'title' => 'Frenado ',
                            'subtitle' => 'de 100KM a 0Km',
                            'description' => 'El verdadero poder no solo es acelerar, sino saber detenerse. Starray redefine la seguridad en la categoría con una distancia de frenado líder en su clase desde 100 km/h.',
                            'main_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente3.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente3.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
                        ],
                        [
                            'id' => 'tecnologia-avanzada1',
                            'title' => 'Conducción',
                            'subtitle' => '3 Modos de Conducción',
                            'description' => 'Con los modos de conducción seleccionables, transforma tu Starray al instante para adaptarla a tus preferencias. Elige entre una conducción orientada a la eficiencia con el modo Eco, una que privilegia el Comfort, o una que maximiza la respuesta para una experiencia más dinámica con el modo Sport. ',
                            'main_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente4.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente4.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
                        ],
                        [
                            'id' => 'tecnologia-avanzada2',
                            'title' => 'Prueba del Alce',
                            'subtitle' => 'Prueba del Alce',
                            'description' => 'Con el rendimiento líder en la Prueba del Alce, Starray demuestra estabilidad en situaciones de emergencia y control excepcional para maniobras rápidas y seguras.',
                            'main_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente5.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente5.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
                        ]
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
                            'description' => 'Con 32 espacios de almacenamiento inteligentemente ubicados en toda la cabina, Starray está diseñada para adaptarse a todas tus necesidades de espacio y confort.',
                            'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior10.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior10.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                        ],
                        [
                            'id' => 'interno-2a',
                            'title' => 'Pantalla 13.2” HD',
                            'subtitle' => '',
                            'description' => 'Experimenta la pantalla de Starray con una visualización nítida y una interfaz intuitiva diseñada para una interacción fluida y sin distracciones.',
                            'main_image' => 'frontend/images/vehicles/starray/interior/Starray Pantalla.png',
                            'thumbnail_image' => 'frontend/images/vehicles/starray/interior/Starray Pantalla.png',
                            'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
                        ],
                        [
                            'id' => 'interno-10',
                            'title' => 'Diseño y Comodidad',
                            'subtitle' => '',
                            'description' => 'Relájate en asientos de ecocuero de alta calidad, que combinan una estética moderna con un soporte superior, ajuste eléctrico y función de memoria.',
                            'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior8.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior8.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
                        ],
                        [
                            'id' => 'interno-3',
                            'title' => 'Techo Panorámico',
                            'subtitle' => 'Más Grande de su Clase',
                            'description' => 'El lujo es espacio y luminosidad. El techo panorámico de Starray llena la cabina de luz natural, creando una sensaciòn de apertura sin límites.',
                            'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior2.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior2.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
                        ],
                        [
                            'id' => 'interno-5',
                            'title' => 'Diseño Interior Bi-tono',
                            'subtitle' => '',
                            'description' => 'El lujo es visual y sensorial. El diseño interior bi-tono de la Starray eleva la cabina a un nuevo nivel de sofisticación, modernidad y elegancia.',
                            'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior3.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior3.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
                        ],
                        [
                            'id' => 'interno-7',
                            'title' => 'Sistema de Sonido',
                            'subtitle' => 'Infinity by Harman',
                            'description' => '9 parlantes diseñados para envolverte en un sonido multidimensional y de alta calidad.',
                            'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior5.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior5.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
                        ],
                        [
                            'id' => 'interno-6',
                            'title' => 'Cargador Inalámbrico',
                            'subtitle' => '',
                            'description' => 'Mantén tu celular con energía gracias al cargador inalámbrico de 15 watts.',
                            'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior4.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior4.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
                        ],
                        [
                            'id' => 'interno-4',
                            'title' => 'HUD Holográfico de 25.2”',
                            'subtitle' => '',
                            'description' => 'El copiloto que te permite mantener la mirada en el camino, proyectando información vital como la velocidad y las indicaciones de navegación directamente en tu campo de visión. ',
                            'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior9.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior9.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                        ],
//                        [
//                            'id' => 'interno-2',
//                            'title' => 'Techo Panorámico',
//                            'subtitle' => 'Más Grande de su Clase',
//                            'description' => 'El lujo es espacio y luminosidad. El techo panorámico de Starray llena la cabina de luz natural, creando una sensación de apertura sin límites.',
//                            'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior1.jpg',
//                            'thumbnail_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior1.jpg',
//                            'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
//                        ],





//                        [
//                            'id' => 'interno-8',
//                            'title' => '',
//                            'subtitle' => '',
//                            'description' => '',
//                            'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior6.jpg',
//                            'thumbnail_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior6.jpg',
//                            'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
//                        ],
                        [
                            'id' => 'interno-9',
                            'title' => 'Visores de Sol con Lentes Integradas',
                            'subtitle' => '',
                            'description' => 'El lujo está en los pequeños detalles: los visores de sol de Starray, únicos en el mundo, reducen el resplandor y mejoran la visibilidad en los días soleados.',
                            'main_image' => 'frontend/images/vehicles/starray/interior/ViseraStarray-ezgif.com-webp-to-jpg-converter.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/starray/interior/ViseraStarray-ezgif.com-webp-to-jpg-converter.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
                        ],

                    ]
                ],
                'tecnologia' => [
                    'header' => ['title' => 'TECNOLOGÍA: TABLET, HUD HOLOGRÁFICO Y MÁS'],
                    'layout' => ['direction' => 'left'],
                    'slides' => [
                        [
                            'id' => 'tecnologia-1',
                            'title' => 'Pantalla 13.2” HD',
                            'subtitle' => '',
                            'description' => 'Experimenta la pantalla de Starray con una visualización nítida y una interfaz intuitiva, diseñada para una interacción fluida y sin distracciones.',
                            'main_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia1.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia1.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                        ],
                        [
                            'id' => 'tecnologia-2',
                            'title' => 'Pantalla 13.2” HDHUD Holográfico de 25.2',
                            'subtitle' => '',
                            'description' => 'Experimenta la pantalla de Starray con una visualización nítida y una interfaz intuitiva diseñada para una interacción fluida y sin distracciones.',
                            'main_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia2.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia2.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
                        ],
                        [
                            'id' => 'tecnologia-3',
                            'title' => 'Pantalla 13.2” HD',
                            'subtitle' => '',
                            'description' => 'El copiloto que te permite mantener la mirada en el camino, proyectando información vital como la velocidad y las indicaciones de navegación directamente en tu campo de visión. ',
                            'main_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia3.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia3.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
                        ],
                        [
                            'id' => 'tecnologia-4',
                            'title' => '',
                            'subtitle' => '',
                            'description' => '',
                            'main_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia4.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia4.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                        ],
                        [
                            'id' => 'tecnologia-5',
                            'title' => 'Sistema de Sonido',
                            'subtitle' => 'Infinity by Harman',
                            'description' => '9 parlantes diseñados para envolverte en un sonido multidimensional y de alta calidad.',
                            'main_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia5.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia5.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
                        ]

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
                            'description' => 'Desde mantenerte en tu carril hasta alertarte sobre una posible colisión, el sistema completo de ADAS trabaja en conjunto para prevenir accidentes y hacer cada viaje más seguro.',
                            'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad1.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad1.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                        ],
                        [
                            'id' => 'seguridad-2',
                            'title' => 'Visión de Starray de 540°',
                            'subtitle' => '',
                            'description' => 'Elimina todos los puntos ciegos con la visión panorámica de 540°, para una precisión milimétrica en estacionamientos y maniobras.',
                            'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_seguridad2.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_seguridad2.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
                        ],
                        [
                            'id' => 'seguridad-3',
                            'title' => 'Control Crucero Adaptativo',
                            'subtitle' => '',
                            'description' => 'Es un asistente inteligente que se encarga de mantener automáticamente una distancia segura con el vehículo de adelante, frenando y acelerando por ti.',
                            'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_seguridad3.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_seguridad3.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
                        ],
                        [
                            'id' => 'seguridad-4',
                            'title' => '',
                            'subtitle' => '',
                            'description' => '',
                            'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_seguridad4.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_seguridad4.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                        ],
                        [
                            'id' => 'seguridad-5',
                            'title' => '',
                            'subtitle' => '',
                            'description' => '',
                            'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_seguridad5.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_seguridad5.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
                        ],
                        [
                            'id' => 'seguridad-6',
                            'title' => '',
                            'subtitle' => '',
                            'description' => '',
                            'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_seguridad6.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_seguridad6.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
                        ],
                        [
                            'id' => 'seguridad-7',
                            'title' => '',
                            'subtitle' => '',
                            'description' => '',
                            'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_seguridad7.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_seguridad7.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
                        ],
                        [
                            'id' => 'seguridad-8',
                            'title' => '',
                            'subtitle' => '',
                            'description' => '',
                            'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_seguridad8.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_seguridad8.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                        ],
                        [
                            'id' => 'seguridad-9',
                            'title' => '',
                            'subtitle' => '',
                            'description' => '',
                            'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_seguridad9.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_seguridad9.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
                        ]

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
                            'description' => 'La SUV que necesitas para la ciudad y la vida urbana. ',
                            'main_image' => 'frontend/images/vehicles/gx3pro/potenteydinamico/GX3 Pro Aro.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/gx3pro/potenteydinamico/GX3 Pro Aro.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                        ],
                        [
                            'id' => 'motor-turbo2',
                            'title' => '',
                            'subtitle' => '',
                            'description' => '',
                            'main_image' => 'frontend/images/vehicles/gx3pro/potenteydinamico/Geely_Bolivia_GX3_PRO_2.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/gx3pro/potenteydinamico/Geely_Bolivia_GX3_PRO_2.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                        ],
                        [
                            'id' => 'motor-turbo3',
                            'title' => '',
                            'subtitle' => '',
                            'description' => '',
                            'main_image' => 'frontend/images/vehicles/gx3pro/potenteydinamico/Geely_Bolivia_GX3_PRO_3.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/gx3pro/potenteydinamico/Geely_Bolivia_GX3_PRO_3.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                        ],
                        [
                            'id' => 'motor-turbo4',
                            'title' => '',
                            'subtitle' => '',
                            'description' => '',
                            'main_image' => 'frontend/images/vehicles/gx3pro/potenteydinamico/Geely_Bolivia_GX3_PRO_4.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/gx3pro/potenteydinamico/Geely_Bolivia_GX3_PRO_4.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                        ],
                        [
                            'id' => 'motor-turbo5',
                            'title' => '',
                            'subtitle' => '',
                            'description' => '',
                            'main_image' => 'frontend/images/vehicles/gx3pro/potenteydinamico/Geely_Bolivia_GX3_PRO_11.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/gx3pro/potenteydinamico/Geely_Bolivia_GX3_PRO_11.jpg',
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
                            'description' => 'Pantalla de 8” con CarLink, asientos de ecocuero y techo solar',
                            'main_image' => 'frontend/images/vehicles/gx3pro/interior/Geely_Bolivia_GX3_PRO_Interior_1.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/gx3pro/interior/Geely_Bolivia_GX3_PRO_Interior_1.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                        ],
                        [
                            'id' => 'interno-1',
                            'title' => '',
                            'subtitle' => '',
                            'description' => '',
                            'main_image' => 'frontend/images/vehicles/gx3pro/interior/Geely_Bolivia_GX3_PRO_Interior_2.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/gx3pro/interior/Geely_Bolivia_GX3_PRO_Interior_2.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                        ],
                        [
                            'id' => 'interno-1',
                            'title' => '',
                            'subtitle' => '',
                            'description' => '',
                            'main_image' => 'frontend/images/vehicles/gx3pro/interior/Geely_Bolivia_GX3_PRO_Interior_9.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/gx3pro/interior/Geely_Bolivia_GX3_PRO_Interior_9.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                        ],
                        [
                            'id' => 'interno-1',
                            'title' => '',
                            'subtitle' => '',
                            'description' => '',
                            'main_image' => 'frontend/images/vehicles/gx3pro/interior/Geely_Bolivia_GX3_PRO_Interior_10.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/gx3pro/interior/Geely_Bolivia_GX3_PRO_Interior_10.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                        ],
                        [
                            'id' => 'interno-1',
                            'title' => '',
                            'subtitle' => '',
                            'description' => '',
                            'main_image' => 'frontend/images/vehicles/gx3pro/interior/Geely_Bolivia_GX3_PRO_Interior_12.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/gx3pro/interior/Geely_Bolivia_GX3_PRO_Interior_12.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                        ],

                    ]
                ],
//                'tecnologia' => [
//                    'header' => ['title' => 'TECNOLOGÍA'],
//                    'layout' => ['direction' => 'left'],
//                    'slides' => [
//                        [
//                            'id' => 'tecnologia-1',
//                            'title' => '',
//                            'subtitle' => '',
//                            'description' => 'Pantalla de 8” con CarLink, asientos de ecocuero y techo solar',
//                            'main_image' => 'frontend/images/vehicles/gx3pro/tecnologia/Geely_Bolivia_Starray_Tecnologia1.jpg',
//                            'thumbnail_image' => 'frontend/images/vehicles/gx3pro/tecnologia/Geely_Bolivia_Starray_Tecnologia1.jpg',
//                            'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
//                        ],
//
//                    ]
//                ],
                'seguridad' => [
                    'header' => ['title' => 'SEGURIDAD INTEGRAL'],
                    'layout' => ['direction' => 'left'],
                    'slides' => [
                        [
                            'id' => 'seguridad-1',
                            'title' => '',
                            'subtitle' => '',
                            'description' => 'Carrocería diseñada para absorber y disipar la energía de un impacto, protegiendo la integridad de los pasajeros.',
                            'main_image' => 'frontend/images/vehicles/gx3pro/seguridad/Geely_Bolivia_GX3_PRO_5.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/gx3pro/seguridad/Geely_Bolivia_GX3_PRO_5.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                        ],
                        [
                            'id' => 'seguridad-1',
                            'title' => '',
                            'subtitle' => '',
                            'description' => '',
                            'main_image' => 'frontend/images/vehicles/gx3pro/seguridad/Geely_Bolivia_GX3_PRO_8.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/gx3pro/seguridad/Geely_Bolivia_GX3_PRO_8.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                        ],

                    ]
                ]
            ]
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
        // Buscar el primer índice que NO sea el slide actual
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

        // Solo validar main_image hasta que implementes la validación en admin
        if (!isset($slide['main_image']) || empty($slide['main_image'])) {
            $slide['main_image'] = 'frontend/images/default-placeholder.png';
        }

        return $slide;
    }
    public function getOrderedThumbnails()
    {
        $totalSlides = count($this->featureData['slides']);
        $thumbnails = [];

        // Crear orden que asegure que todos los slides sean primer thumbnail
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
            // En RIGHT, el último thumbnail (posición más alta) muestra descripción
            $totalThumbnails = count($this->featureData['slides']) - 1; // -1 porque uno está en principal
            return $thumbnailPosition === ($totalThumbnails - 1);
        }

        // En LEFT, el primer thumbnail (posición 0) muestra descripción
        return $thumbnailPosition === 0;
    }
    public function render()
    {
        return view('livewire.front.feature-slider-section');
    }
}
