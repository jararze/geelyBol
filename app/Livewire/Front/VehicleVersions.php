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
                    'list_price' => 53490,
                    'discount' => 1000,
                    'final_price' => 52490,
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
                    'list_price' => 60490,
                    'discount' => 1000,
                    'final_price' => 59490,
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
            'test_drive' => ['text' => 'Agendar Test Drive', 'style' => 'border border-gray-400 text-gray-700']
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
                            'list_price' => 53490,
                            'discount' => 1000,
                            'final_price' => 52490,
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
                            'list_price' => 60490,
                            'discount' => 1000,
                            'final_price' => 59490,
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
                            'list_price' => 26690,
                            'discount' => 300,
                            'final_price' => 26390,
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
                                'default' => 'frontend/images/vehicles/starray/Geely_Bolivia_GX3_PRO_Interior.jpg'
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
                            'list_price' => 27690,
                            'discount' => 300,
                            'final_price' => 27390,
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
                                'default' => 'frontend/images/vehicles/starray/Geely_Bolivia_Starray_Interior.jpg'
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
                            'list_price' => 30490,
                            'discount' => 500,
                            'final_price' => 29990,
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
                                'default' => 'frontend/images/vehicles/starray/Geely_Bolivia_Starray_Interior.jpg'
                            ]
                        ]
                    ],
                ],
            ]
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
                'pdf_path' => 'frontend/images/vehicles/starray/Ficha Tecnica Geely Starray.pdf',
                'file_name' => 'Catálogo-Geely-Starray.pdf'
            ],
            'gx3-pro' => [
                'pdf_path' => 'frontend/images/vehicles/gx3pro/Ficha Teecnica GX3 PRO.pdf',
                'file_name' => 'Catálogo-Geely-GX3-Pro.pdf'
            ]
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
