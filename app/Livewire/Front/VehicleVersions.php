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
                'name' => 'STARRAY GK 2.0',
                'specs' => [
                    'Cilindrada:' => '1.332 c.c. TURBO con 147 HP',
                    'Transmisión:' => 'Manual de 6 velocidades',
                    'Tracción:' => '4x2',
                    'Plataforma:' => 'CMA'
                ],
                'pricing' => [
                    'year' => 2025,
                    'list_price' => 59900,
                    'discount' => 1000,
                    'final_price' => 58900,
                    'currency' => '$us.'
                ],
                'tab_content' => [
                    'motor' => [
                        'tipo_motor' => '1.332 c.c. TURBO',
                        'potencia' => '147 HP',
                        'torque' => '220 Nm',
                        'combustible' => 'Gasolina',
                        'consumo_ciudad' => '8.5 L/100km',
                        'consumo_carretera' => '6.2 L/100km'
                    ],
                    'equipamiento' => [
                        'pantalla' => 'Táctil de 10.25"',
                        'asientos' => 'Cuero sintético',
                        'climatizador' => 'Automático bi-zona',
                        'camara' => 'Reversa + 360°',
                        'sensores' => 'Estacionamiento',
                        'conectividad' => 'Android Auto / Apple CarPlay'
                    ],
                    'seguridad' => [
                        'airbags' => '6 airbags',
                        'abs' => 'Sistema ABS + EBD',
                        'control_estabilidad' => 'ESP',
                        'asistente_frenado' => 'BAS',
                        'control_traccion' => 'ASR/TCS',
                        'cinturones' => 'Pretensores + limitadores'
                    ]
                ],
                'images' => [
                    'exterior' => [
                        'azul' => 'frontend/images/Starray silver20 1.png',
                        'negro' => 'frontend/images/Starray silver70 1.png',
                        'blanco' => 'frontend/images/starray/exterior-blanco.jpg'
                    ],
                    'interior' => [
                        'default' => 'frontend/images/starray/interior.jpg'
                    ]
                ]
            ],
            'gk-2-5' => [
                'name' => 'STARRAY GK 2.5',
                'specs' => [
                    'Cilindrada:' => '2.0 c.c. TURBO con 190 HP',
                    'Transmisión:' => 'Automática CVT',
                    'Tracción:' => 'AWD',
                    'Plataforma:' => 'CMA'
                ],
                'pricing' => [
                    'year' => 2025,
                    'list_price' => 69900,
                    'discount' => 2000,
                    'final_price' => 67900,
                    'currency' => '$us.'
                ],
                'tab_content' => [
                    'motor' => [
                        'tipo_motor' => '2.0 c.c. TURBO',
                        'potencia' => '190 HP',
                        'torque' => '300 Nm',
                        'combustible' => 'Gasolina',
                        'consumo_ciudad' => '9.2 L/100km',
                        'consumo_carretera' => '6.8 L/100km'
                    ],
                    'equipamiento' => [
                        'pantalla' => 'Táctil de 12.3"',
                        'asientos' => 'Cuero premium',
                        'climatizador' => 'Automático tri-zona',
                        'camara' => 'Reversa + 360° + frontal',
                        'sensores' => 'Estacionamiento + punto ciego',
                        'conectividad' => 'Android Auto / Apple CarPlay + WiFi'
                    ],
                    'seguridad' => [
                        'airbags' => '8 airbags',
                        'abs' => 'Sistema ABS + EBD + BA',
                        'control_estabilidad' => 'ESP + VSC',
                        'asistente_frenado' => 'BAS + Pre-colisión',
                        'control_traccion' => 'ASR/TCS + AWD',
                        'cinturones' => 'Pretensores + limitadores + alerta'
                    ]
                ],
                'images' => [
                    'exterior' => [
                        'azul' => 'frontend/images/starray/gk25-exterior-azul.jpg',
                        'negro' => 'frontend/images/starray/gk25-exterior-negro.jpg',
                        'blanco' => 'frontend/images/starray/gk25-exterior-blanco.jpg'
                    ],
                    'interior' => [
                        'default' => 'frontend/images/starray/gk25-interior.jpg'
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

        'colors' => [
            'azul' => ['name' => 'Azul Metalizado', 'hex' => '#4A90E2'],
            'negro' => ['name' => 'Negro Metalizado', 'hex' => '#2C3E50'],
            'blanco' => ['name' => 'Blanco Perlado', 'hex' => '#ECF0F1']
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

    public function mount($versionsData = [])
    {
        $this->versionsData = array_merge($this->defaultVersionsData, $versionsData);

        // Verificar que versions existe y tiene elementos
        if (empty($this->versionsData['versions'])) {
            $this->selectedVersion = 'gk-2-0'; // fallback
        } else {
            $this->selectedVersion = array_key_first($this->versionsData['versions']);
        }
    }

    public function selectVersion($version)
    {
        $this->selectedVersion = $version;
    }

    public function selectView($view)
    {
        $this->selectedView = $view;
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
        $version = $this->getCurrentVersion();

        if ($this->selectedView === 'interior') {
            return $version['images']['interior']['default'] ?? 'frontend/images/default-interior.jpg';
        }

        return $version['images']['exterior'][$this->selectedColor] ?? 'frontend/images/default-exterior.jpg';
    }

    public function requestQuote()
    {
        session()->flash('message', 'Solicitud de cotización enviada correctamente.');
    }

    public function downloadCatalog()
    {
        session()->flash('message', 'Descarga del catálogo iniciada.');
    }

    public function scheduleTestDrive()
    {
        session()->flash('message', 'Test drive agendado correctamente.');
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
