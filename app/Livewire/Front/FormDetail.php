<?php

namespace App\Livewire\Front;

use Illuminate\Support\Facades\Log;
use Livewire\Component;
use App\Models\FormSubmission;

class FormDetail extends Component
{

    public $category = null;
    public $slug = null;
    public $activeTab = 'test-drive';
    public $selectedVehicle = null;

    public $paisSeleccionado = 'bolivia';

    public $formData = [
        'nombre' => '',
        'email' => '',
        'telefono' => '',
        'ciudad' => '',
        'vehiculo' => '',
        'mensaje' => '',
        'codigo_pais' => '+591',
        'receive_offers' => false
    ];

    public $paises = [
        'bolivia' => [
            'codigo' => '+591',
            'codigo_iso' => 'bo',
            'nombre' => 'Bolivia'
        ],
        'argentina' => [
            'codigo' => '+54',
            'codigo_iso' => 'ar',
            'nombre' => 'Argentina'
        ],
        'brasil' => [
            'codigo' => '+55',
            'codigo_iso' => 'br',
            'nombre' => 'Brasil'
        ],
        'chile' => [
            'codigo' => '+56',
            'codigo_iso' => 'cl',
            'nombre' => 'Chile'
        ],
        'peru' => [
            'codigo' => '+51',
            'codigo_iso' => 'pe',
            'nombre' => 'Perú'
        ],
        'colombia' => [
            'codigo' => '+57',
            'codigo_iso' => 'co',
            'nombre' => 'Colombia'
        ],
        'ecuador' => [
            'codigo' => '+593',
            'codigo_iso' => 'ec',
            'nombre' => 'Ecuador'
        ],
        'paraguay' => [
            'codigo' => '+595',
            'codigo_iso' => 'py',
            'nombre' => 'Paraguay'
        ],
        'uruguay' => [
            'codigo' => '+598',
            'codigo_iso' => 'uy',
            'nombre' => 'Uruguay'
        ]
    ];

    public $pageData = [
        'title' => 'PRUEBA UN GEELY POR TI MISMO',
        'description' => 'Escoge cómo deseas vivir tu experiencia Geely',
        'tabs' => [
            'test-drive' => [
                'title' => 'TEST DRIVE',
                'description' => 'Agenda tu Test Drive y descubre la emoción de manejar un Geely.'
            ],
            'cotizacion' => [
                'title' => 'COTIZACIÓN',
                'description' => 'Genera una proforma automática del vehículo de tu preferencia.'
            ],
            'consulta' => [
                'title' => 'OTRA CONSULTA',
                'description' => 'Contáctate con nosotros si tienes alguna otra consulta.'
            ]
        ],
        'sucursales' => [
            'title' => 'NUESTRAS SUCURSALES',
            'description' => 'Para mejorar la comodidad del cliente, Geely está desarrollando su red de ventas en toda Bolivia, para ofrecer fácil acceso a nuestros vehículos innovadores.',
            'info' => 'Actualmente, 2 showrooms ya están operativos y abiertos para visitas, como se detalla a continuación:',
            'locations' => ['1. Santa Cruz', '2. El Alto'],
            'additional_info' => 'Los concesionarios restantes están programados para abrir próximamente, ampliando aún más nuestra cobertura y mejorando la accesibilidad para los clientes de Geely en todo el país.',
            'image' => 'frontend/images/form2.png'
        ]
    ];

    // Lista de vehículos disponibles
    public $availableVehicles = [
        'suv' => [
            'starray' => 'Starray',
            'gx3-pro' => 'GX3 Pro',
            'citiray' => 'Citiray'
        ],
        'electricos' => [
            'electric-1' => 'Modelo Eléctrico 1',
            'electric-2' => 'Modelo Eléctrico 2'
        ],
        'camionetas' => [
            'pickup-1' => 'Pickup Model 1'
        ]
    ];

    public function mount($category = null, $slug = null)
    {
        $this->category = $category;
        $this->slug = $slug;

        // Si viene con categoría y slug, pre-seleccionar el vehículo
        if ($this->category && $this->slug) {
            $this->selectedVehicle = [
                'category' => $this->category,
                'slug' => $this->slug,
                'name' => $this->getVehicleName($this->category, $this->slug)
            ];
            $this->formData['vehiculo'] = $this->selectedVehicle['name'];
            // Si viene de un auto específico, ir directo a cotización
            $this->activeTab = 'cotizacion';
        }
    }

    private function getVehicleName($category, $slug)
    {
        return $this->availableVehicles[$category][$slug] ?? ucfirst($slug);
    }


    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function getAllVehicles()
    {
        $vehicles = [];
        foreach ($this->availableVehicles as $category => $categoryVehicles) {
            foreach ($categoryVehicles as $slug => $name) {
                $vehicles[] = [
                    'value' => $name,
                    'label' => $name,
                    'category' => $category,
                    'slug' => $slug
                ];
            }
        }
        return $vehicles;
    }

    public function submitForm()
    {
        $rules = [
            'formData.nombre' => 'required|string|min:2',
            'formData.email' => 'required|email',
            'formData.telefono' => 'required|string',
            'formData.ciudad' => 'required|string'
        ];

        // Si no hay vehículo pre-seleccionado, requerirlo
        if (!$this->selectedVehicle) {
            $rules['formData.vehiculo'] = 'required|string';
        }

        $this->validate($rules);

        // Procesar formulario según el tab activo
        $this->processForm();

        session()->flash('message', 'Formulario enviado correctamente. Te contactaremos pronto.');
        $this->reset(['formData']);

        // Mantener vehículo seleccionado si viene por URL
        if ($this->selectedVehicle) {
            $this->formData['vehiculo'] = $this->selectedVehicle['name'];
        }
    }

    private function processForm()
    {
        $data = [
            'tipo_formulario' => $this->activeTab,
            'nombre' => $this->formData['nombre'],
            'email' => $this->formData['email'],
            'telefono' => $this->formData['telefono'],
            'codigo_pais' => $this->formData['codigo_pais'],
            'ciudad' => $this->formData['ciudad'],
            'vehiculo' => $this->formData['vehiculo'],
            'mensaje' => $this->formData['mensaje'] ?? null,
            'receive_offers' => $this->formData['receive_offers'],
            'categoria_vehiculo' => $this->selectedVehicle['category'] ?? null,
            'slug_vehiculo' => $this->selectedVehicle['slug'] ?? null,
            'datos_completos' => [
                'formData' => $this->formData,
                'selectedVehicle' => $this->selectedVehicle,
                'timestamp' => now()
            ]
        ];

        // Guardar en base de datos
        FormSubmission::create($data);

        // Log para debugging
        Log::info('Formulario guardado en BD:', $data);
    }

    public function cambiarPais($pais)
    {
        $this->paisSeleccionado = $pais;
        $this->formData['codigo_pais'] = $this->paises[$pais]['codigo'];
    }

    public function render()
    {
        return view('livewire.front.form-detail')->layout('components.layouts.frontend.front');
    }
}
