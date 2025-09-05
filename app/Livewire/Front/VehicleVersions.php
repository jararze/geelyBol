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

    public function mount($category, $slug,$versionsData = [])
    {
        $this->category = $category;
        $this->slug = $slug;
        $this->versionsData = array_merge($this->defaultVersionsData, $versionsData);

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
        $pdfPath = 'frontend/images/vehicles/starray/Ficha Tecnica Geely Starray.pdf'; // Ruta relativa desde public/
        $fullPath = public_path($pdfPath);

        if (file_exists($fullPath)) {
            return response()->download($fullPath, 'Catálogo-Geely-Starray.pdf');
        }

        session()->flash('error', 'El catálogo no está disponible en este momento.');
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
