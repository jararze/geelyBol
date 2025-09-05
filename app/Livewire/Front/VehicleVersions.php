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
                'images' => [
                    'exterior' => [
                        'azul' => 'frontend/images/Starray silver20 1.png',
                        'negro' => 'frontend/images/Starray silver70 1.png',
                        'blanco' => 'frontend/images/starray/exterior-blanco.jpg'
                    ],
                    'interior' => [
                        'default' => 'frontend/images/vehicles/starray/Geely_Bolivia_Starray_Interior_360.png'
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
                'images' => [
                    'exterior' => [
                        'azul' => 'frontend/images/starray/gk25-exterior-azul.jpg',
                        'negro' => 'frontend/images/starray/gk25-exterior-negro.jpg',
                        'blanco' => 'frontend/images/starray/gk25-exterior-blanco.jpg'
                    ],
                    'interior' => [
                        'default' => 'frontend/images/vehicles/starray/Geely_Bolivia_Starray_Interior_360.png'
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
        $this->dispatch('viewChanged'); // Disparar evento personalizado
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
        return redirect()->route('forms.base');
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
