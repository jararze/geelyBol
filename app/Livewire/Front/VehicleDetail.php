<?php

namespace App\Livewire\Front;

use Livewire\Component;

class VehicleDetail extends Component
{

    public $vehicleSlug;
    public $categorySlug;
    public $vehicle;

    public $relatedVehicles = [];

    // Datos estáticos (mover aquí desde tu ModelSection)
    private $vehiclesData = [
        'suv' => [
            [
                'id' => 1,
                'slug' => 'starray',
                'name' => 'STARRAY',
                'description' => 'SUV de alta gama con avanzada tecnología y completa seguridad',
                'long_description' => 'El STARRAY representa la perfecta combinación entre lujo, tecnología y seguridad. Diseñado para quienes buscan una experiencia de conducción superior, este SUV incorpora las últimas innovaciones en sistemas de asistencia al conductor y conectividad avanzada.',
                'image' => 'frontend/images/vehicles/starray/new-okavango2024_1_1_.png',
                'gallery' => [
                    'frontend/images/vehicles/starray/gallery1.jpg',
                    'frontend/images/vehicles/starray/gallery2.jpg',
                    'frontend/images/vehicles/starray/gallery3.jpg',
                ],
                'category' => 'SUV',
                'featured' => true,
                'pricing' => [
                    'currency_before' => 'Bs.',
                    'price_before' => '500000',
                    'currency_now' => '$us.',
                    'price_now' => '53990',
                    'discount_label' => 'Ahora',
                    'from_label' => 'Desde'
                ],
                'specifications' => [
                    'Motor' => 'Turbo 1.5L',
                    'Potencia' => '177 HP',
                    'Transmisión' => 'CVT Automática',
                    'Tracción' => 'FWD',
                    'Combustible' => 'Gasolina',
                    'Capacidad' => '5 pasajeros',
                    'Año' => '2024'
                ],
                'features' => [
                    'Pantalla táctil de 12.3"',
                    'Sistema de navegación GPS',
                    'Cámara de reversa 360°',
                    'Asientos de cuero premium',
                    'Aire acondicionado automático',
                    'Sistema de seguridad avanzado'
                ]
            ],
            [
                'id' => 2,
                'slug' => 'gx3-pro',
                'name' => 'GX3 PRO',
                'description' => 'La SUV Moderna, Práctica y Accesible ',
                'long_description' => '',
                'image' => 'frontend/images/vehicles/starray/IMAGEN-TARJETA-MODELO-425x165-.png',
                'gallery' => [],
                'category' => 'SUV',
                'featured' => false,
                'pricing' => [
                    'currency_before' => 'Bs.',
                    'price_before' => '500000',
                    'currency_now' => '$us.',
                    'price_now' => '25990',
                    'discount_label' => 'Ahora',
                    'from_label' => 'Desde'
                ],
                'specifications' => [
                    'Motor' => '1.4L Turbo',
                    'Potencia' => '150 HP',
                    'Transmisión' => 'Manual 6 velocidades',
                    'Tracción' => 'FWD',
                    'Combustible' => 'Gasolina',
                    'Capacidad' => '5 pasajeros',
                    'Año' => '2024'
                ],
                'features' => [
                    'Pantalla táctil de 10"',
                    'Sistema de audio premium',
                    'Conectividad Bluetooth',
                    'Control de crucero',
                    'Luces LED automáticas'
                ]
            ],
            [
                'id' => 3,
                'slug' => 'cityray',
                'name' => 'CITYRAY',
                'description' => 'El SUV que impone Estilo y Tecnología ',
                'long_description' => '',
                'image' => 'frontend/images/vehicles/starray/IMAGEN-TARJETA-MODELO-425x165-.png',
                'gallery' => [],
                'category' => 'SUV',
                'featured' => false,
                'pricing' => [
                    'currency_before' => 'Bs.',
                    'price_before' => '500000',
                    'currency_now' => '$us.',
                    'price_now' => '25990',
                    'discount_label' => 'Ahora',
                    'from_label' => 'Desde'
                ],
                'specifications' => [
                    'Motor' => '1.4L Turbo',
                    'Potencia' => '150 HP',
                    'Transmisión' => 'Manual 6 velocidades',
                    'Tracción' => 'FWD',
                    'Combustible' => 'Gasolina',
                    'Capacidad' => '5 pasajeros',
                    'Año' => '2024'
                ],
                'features' => [
                    'Pantalla táctil de 10"',
                    'Sistema de audio premium',
                    'Conectividad Bluetooth',
                    'Control de crucero',
                    'Luces LED automáticas'
                ]
            ],
            [
                'id' => 4,
                'slug' => 'coolray',
                'name' => 'COOLRAY',
                'description' => 'SUV PERFECTA PARA LA VIDA URBANA',
                'long_description' => '',
                'image' => 'frontend/images/vehicles/starray/IMAGEN-TARJETA-MODELO-425x165-.png',
                'gallery' => [],
                'category' => 'SUV',
                'featured' => false,
                'pricing' => [
                    'currency_before' => 'Bs.',
                    'price_before' => '500000',
                    'currency_now' => '$us.',
                    'price_now' => '25990',
                    'discount_label' => 'Ahora',
                    'from_label' => 'Desde'
                ],
                'specifications' => [
                    'Motor' => '1.4L Turbo',
                    'Potencia' => '150 HP',
                    'Transmisión' => 'Manual 6 velocidades',
                    'Tracción' => 'FWD',
                    'Combustible' => 'Gasolina',
                    'Capacidad' => '5 pasajeros',
                    'Año' => '2024'
                ],
                'features' => [
                    'Pantalla táctil de 10"',
                    'Sistema de audio premium',
                    'Conectividad Bluetooth',
                    'Control de crucero',
                    'Luces LED automáticas'
                ]
            ],
        ],
        'electricos' => [
            [
                'id' => 5,
                'slug' => 'galaxy-e5',
                'name' => 'GALAXY E5',
                'description' => 'SUV 100% eléctrico con autonomía extendida',
                'long_description' => 'El futuro de la movilidad llega con el GALAXY E5. Este SUV 100% eléctrico ofrece una autonomía excepcional y tecnología de vanguardia.',
                'image' => 'frontend/images/vehicles/starray/starray.jpg',
                'gallery' => [],
                'category' => 'ELÉCTRICOS',
                'featured' => true,
                'pricing' => [
                    'currency_before' => 'Bs.',
                    'price_before' => '-',
                    'currency_now' => '$us.',
                    'price_now' => '-',
                    'discount_label' => 'Ahora',
                    'from_label' => 'Desde'
                ],
                'specifications' => [
                    'Motor' => 'Eléctrico 180kW',
                    'Potencia' => '241 HP',
                    'Transmisión' => 'Automática 1 velocidad',
                    'Tracción' => 'AWD',
                    'Autonomía' => '450 km',
                    'Batería' => '70 kWh',
                    'Carga rápida' => '80% en 30 min',
                    'Año' => '2024'
                ],
                'features' => [
                    'Carga rápida DC',
                    'Pantalla central de 15"',
                    'Piloto automático nivel 2',
                    'Recuperación de energía',
                    'App móvil integrada',
                    'Sistema de climatización inteligente'
                ]
            ]
        ]
    ];

    public function mount($category, $slug)
    {
        $this->categorySlug = $category;
        $this->vehicleSlug = $slug;

        $this->vehicle = $this->findVehicle($category, $slug);

        if (!$this->vehicle) {
            abort(404);
        }

        $this->relatedVehicles = $this->getRelatedVehicles($category, $this->vehicle['id']);
    }

    private function findVehicle($category, $slug)
    {
        if (!isset($this->vehiclesData[$category])) {
            return null;
        }

        foreach ($this->vehiclesData[$category] as $vehicle) {
            if ($vehicle['slug'] === $slug) {
                return $vehicle;
            }
        }

        return null;
    }

    private function getRelatedVehicles($category, $excludeId, $limit = 3)
    {
        if (!isset($this->vehiclesData[$category])) {
            return [];
        }

        return array_slice(
            array_filter($this->vehiclesData[$category], function($vehicle) use ($excludeId) {
                return $vehicle['id'] !== $excludeId;
            }),
            0,
            $limit
        );
    }

    public function requestTestDrive()
    {
        // Lógica para solicitar test drive
        session()->flash('message', 'Solicitud de test drive enviada correctamente.');
    }

    public function requestQuote()
    {
        // Lógica para solicitar cotización
        session()->flash('message', 'Solicitud de cotización enviada correctamente.');
    }
    public function render()
    {
        return view('livewire.front.vehicle-detail')
            ->layout('components.layouts.frontend.front');
    }
}
