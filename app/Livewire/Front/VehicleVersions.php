<?php

namespace App\Livewire\Front;

use Livewire\Component;

class VehicleVersions extends Component
{

    public $selectedVersion = 'gk-2-0';
    public $selectedView = 'exterior'; // exterior, interior
    public $selectedColor = 'azul';

    public $selectedTab = 'precio';

    public $versionsData = [];
    public $vehicle = [];

    public $category;
    public $slug;

    private $defaultVersionsData = [
        'section_background' => 'bg-gray-100',
        'section_padding' => 'py-16',

        'header' => [
            'title' => 'VERSIONES Y PRECIOS',
            'subtitle' => 'Elige tu versión de Starray',
            'title_size' => 'text-3xl lg:text-4xl',
            'subtitle_size' => 'text-lg'
        ],

        'versions' => [
            'gk-2-0' => [
                'name' => 'Starray Signature 1.5 Turbo',
                'specs' => [
                    'Cilindrada:' => '1.499 c.c. TURBO con 174 HP',
                    'Transmisión:' => '7 velocidades doble embrague',
                    'Tracción:' => 'FWD Delantera',
                    'Plataforma:' => 'CMA'
                ],
                'pricing' => [
                    'year' => 2026,
                    'list_price' => 45500,
                    'discount' => 2000,
                    'final_price' => 43500,
                    'currency' => '$us.'
                ],
                'tab_content' => [
                    'motor' => [
                        'tipo_motor' => 'Motor Turbo de 4 cilindros en línea',
                        'potencia' => '174 HP',
                        'torque' => '290/2000-3500 (Nm/rpm)',
                        'combustible' => '',
                        'consumo_ciudad' => 'FWD Delantera',
                        'consumo_carretera' => 'Euro VI b'
                    ],
                    'equipamiento' => [
                        'pantalla' => 'Táctil HD 13.2”',
                        'asientos' => 'Cuero sintético',
                        'climatizador' => 'Automático bi-zona',
                        'camara' => 'Reversa + HD 360°',
                        'sensores' => 'delantero y trasero',
                        'conectividad' => 'Bluetooth, MP3, Radio Am/FM y Apple CarPlay'
                    ],
                    'seguridad' => [
                        'airbags' => '6 bolsas de aire ',
                        'abs' => 'ABS, EBD y BA',
                        'control_estabilidad' => 'ESP',
                        'asistente_frenado' => 'BAS',
                        'control_traccion' => 'TCS',
                        'cinturones' => 'Pretensores y limitadores'
                    ]
                ],
                'colors' => [
                    'silver' => [
                        'name' => 'Plata',
                        'hex' => '#C0C0C0',
                        'image' => 'frontend/images/vehicles/starray/Starray silver20 1.png'
                    ],
                    'negro' => [
                        'name' => 'Negro',
                        'hex' => '#1a1a1a',
                        'image' => 'frontend/images/vehicles/starray/Starray Lado Izquierdo Negra PNG.png'
                    ],
                    'blanco' => [
                        'name' => 'Blanco',
                        'hex' => '#FFFFFF',
                        'image' => 'frontend/images/vehicles/starray/Starray Lado Izquierdo Blanca PNG.png'
                    ]
                ],
                'images' => [
                    'interior' => [
                        'default' => 'frontend/images/vehicles/starray/Geely_Bolivia_Starray_Interior.jpg'
                    ]
                ]
            ],
            'gk-2-5' => [
                'name' => 'Starray Platinum 2.0 Turbo',
                'specs' => [
                    'Cilindrada:' => '1.969 c.c. TURBO con 218 HP',
                    'Transmisión:' => '7 velocidades doble embrague',
                    'Tracción:' => 'FWD Delantera',
                    'Plataforma:' => 'CMA'
                ],
                'pricing' => [
                    'year' => 2026,
                    'list_price' => 51500,
                    'discount' => 2000,
                    'final_price' => 49500,
                    'currency' => '$us.'
                ],
                'tab_content' => [
                    'motor' => [
                        'tipo_motor' => 'Motor Turbo de 4 cilindros en línea',
                        'potencia' => '218 HP',
                        'torque' => '325/1800-4500 (Nm/rpm)',
                        'combustible' => 'Gasolina',
                        'consumo_ciudad' => 'FWD Delantera',
                        'consumo_carretera' => 'Euro VI'
                    ],
                    'equipamiento' => [
                        'pantalla' => 'Táctil HD 13.2”',
                        'asientos' => 'Cuero sintético',
                        'climatizador' => 'Automático bi-zona',
                        'camara' => 'Reversa + HD 360°',
                        'sensores' => 'delantero y trasero',
                        'conectividad' => 'Bluetooth, MP3, Radio Am/FM y Apple CarPlay'
                    ],
                    'seguridad' => [
                        'airbags' => '6 bolsas de aire ',
                        'abs' => 'ABS, EBD y BA',
                        'control_estabilidad' => 'ESP',
                        'asistente_frenado' => 'BAS',
                        'control_traccion' => 'TCS',
                        'cinturones' => 'Pretensores y limitadores'
                    ]
                ],
                'colors' => [
                    'silver' => [
                        'name' => 'Plata',
                        'hex' => '#C0C0C0',
                        'image' => 'frontend/images/vehicles/starray/Starray silver20 1.png'
                    ],
                    'negro' => [
                        'name' => 'Negro',
                        'hex' => '#1a1a1a',
                        'image' => 'frontend/images/vehicles/starray/Starray Lado Izquierdo Negra PNG.png'
                    ],
                    'blanco' => [
                        'name' => 'Blanco',
                        'hex' => '#FFFFFF',
                        'image' => 'frontend/images/vehicles/starray/Starray Lado Izquierdo Blanca PNG.png'
                    ]
                ],
                'images' => [
                    'interior' => [
                        'default' => 'frontend/images/vehicles/starray/Geely_Bolivia_Starray_Interior.jpg'
                    ]
                ]
            ]
        ],

        'tabs' => [
            'precio' => ['label' => 'PRECIO', 'active' => true],
            'motor' => ['label' => 'MOTOR', 'active' => false],
            'equipamiento' => ['label' => 'EQUIPAMIENTO', 'active' => false],
            'seguridad' => ['label' => 'SEGURIDAD', 'active' => false]
        ],

        'buttons' => [
            'quote' => ['text' => 'Obtener Cotización', 'style' => 'bg-black text-white'],
            'catalog' => ['text' => 'Descargar Catálogo', 'style' => 'border border-gray-400 text-gray-700'],
            'test_drive' => ['text' => 'Agendar Test Drive', 'style' => 'border border-gray-400 text-gray-700'],
            'whatsapp' => ['text' => 'Consulta por Whatsapp', 'style' => 'border border-gray-400 text-gray-700'],
        ]
    ];

    private function getVehicleConfig($slug)
    {
        $configs = [
            'starray' => [
                'header' => [
                    'title' => 'VERSIONES Y PRECIOS',
                    'subtitle' => 'Elige tu versión de Starray',
                    'title_size' => 'text-3xl lg:text-4xl',
                    'subtitle_size' => 'text-lg'
                ],
                'versions' => [
                    'gk-2-0' => [
                        'name' => 'Starray Signature 1.5 Turbo',
                        'specs' => [
                            'Cilindrada:' => '1.499 c.c. TURBO con 174 HP',
                            'Transmisión:' => '7 velocidades doble embrague',
                            'Tracción:' => 'FWD Delantera',
                            'Plataforma:' => 'CMA'
                        ],
                        'pricing' => [
                            'year' => 2026,
                            'list_price' => 53990,
                            'discount' => 2000,
                            'final_price' => 51990,
                            'currency' => '$us.'
                        ],
                        'tab_content' => [
                            'motor' => [
                                'tipo_motor' => 'Motor Turbo de 4 cilindros en línea',
                                'potencia' => '174 HP',
                                'torque' => '290/2000-3500 (Nm/rpm)',
                                'combustible' => '',
                                'consumo_ciudad' => 'FWD Delantera',
                                'consumo_carretera' => 'Euro VI b'
                            ],
                            'equipamiento' => [
                                'pantalla' => 'Táctil HD 13.2”',
                                'asientos' => 'Cuero sintético',
                                'climatizador' => 'Automático bi-zona',
                                'camara' => 'Reversa + HD 360°',
                                'sensores' => 'delantero y trasero',
                                'conectividad' => 'Bluetooth, MP3, Radio Am/FM y Apple CarPlay'
                            ],
                            'seguridad' => [
                                'airbags' => '6 bolsas de aire ',
                                'abs' => 'ABS, EBD y BA',
                                'control_estabilidad' => 'ESP',
                                'asistente_frenado' => 'BAS',
                                'control_traccion' => 'TCS',
                                'cinturones' => 'Pretensores y limitadores'
                            ]
                        ],
                        'colors' => [
                            'blue' => [
                                'name' => 'Azul',
                                'hex' => '#0000ff',
                                'image' => 'frontend/images/vehicles/starray/Starray Blue.png'
                            ],
                            'silver' => [
                                'name' => 'Plata',
                                'hex' => '#C0C0C0',
                                'image' => 'frontend/images/vehicles/starray/Starray silver20 1.png'
                            ],
                            'negro' => [
                                'name' => 'Negro',
                                'hex' => '#1a1a1a',
                                'image' => 'frontend/images/vehicles/starray/Starray Lado Izquierdo Negra PNG.png'
                            ],
                            'blanco' => [
                                'name' => 'Blanco',
                                'hex' => '#FFFFFF',
                                'image' => 'frontend/images/vehicles/starray/Starray Lado Izquierdo Blanca PNG.png'
                            ]
                        ],
                        'images' => [
                            'interior' => [
                                'default' => 'frontend/images/vehicles/starray/Geely_Bolivia_Starray_Interior.jpg'
                            ]
                        ]
                    ],
                    'gk-2-5' => [
                        'name' => 'Starray Platinum 2.0 Turbo',
                        'specs' => [
                            'Cilindrada:' => '1.969 c.c. TURBO con 218 HP',
                            'Transmisión:' => '7 velocidades doble embrague',
                            'Tracción:' => 'FWD Delantera',
                            'Plataforma:' => 'CMA'
                        ],
                        'pricing' => [
                            'year' => 2026,
                            'list_price' => 60990,
                            'discount' => 2000,
                            'final_price' => 58990,
                            'currency' => '$us.'
                        ],
                        'tab_content' => [
                            'motor' => [
                                'tipo_motor' => 'Motor Turbo de 4 cilindros en línea',
                                'potencia' => '218 HP',
                                'torque' => '325/1800-4500 (Nm/rpm)',
                                'combustible' => 'Gasolina',
                                'consumo_ciudad' => 'FWD Delantera',
                                'consumo_carretera' => 'Euro VI'
                            ],
                            'equipamiento' => [
                                'pantalla' => 'Táctil HD 13.2”',
                                'asientos' => 'Cuero sintético',
                                'climatizador' => 'Automático bi-zona',
                                'camara' => 'Reversa + HD 360°',
                                'sensores' => 'delantero y trasero',
                                'conectividad' => 'Bluetooth, MP3, Radio Am/FM y Apple CarPlay'
                            ],
                            'seguridad' => [
                                'airbags' => '6 bolsas de aire ',
                                'abs' => 'ABS, EBD y BA',
                                'control_estabilidad' => 'ESP',
                                'asistente_frenado' => 'BAS',
                                'control_traccion' => 'TCS',
                                'cinturones' => 'Pretensores y limitadores'
                            ]
                        ],
                        'colors' => [
                            'blue' => [
                                'name' => 'Azul',
                                'hex' => '#0000ff',
                                'image' => 'frontend/images/vehicles/starray/Starray Blue.png'
                            ],
                            'silver' => [
                                'name' => 'Plata',
                                'hex' => '#C0C0C0',
                                'image' => 'frontend/images/vehicles/starray/Starray silver20 1.png'
                            ],
                            'negro' => [
                                'name' => 'Negro',
                                'hex' => '#1a1a1a',
                                'image' => 'frontend/images/vehicles/starray/Starray Lado Izquierdo Negra PNG.png'
                            ],
                            'blanco' => [
                                'name' => 'Blanco',
                                'hex' => '#FFFFFF',
                                'image' => 'frontend/images/vehicles/starray/Starray Lado Izquierdo Blanca PNG.png'
                            ]
                        ],
                        'images' => [
                            'interior' => [
                                'default' => 'frontend/images/vehicles/starray/Geely_Bolivia_Starray_Interior.jpg'
                            ]
                        ]
                    ]
                ],
            ],

            'gx3-pro' => [
                'header' => [
                    'title' => 'VERSIONES Y PRECIOS',
                    'subtitle' => 'Elige tu versión de Gx3 Pro',
                    'title_size' => 'text-3xl lg:text-4xl',
                    'subtitle_size' => 'text-lg'
                ],
                'versions' => [
                    'pro-mid-mt-1-5' => [
                        'name' => 'GX3 Pro Mid MT 1.5',
                        'specs' => [
                            'Cilindrada:' => '1.498 cc con 103 HP',
                            'Transmisión:' => 'Manual',
                            'Tracción:' => '4x2 ',
                            'Plataforma:' => ''
                        ],
                        'pricing' => [
                            'year' => 2026,
                            'list_price' => 24990,
                            'discount' => 500,
                            'final_price' => 24490,
                            'currency' => '$us.'
                        ],
                        'tab_content' => [
                            'motor' => [
                                'tipo_motor' => '1.498 c.c con 103 HP',
                                'potencia' => '103 HP',
                                'torque' => '140',
                                'combustible' => 'Gasolina',
                                'consumo_ciudad' => '15.4 L/100km',
                                'consumo_carretera' => '18 L/100km'
                            ],
                            'equipamiento' => [
                                'pantalla' => 'Táctil de 8”',
                                'asientos' => 'Cuero sintético',
                                'climatizador' => 'Automático',
                                'camara' => 'Reversa',
                                'sensores' => 'Estacionamiento',
                                'conectividad' => 'CarLink'
                            ],
                            'seguridad' => [
                                'airbags' => '2 bolsas de aire ',
                                'abs' => 'Sistema ABS + EBD',
                                'control_estabilidad' => 'ESP',
                                'asistente_frenado' => 'EBA',
                                'control_traccion' => 'TCS',
                                'cinturones' => 'Pretensores + limitadores'
                            ]
                        ],
                        'colors' => [
                            'red' => [
                                'name' => 'Rojo',
                                'hex' => '#a11218',
                                'image' => 'frontend/images/vehicles/gx3pro/GX3 Pro Lado Izquierdo Roja PNG.png'
                            ],
                            'blanco' => [
                                'name' => 'Blanco',
                                'hex' => '#ffffff',
                                'image' => 'frontend/images/vehicles/gx3pro/GX3 Pro Lado Izquierdo Blanca PNG.png'
                            ],
                            'gris' => [
                                'name' => 'Gris',
                                'hex' => '#64676c',
                                'image' => 'frontend/images/vehicles/gx3pro/GX3 Pro Lado Izquierdo Gris PNG.png'
                            ],
                            'azul' => [
                                'name' => 'Azul',
                                'hex' => '#004a79',
                                'image' => 'frontend/images/vehicles/gx3pro/GX3 Pro Lado Izquierdo Azul PNG.png'
                            ],
                            'dorado' => [
                                'name' => 'Dorado',
                                'hex' => '#7f776d',
                                'image' => 'frontend/images/vehicles/gx3pro/GX3 Pro Lado Izquierdo Dorada PNG.png'
                            ]
                        ],
                        'images' => [
                            'interior' => [
                                'default' => 'frontend/images/vehicles/gx3pro/Geely_Bolivia_GX3_PRO_Interior.jpg'
                            ]
                        ]
                    ],
                    'pro-comfort-mt-1-5' => [
                        'name' => 'GX3 Pro Comfort MT 1.5',
                        'specs' => [
                            'Cilindrada:' => '1.498 cc con 103 HP',
                            'Transmisión:' => 'Manual',
                            'Tracción:' => '4x2',
                            'Plataforma:' => ''
                        ],
                        'pricing' => [
                            'year' => 2026,
                            'list_price' => 25990,
                            'discount' => 500,
                            'final_price' => 25490,
                            'currency' => '$us.'
                        ],
                        'tab_content' => [
                            'motor' => [
                                'tipo_motor' => '1.498 c.c con 103 HP',
                                'potencia' => '103 HP',
                                'torque' => '140',
                                'combustible' => 'Gasolina',
                                'consumo_ciudad' => '15.4 L/100km',
                                'consumo_carretera' => '18 L/100km'
                            ],
                            'equipamiento' => [
                                'pantalla' => 'Táctil de 8”',
                                'asientos' => 'Cuero sintético',
                                'climatizador' => 'Automático',
                                'camara' => 'Reversa',
                                'sensores' => 'Estacionamiento',
                                'conectividad' => 'CarLink'
                            ],
                            'seguridad' => [
                                'airbags' => '2 bolsas de aire ',
                                'abs' => 'Sistema ABS + EBD',
                                'control_estabilidad' => 'ESP',
                                'asistente_frenado' => 'EBA',
                                'control_traccion' => 'TCS',
                                'cinturones' => 'Pretensores + limitadores'
                            ]
                        ],
                        'colors' => [
                            'red' => [
                                'name' => 'Rojo',
                                'hex' => '#a11218',
                                'image' => 'frontend/images/vehicles/gx3pro/Geely_Bolivia_GX3PRO_Rojo.png'
                            ],
                            'blanco' => [
                                'name' => 'Blanco',
                                'hex' => '#ffffff',
                                'image' => 'frontend/images/vehicles/gx3pro/Geely_Bolivia_GX3PRO_Blanco.png'
                            ],
                            'gris' => [
                                'name' => 'Plata',
                                'hex' => '#64676c',
                                'image' => 'frontend/images/vehicles/gx3pro/Geely_Bolivia_GX3PRO_Plata.png'
                            ],
                            'azul' => [
                                'name' => 'Azul',
                                'hex' => '#004a79',
                                'image' => 'frontend/images/vehicles/gx3pro/Geely_Bolivia_GX3PRO_Azul.png'
                            ],
                            'dorado' => [
                                'name' => 'Cafe',
                                'hex' => '#7f776d',
                                'image' => 'frontend/images/vehicles/gx3pro/Geely_Bolivia_GX3PRO_Cafe.png'
                            ]
                        ],
                        'images' => [
                            'interior' => [
                                'default' => 'frontend/images/vehicles/gx3pro/Geely_Bolivia_Starray_Interior.jpg'
                            ]
                        ]
                    ],
                    'pro-comfort-cvt-1-5' => [
                        'name' => 'GX3 Pro Comfort CVT 1.5',
                        'specs' => [
                            'Cilindrada:' => '1.498 cc con 103 HP',
                            'Transmisión:' => 'Automática',
                            'Tracción:' => '4x2',
                            'Plataforma:' => ''
                        ],
                        'pricing' => [
                            'year' => 2026,
                            'list_price' => 28990,
                            'discount' => 500,
                            'final_price' => 28490,
                            'currency' => '$us.'
                        ],
                        'tab_content' => [
                            'motor' => [
                                'tipo_motor' => '1.498 c.c con 103 HP',
                                'potencia' => '103 HP',
                                'torque' => '140',
                                'combustible' => 'Gasolina',
                                'consumo_ciudad' => '15.4 L/100km',
                                'consumo_carretera' => '18 L/100km'
                            ],
                            'equipamiento' => [
                                'pantalla' => 'Táctil de 8”',
                                'asientos' => 'Cuero sintético',
                                'climatizador' => 'Automático',
                                'camara' => 'Reversa',
                                'sensores' => 'Estacionamiento',
                                'conectividad' => 'CarLink'
                            ],
                            'seguridad' => [
                                'airbags' => '2 bolsas de aire ',
                                'abs' => 'Sistema ABS + EBD',
                                'control_estabilidad' => 'ESP',
                                'asistente_frenado' => 'EBA',
                                'control_traccion' => 'TCS',
                                'cinturones' => 'Pretensores + limitadores'
                            ]
                        ],
                        'colors' => [
                            'red' => [
                                'name' => 'Rojo',
                                'hex' => '#a11218',
                                'image' => 'frontend/images/vehicles/gx3pro/GX3 Pro Lado Izquierdo Roja PNG.png'
                            ],
                            'blanco' => [
                                'name' => 'Blanco',
                                'hex' => '#ffffff',
                                'image' => 'frontend/images/vehicles/gx3pro/GX3 Pro Lado Izquierdo Blanca PNG.png'
                            ],
                            'gris' => [
                                'name' => 'Gris',
                                'hex' => '#64676c',
                                'image' => 'frontend/images/vehicles/gx3pro/GX3 Pro Lado Izquierdo Gris PNG.png'
                            ],
                            'azul' => [
                                'name' => 'Azul',
                                'hex' => '#004a79',
                                'image' => 'frontend/images/vehicles/gx3pro/GX3 Pro Lado Izquierdo Azul PNG.png'
                            ],
                            'dorado' => [
                                'name' => 'Dorado',
                                'hex' => '#7f776d',
                                'image' => 'frontend/images/vehicles/gx3pro/GX3 Pro Lado Izquierdo Dorada PNG.png'
                            ]
                        ],
                        'images' => [
                            'interior' => [
                                'default' => 'frontend/images/vehicles/gx3pro/Geely_Bolivia_Starray_Interior.jpg'
                            ]
                        ]
                    ],
                ],
            ],

            'cityray' => [
                'header' => [
                    'title' => 'VERSIONES Y PRECIOS',
                    'subtitle' => 'Elige tu versión de Cityray',
                    'title_size' => 'text-3xl lg:text-4xl',
                    'subtitle_size' => 'text-lg'
                ],
                'versions' => [
                    'Comfort' => [
                        'name' => 'Comfort',
                        'specs' => [
                            'Cilindrada:' => '1499 cc 174/5500 hp/rpm',
                            'Transmisión:' => '7 velocidades doble embrague',
                            'Tracción:' => 'FWD Delantera',
                            'Plataforma:' => 'Economy/Sport/Comfort/Intelligent'
                        ],
                        'pricing' => [
                            'year' => 2026,
                            'list_price' => 41990,
                            'discount' => 1500,
                            'final_price' => 40490,
                            'currency' => '$us.'
                        ],
                        'tab_content' => [
                            'motor' => [
                                'tipo_motor' => '4 cilindros en línea',
                                'potencia' => '174/5500 hp/rpm',
                                'torque' => '290/2000-3500 Nm/rpm',
                                'traccion' => 'Gasolina',
                                'consumo_ciudad' => 'FWD Delantera',
                                'consumo_carretera' => 'Euro VI B'
                            ],
                            'equipamiento' => [
                                'pantalla' => 'Panel de instrumentos digital LCD de 10.2"',
                                'asientos' => 'Cuero sintético',
                                'climatizador' => 'Automático',
                                'camara' => 'De reversa',
                                'sensores' => '-',
                                'conectividad' => 'Pantalla táctil HD de 13.2"'
                            ],
                            'seguridad' => [
                                'airbags' => 'Frontales, laterales y de cortina',
                                'abs' => 'Sistema de frenos ABS con EBD y BA',
                                'control_estabilidad' => 'Sistema electrónico de estabilidad (ESP®)',
                                'asistente_frenado' => '-',
                                'control_traccion' => 'FWD Delantera',
                                'cinturones' => 'Delanteros con limitador de fuerza y traseros sin limitador de fuerza'
                            ]
                        ],
                        'colors' => [
                            'azul' => [
                                'name' => 'Azul',
                                'hex' => '#004a79',
                                'image' => 'frontend/images/vehicles/cityray/Geely_Bolivia_Cityray Azul.png'
                            ],
                            'blanco' => [
                                'name' => 'Blanco',
                                'hex' => '#ffffff',
                                'image' => 'frontend/images/vehicles/cityray/Geely_Bolivia_Cityray Blanca.png'
                            ],
                            'gris' => [
                                'name' => 'Gris',
                                'hex' => '#64676c',
                                'image' => 'frontend/images/vehicles/cityray/Geely_Bolivia_Cityray Gris.png'
                            ],
                            'plata' => [
                                'name' => 'Plata',
                                'hex' => '#7f776d',
                                'image' => 'frontend/images/vehicles/cityray/Geely_Bolivia_Cityray Plata.png'
                            ]
                        ],
                        'images' => [
                            'interior' => [
                                'default' => 'frontend/images/vehicles/cityray/Geely_Bolivia_Interior.jpg'
                            ]
                        ]
                    ],
                    'Signature' => [
                        'name' => 'Signature',
                        'specs' => [
                            'Cilindrada:' => '1499 cc 174/5500 hp/rpm',
                            'Transmisión:' => '7 velocidades doble embrague',
                            'Tracción:' => 'FWD Delantera',
                            'Plataforma:' => 'Economy/Sport/Comfort/Intelligent'
                        ],
                        'pricing' => [
                            'year' => 2026,
                            'list_price' => 44990,
                            'discount' => 1500,
                            'final_price' => 43490,
                            'currency' => '$us.'
                        ],
                        'tab_content' => [
                            'motor' => [
                                'tipo_motor' => '4 cilindros en línea',
                                'potencia' => '174/5500 hp/rpm',
                                'torque' => '290/2000-3500 Nm/rpm',
                                'traccion' => 'Gasolina',
                                'consumo_ciudad' => 'FWD Delantera',
                                'consumo_carretera' => 'Euro VI B'
                            ],
                            'equipamiento' => [
                                'pantalla' => 'Panel de instrumentos digital LCD de 10.2"',
                                'asientos' => 'Cuero sintético',
                                'climatizador' => 'Asientos delanteros calefactados',
                                'camara' => '360° que te muestra todo lo que hay alrededor del auto',
                                'sensores' => 'Sensores de estacionamiento traseros',
                                'conectividad' => 'Pantalla táctil HD de 13.2"'
                            ],
                            'seguridad' => [
                                'airbags' => 'Frontales, laterales y de cortina',
                                'abs' => 'Sistema de frenos ABS con EBD y BA',
                                'control_estabilidad' => 'Sistema electrónico de estabilidad (ESP®)',
                                'asistente_frenado' => '-',
                                'control_traccion' => 'FWD Delantera',
                                'cinturones' => 'Delanteros con limitador de fuerza y traseros sin limitador de fuerza'
                            ]
                        ],
                        'colors' => [
                            'azul' => [
                                'name' => 'Azul',
                                'hex' => '#004a79',
                                'image' => 'frontend/images/vehicles/cityray/Geely_Bolivia_Cityray Azul.png'
                            ],
                            'blanco' => [
                                'name' => 'Blanco',
                                'hex' => '#ffffff',
                                'image' => 'frontend/images/vehicles/cityray/Geely_Bolivia_Cityray Blanca.png'
                            ],
                            'gris' => [
                                'name' => 'Gris',
                                'hex' => '#64676c',
                                'image' => 'frontend/images/vehicles/cityray/Geely_Bolivia_Cityray Gris.png'
                            ],
                            'plata' => [
                                'name' => 'Plata',
                                'hex' => '#7f776d',
                                'image' => 'frontend/images/vehicles/cityray/Geely_Bolivia_Cityray Plata.png'
                            ]
                        ],
                        'images' => [
                            'interior' => [
                                'default' => 'frontend/images/vehicles/cityray/Geely_Bolivia_Interior.jpg'
                            ]
                        ]
                    ],
                    'Platinum' => [
                        'name' => 'Platinum',
                        'specs' => [
                            'Cilindrada:' => '1499 cc 174/5500 hp/rpm',
                            'Transmisión:' => '7 velocidades doble embrague',
                            'Tracción:' => 'FWD Delantera ',
                            'Plataforma:' => 'Economy/Sport/Comfort/Intelligent'
                        ],
                        'pricing' => [
                            'year' => 2026,
                            'list_price' => 47990,
                            'discount' => 1500,
                            'final_price' => 46490,
                            'currency' => '$us.'
                        ],
                        'tab_content' => [
                            'motor' => [
                                'tipo_motor' => '4 cilindros en línea',
                                'potencia' => '174/5500 hp/rpm',
                                'torque' => '290/2000-3500 Nm/rpm',
                                'traccion' => 'Gasolina',
                                'consumo_ciudad' => 'FWD Delantera',
                                'consumo_carretera' => 'Euro VI B'
                            ],
                            'equipamiento' => [
                                'pantalla' => 'Panel de instrumentos digital LCD de 10.2"',
                                'asientos' => 'Cuero sintético',
                                'climatizador' => 'Asientos delanteros calefactados',
                                'camara' => '360° que te muestra todo lo que hay alrededor del auto',
                                'sensores' => 'Sensores de estacionamiento traseros',
                                'conectividad' => 'Pantalla táctil HD de 13.2"'
                            ],
                            'seguridad' => [
                                'airbags' => 'Frontales, laterales y de cortina',
                                'abs' => 'Sistema de frenos ABS con EBD y BA',
                                'control_estabilidad' => 'Sistema electrónico de estabilidad (ESP®)',
                                'asistente_frenado' => '-',
                                'control_traccion' => 'FWD Delantera',
                                'cinturones' => 'Delanteros con limitador de fuerza y traseros sin limitador de fuerza'
                            ]
                        ],
                        'colors' => [
                            'azul' => [
                                'name' => 'Azul',
                                'hex' => '#004a79',
                                'image' => 'frontend/images/vehicles/cityray/Geely_Bolivia_Cityray Azul.png'
                            ],
                            'blanco' => [
                                'name' => 'Blanco',
                                'hex' => '#ffffff',
                                'image' => 'frontend/images/vehicles/cityray/Geely_Bolivia_Cityray Blanca.png'
                            ],
                            'gris' => [
                                'name' => 'Gris',
                                'hex' => '#64676c',
                                'image' => 'frontend/images/vehicles/cityray/Geely_Bolivia_Cityray Gris.png'
                            ],
                            'plata' => [
                                'name' => 'Plata',
                                'hex' => '#7f776d',
                                'image' => 'frontend/images/vehicles/cityray/Geely_Bolivia_Cityray Plata.png'
                            ]
                        ],
                        'images' => [
                            'interior' => [
                                'default' => 'frontend/images/vehicles/cityray/Geely_Bolivia_Interior.jpg'
                            ]
                        ]
                    ],


                ],
            ],

            'coolray' => [
                'header' => [
                    'title' => 'VERSIONES Y PRECIOS',
                    'subtitle' => 'Elige tu versión de COOLRAY',
                    'title_size' => 'text-3xl lg:text-4xl',
                    'subtitle_size' => 'text-lg'
                ],
                'versions' => [
                    'Comfort-MT' => [
                        'name' => 'COMFORT MT',
                        'specs' => [
                            'Cilindrada:' => '1499 cc con 122 HP',
                            'Transmisión:' => '5MT',
                            'Tracción:' => 'FWD Delantera ',
                            'Plataforma:' => '-'
                        ],
                        'pricing' => [
                            'year' => 2026,
                            'list_price' => 31990,
                            'discount' => 1000,
                            'final_price' => 30990,
                            'currency' => '$us.'
                        ],
                        'tab_content' => [
                            'motor' => [
                                'tipo_motor' => '1499 c.c. con 122 HP',
                                'potencia' => '122 HP',
                                'torque' => '152',
                                'traccion' => 'FWD Delantera',
                                'consumo_ciudad' => 'FWD Delantera',
                                'consumo_carretera' => 'Euro VI'
                            ],
                            'equipamiento' => [
                                'pantalla' => 'Táctil de 8"',
                                'asientos' => 'Tapiz en eco-cuero',
                                'climatizador' => 'Delanteros de halógeno / automáticos con sensor de luz',
                                'camara' => 'Reversa',
                                'sensores' => 'Estacionamiento',
                                'conectividad' => 'Controles de audio y teléfono en el volante'
                            ],
                            'seguridad' => [
                                'airbags' => '2 bolsas de aire',
                                'abs' => 'Sistema ABS + EBD',
                                'control_estabilidad' => 'Sistema electrónico de estabilidad (ESP®)',
                                'asistente_frenado' => 'Monitor de presión TPMS',
                                'control_traccion' => 'Sensibles a la velocidad',
                                'cinturones' => 'Limitadores'
                            ]
                        ],
                        'colors' => [
                            'azul' => [
                                'name' => 'Azul',
                                'hex' => '#004a79',
                                'image' => 'frontend/images/vehicles/coolray/GEELY_BOLIVIA_BLUE.png'
                            ],
                            'blanco' => [
                                'name' => 'Blanco',
                                'hex' => '#ffffff',
                                'image' => 'frontend/images/vehicles/coolray/GEELY_BOLIVIA_WHITE.png'
                            ],
                            'gris' => [
                                'name' => 'Gris',
                                'hex' => '#64676c',
                                'image' => 'frontend/images/vehicles/coolray/GEELY_BOLIVIA_GREY.png'
                            ],
                            'plata' => [
                                'name' => 'Plata',
                                'hex' => '#7f776d',
                                'image' => 'frontend/images/vehicles/coolray/GEELY_BOLIVIA_SILVER.png'
                            ]
                        ],
                        'images' => [
                            'interior' => [
                                'default' => 'frontend/images/vehicles/coolray/GEELY_BOLIVIA_INTERIOR_COOLRAYLITE.jpg'
                            ]
                        ]
                    ],
                    'Comfort-CVT' => [
                        'name' => 'COMFORT CVT',
                        'specs' => [
                            'Cilindrada:' => '1499 cc con 122 HP',
                            'Transmisión:' => 'CVT',
                            'Tracción:' => 'FWD Delantera',
                            'Plataforma:' => '-'
                        ],
                        'pricing' => [
                            'year' => 2026,
                            'list_price' => 33990,
                            'discount' => 1000,
                            'final_price' => 32990,
                            'currency' => '$us.'
                        ],
                        'tab_content' => [
                            'motor' => [
                                'tipo_motor' => '1499 c.c. con 122 HP',
                                'potencia' => '122 HP',
                                'torque' => '152',
                                'traccion' => 'FWD Delantera',
                                'consumo_ciudad' => 'FWD Delantera',
                                'consumo_carretera' => 'Euro VI'
                            ],
                            'equipamiento' => [
                                'pantalla' => 'Táctil de 8"',
                                'asientos' => 'Tapiz en eco-cuero',
                                'climatizador' => 'Delanteros de halógeno / automáticos con sensor de luz',
                                'camara' => 'Reversa',
                                'sensores' => 'Estacionamiento',
                                'conectividad' => 'Controles de audio y teléfono en el volante'
                            ],
                            'seguridad' => [
                                'airbags' => '2 bolsas de aire',
                                'abs' => 'Sistema ABS + EBD',
                                'control_estabilidad' => 'ESC',
                                'asistente_frenado' => 'Monitor de presión TPMS',
                                'control_traccion' => 'TCS',
                                'cinturones' => 'Limitadores'
                            ]
                        ],
                        'colors' => [
                            'azul' => [
                                'name' => 'Azul',
                                'hex' => '#004a79',
                                'image' => 'frontend/images/vehicles/coolray/GEELY_BOLIVIA_BLUE.png'
                            ],
                            'blanco' => [
                                'name' => 'Blanco',
                                'hex' => '#ffffff',
                                'image' => 'frontend/images/vehicles/coolray/GEELY_BOLIVIA_WHITE.png'
                            ],
                            'gris' => [
                                'name' => 'Gris',
                                'hex' => '#64676c',
                                'image' => 'frontend/images/vehicles/coolray/GEELY_BOLIVIA_GREY.png'
                            ],
                            'plata' => [
                                'name' => 'Plata',
                                'hex' => '#7f776d',
                                'image' => 'frontend/images/vehicles/coolray/GEELY_BOLIVIA_SILVER.png'
                            ]
                        ],
                        'images' => [
                            'interior' => [
                                'default' => 'frontend/images/vehicles/coolray/GEELY_BOLIVIA_INTERIOR_COOLRAYLITE.jpg'
                            ]
                        ]
                    ],
                ],
            ],
        ];

        return $configs[$slug] ?? [];
    }

    // Agregar método para cambiar tab
    public function selectTab($tab)
    {
        $this->selectedTab = $tab;
    }

    // Método para obtener contenido del tab actual
    public function getCurrentTabContent()
    {
        $currentVersion = $this->getCurrentVersion();

        if ($this->selectedTab === 'precio') {
            return $currentVersion['pricing'] ?? [];
        }

        // Para otros tabs, buscar en tab_content de la versión actual
        return $currentVersion['tab_content'][$this->selectedTab] ?? [];
    }

    public function mount($vehicle = [], $category, $slug, $versionsData = [])
    {
        $this->vehicle = $vehicle;
        $this->category = $category;
        $this->slug = $slug;

        // Obtener configuración específica del vehículo ANTES del merge
        $vehicleSlug = $vehicle['slug'] ?? 'default';
        $vehicleConfig = $this->getVehicleConfig($vehicleSlug);

        // Merge con orden de prioridad: default -> vehicle -> custom
        $this->versionsData = array_merge($this->defaultVersionsData, $vehicleConfig, $versionsData);

        // Verificar que versions existe y tiene elementos
        if (empty($this->versionsData['versions'])) {
            $this->selectedVersion = 'gk-2-0'; // fallback
        } else {
            $this->selectedVersion = array_key_first($this->versionsData['versions']);
        }

        // Inicializar el color seleccionado
        $currentVersion = $this->getCurrentVersion();
        if (isset($currentVersion['colors']) && !empty($currentVersion['colors'])) {
            $this->selectedColor = array_key_first($currentVersion['colors']);
        }
    }


    public function selectVersion($version)
    {
        $this->selectedVersion = $version;
    }

    public function selectView($view)
    {
        $this->selectedView = $view;
        $this->dispatch('viewChanged');
    }

    public function selectColor($color)
    {
        $this->selectedColor = $color;
    }

    public function getCurrentVersion()
    {
        return $this->versionsData['versions'][$this->selectedVersion] ?? [];
    }

    public function getCurrentImage()
    {
        $currentVersion = $this->getCurrentVersion();

        if ($this->selectedView === 'interior') {
            return $currentVersion['images']['interior']['default'] ?? '';
        }

        // Para exterior, usar el color seleccionado
        $colors = $currentVersion['colors'] ?? [];

        // Si selectedColor está vacío, usar el primer color disponible
        if (empty($this->selectedColor) && !empty($colors)) {
            $this->selectedColor = array_key_first($colors);
        }

        return $colors[$this->selectedColor]['image'] ?? '';
    }

    public function requestQuote()
    {
        return redirect()->route('forms.detail', [
            'category' => $this->category,
            'slug' => $this->slug
        ]);
    }

    public function downloadCatalog()
    {
        $vehicleSlug = $this->vehicle['slug'] ?? 'starray';
        $vehicleName = $this->vehicle['name'] ?? 'Geely';

        // Configuración de PDFs por vehículo
        $catalogConfig = $this->getCatalogConfig($vehicleSlug);

        $pdfPath = $catalogConfig['pdf_path'];
        $fileName = $catalogConfig['file_name'];
        $fullPath = public_path($pdfPath);

        if (file_exists($fullPath)) {
            return response()->download($fullPath, $fileName);
        }

        session()->flash('error', 'El catálogo no está disponible en este momento.');
    }

    private function getCatalogConfig($slug)
    {
        $configs = [
            'starray' => [
                'pdf_path' => 'frontend/images/vehicles/starray/Ficha web Starray.pdf',
                'file_name' => 'Catálogo-Geely-Starray.pdf'
            ],
            'gx3-pro' => [
                'pdf_path' => 'frontend/images/vehicles/gx3pro/Ficha web GX3 PRO.pdf',
                'file_name' => 'Catálogo-Geely-GX3-Pro.pdf'
            ],
            'cityray' => [
                'pdf_path' => 'frontend/images/vehicles/cityray/Ficha web CityRay.pdf',
                'file_name' => 'Catálogo-Geely-GX3-Pro.pdf'
            ],
            'coolray' => [
                'pdf_path' => 'frontend/images/vehicles/coolray/Ficha web CoolRay.pdf',
                'file_name' => 'Catálogo-Geely-GX3-Pro.pdf'
            ],
        ];

        // Fallback a starray si no existe configuración
        return $configs[$slug] ?? $configs['starray'];
    }

    public function scheduleTestDrive()
    {
        return redirect()->route('forms.detail', [
            'category' => $this->category,
            'slug' => $this->slug
        ])->with('activeTab', 'test-drive');
    }

    public function contactWhatsapp()
    {
        $phoneNumber = '59177595558';

        $vehicleName = str_replace('-', ' ', ucwords($this->slug, '-'));
        $vehicleCategory = strtoupper($this->category);
        $vehicleUrl = route('vehicle.detail', [
            'category' => strtolower($this->category),
            'slug' => $this->slug
        ]);

        // Construir mensaje simple sin emojis problemáticos
        $message = "Hola!\n\n";
        $message .= "Estoy interesado en el {$vehicleCategory} {$vehicleName}\n\n";
        $message .= "Link: {$vehicleUrl}\n\n";
        $message .= "Podrian brindarme mas informacion?";

        // Usar api.whatsapp.com que funciona mejor con la app de escritorio
        $whatsappUrl = "https://api.whatsapp.com/send?phone={$phoneNumber}&text=" . urlencode($message);

        // Emitir evento JavaScript para abrir en nueva ventana
        $this->dispatch('openWhatsapp', url: $whatsappUrl);
    }

    public function render()
    {
        return view('livewire.front.vehicle-versions');
    }

    public function testSlowTab($tab)
    {
        // Delay artificial para testing
        sleep(2); // 2 segundos
        $this->selectedTab = $tab;
    }

    public function testSlowColor($color)
    {
        // Delay artificial para testing
        sleep(1); // 1 segundo
        $this->selectedColor = $color;
    }

    public function testSlowView($view)
    {
        // Delay artificial para testing
        sleep(1); // 1 segundo
        $this->selectedView = $view;
    }
}
