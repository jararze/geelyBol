<?php

namespace App\Livewire\Front;

use Illuminate\Support\Facades\View;
use Livewire\Component;

class ModelSection extends Component
{

    public $currentSlide = 0;
    public $activeCategory = 'SUV';
    public $totalSlides = 0;
    public $currentIndex = 0;
    public $totalVehicles = 0;


    public $modelsConfig = [
        'section_settings' => [
            'background_color' => 'bg-white',
            'padding_y' => 'py-0',
            'show_arrows' => true,
            'autoplay' => false,
            'autoplay_interval' => 5000,
        ],

        'header' => [
            'title' => 'MODELOS',
            'subtitle_mobile' => 'Accede a la pre-venta exclusiva de los 2 primeros modelos que llegarán a Bolivia.',
            'title_color' => 'text-gray-900',
            'title_size' => 'text-4xl md:text-5xl',
            'title_weight' => 'font-bold',
            'subtitle' => 'Accede a la pre-venta exclusiva de los 2 primeros modelos que llegarán a Bolivia.',
            'subtitle_color' => 'text-gray-600',
            'subtitle_size' => 'text-lg',
            'subtitle_max_width' => 'max-w-2xl',
            'text_align' => 'text-center',
            'margin_bottom' => 'mb-16'
        ],

        'categories' => [
            [
                'id' => 'SUV',
                'label' => 'SUV',
                'active_color' => 'bg-purple-600 text-white',
                'inactive_color' => 'text-gray-600 hover:text-purple-600',
                'border_color' => 'border-purple-600'
            ],
            [
                'id' => 'ELECTRICOS',
                'label' => 'ELÉCTRICOS',
                'active_color' => 'bg-purple-600 text-white',
                'inactive_color' => 'text-gray-600 hover:text-purple-600',
                'border_color' => 'border-purple-600'
            ],
            [
                'id' => 'CAMIONETAS',
                'label' => 'CAMIONETAS',
                'active_color' => 'bg-purple-600 text-white',
                'inactive_color' => 'text-gray-600 hover:text-purple-600',
                'border_color' => 'border-purple-600'
            ]
        ],

        'vehicles' => [
            'SUV' => [
                [
                    'id' => 1,
                    'slug' => 'starray', // AGREGAR
                    'category' => 'suv', // AGREGAR
                    'name' => 'STARRAY',
                    'description' => 'La SUV Ultra-moderna',
                    'image' => 'frontend/images/vehicles/starray/Geely_Bolivia_Starray_Home.png',
                    'position' => 'center', // center, left, right
                    'featured' => true, // Si es el destacado en el centro

                    'pricing' => [
                        'currency_before' => '$us.',
                        'price_before' => '53990',
                        'price_before_color' => 'text-gray-500',
                        'price_before_decoration' => 'line-through',

                        'currency_now' => '$us.',
                        'price_now' => '52990',
                        'price_now_color' => 'text-blue-600',
                        'price_now_size' => 'text-2xl',
                        'price_now_weight' => 'font-bold',

                        'discount_label' => 'Preventa',
                        'discount_label_color' => 'text-blue-600',
                        'show_from_label' => true,
                        'from_label' => 'Desde'
                    ],

                    'button_primary' => [
                        'text' => 'Ver modelo',
                        'bg_color' => 'bg-black',
                        'text_color' => 'text-white',
                        'hover_bg' => 'hover:bg-gray-800',
                        'size' => 'px-8 py-3',
                        'border_radius' => 'rounded-lg',
                        'font_weight' => 'font-medium',
                        'show' => true
                    ],

                    'features' => [
                        'show_badge' => false,
                        'badge_text' => 'NUEVO',
                        'badge_color' => 'bg-red-500 text-white',
                        'badge_position' => 'top-right'
                    ]
                ],

                [
                    'id' => 2,
                    'name' => 'MUY PRONTO',
                    'slug' => 'muy-pronto', // AGREGAR
                    'category' => 'suv', // AGREGAR
                    'description' => '',
                    'image' => 'frontend/images/vehicles/citray/Geely_Bolivia_Cityray_Home_Cover.png',
                    'position' => 'left',
                    'featured' => false,

                    'pricing' => [
                        'currency_before' => 'Bs.',
                        'price_before' => '500000',
                        'price_before_color' => 'text-gray-500',
                        'price_before_decoration' => 'line-through',

                        'currency_now' => '$us.',
                        'price_now' => '39000',
                        'price_now_color' => 'text-blue-600',
                        'price_now_size' => 'text-xl',
                        'price_now_weight' => 'font-bold',

                        'discount_label' => 'Preventa',
                        'discount_label_color' => 'text-blue-600',
                        'show_from_label' => true,
                        'from_label' => 'Desde'
                    ],

                    'button_primary' => [
                        'text' => 'Ver modelo',
                        'bg_color' => 'bg-black',
                        'text_color' => 'text-white',
                        'hover_bg' => 'hover:bg-gray-800',
                        'size' => 'px-6 py-2',
                        'border_radius' => 'rounded-lg',
                        'font_weight' => 'font-medium',
                        'show' => true
                    ],

                    'features' => [
                        'show_badge' => false
                    ]
                ],

                [
                    'id' => 3,
                    'name' => 'GX3 PRO',
                    'slug' => 'gx3-pro', // AGREGAR
                    'category' => 'suv', // AGREGAR
                    'description' => 'La SUV Moderna, Práctica y Accesible',
                    'image' => 'frontend/images/vehicles/gx3pro/Geely_Bolivia_GX3_PRO_Home.png',
                    'position' => 'right',
                    'featured' => true,

                    'pricing' => [
                        'currency_before' => '$us',
                        'price_before' => '26990',
                        'price_before_color' => 'text-gray-500',
                        'price_before_decoration' => 'line-through',

                        'currency_now' => '$us.',
                        'price_now' => '26490',
                        'price_now_color' => 'text-blue-600',
                        'price_now_size' => 'text-xl',
                        'price_now_weight' => 'font-bold',

                        'discount_label' => 'Preventa',
                        'discount_label_color' => 'text-blue-600',
                        'show_from_label' => true,
                        'from_label' => 'Desde'
                    ],

                    'button_primary' => [
                        'text' => 'Ver modelo',
                        'bg_color' => 'bg-black',
                        'text_color' => 'text-white',
                        'hover_bg' => 'hover:bg-gray-800',
                        'size' => 'px-6 py-2',
                        'border_radius' => 'rounded-lg',
                        'font_weight' => 'font-medium',
                        'show' => true
                    ],

                    'features' => [
                        'show_badge' => false,
                        'badge_text' => 'POPULAR',
                        'badge_color' => 'bg-green-500 text-white',
                        'badge_position' => 'top-right'
                    ]
                ]
            ],

            'ELECTRICOS' => [
                [
                    'id' => 4,
                    'name' => 'MUY PRONTO',
                    'slug' => 'muy-pronto', // AGREGAR
                    'category' => 'electricos', // AGREGAR
                    'description' => '',
                    'image' => 'frontend/images/vehicles/electrico/Geely_Bolivia_Electrico_Home_Cover.png',
                    'position' => 'center',
                    'featured' => false,

                    'pricing' => [
                        'currency_before' => 'Bs.',
                        'price_before' => '600000',
                        'price_before_color' => 'text-gray-500',
                        'price_before_decoration' => 'line-through',

                        'currency_now' => '$us.',
                        'price_now' => '45000',
                        'price_now_color' => 'text-green-600',
                        'price_now_size' => 'text-2xl',
                        'price_now_weight' => 'font-bold',

                        'discount_label' => 'Ahora',
                        'discount_label_color' => 'text-green-600',
                        'show_from_label' => true,
                        'from_label' => 'Desde'
                    ],

                    'button_primary' => [
                        'text' => 'Ver modelo',
                        'bg_color' => 'bg-green-600',
                        'text_color' => 'text-white',
                        'hover_bg' => 'hover:bg-green-700',
                        'size' => 'px-8 py-3',
                        'border_radius' => 'rounded-lg',
                        'font_weight' => 'font-medium',
                        'show' => true
                    ],

                    'features' => [
                        'show_badge' => false,
                        'badge_text' => 'ELÉCTRICO',
                        'badge_color' => 'bg-green-500 text-white',
                        'badge_position' => 'top-right'
                    ]
                ]
            ],

            'CAMIONETAS' => [
                [
                    'id' => 5,
                    'name' => 'MUY PRONTO',
                    'slug' => 'muy-pronto', // AGREGAR
                    'category' => 'camionetas', // AGREGAR
                    'description' => '',
                    'image' => 'frontend/images/vehicles/camionetas/Geely_Bolivia_Riddara_Home_Cover.png',
                    'position' => 'center',
                    'featured' => false,

                    'pricing' => [
                        'currency_before' => 'Bs.',
                        'price_before' => '450000',
                        'price_before_color' => 'text-gray-500',
                        'price_before_decoration' => 'line-through',

                        'currency_now' => '$us.',
                        'price_now' => '35000',
                        'price_now_color' => 'text-orange-600',
                        'price_now_size' => 'text-2xl',
                        'price_now_weight' => 'font-bold',

                        'discount_label' => 'Ahora',
                        'discount_label_color' => 'text-orange-600',
                        'show_from_label' => true,
                        'from_label' => 'Desde'
                    ],

                    'button_primary' => [
                        'text' => 'Ver modelo',
                        'bg_color' => 'bg-orange-600',
                        'text_color' => 'text-white',
                        'hover_bg' => 'hover:bg-orange-700',
                        'size' => 'px-8 py-3',
                        'border_radius' => 'rounded-lg',
                        'font_weight' => 'font-medium',
                        'show' => true
                    ],

                    'features' => [
                        'show_badge' => false,
                        'badge_text' => '4x4',
                        'badge_color' => 'bg-orange-500 text-white',
                        'badge_position' => 'top-right'
                    ]
                ]
            ]
        ]
    ];

    public function mount(): void
    {
        $this->updateTotalVehicles();
    }

    private function updateTotalVehicles(): void
    {
        $this->totalVehicles = count($this->modelsConfig['vehicles'][$this->activeCategory] ?? []);
    }

    public function setActiveCategory($category)
    {
        $this->activeCategory = $category;
        $this->currentIndex = 0; // Reset al cambiar categoría
        $this->updateTotalVehicles();
    }

    public function nextSlide()
    {
        $vehicles = $this->modelsConfig['vehicles'][$this->activeCategory] ?? [];
        $totalVehicles = count($vehicles);

        if ($totalVehicles > 0) {
            $this->currentIndex = ($this->currentIndex + 1) % $totalVehicles;
            // Debug temporal
            session()->flash('debug', 'Next: ' . $this->currentIndex);
        }
    }

    public function prevSlide()
    {
        $vehicles = $this->modelsConfig['vehicles'][$this->activeCategory] ?? [];
        $totalVehicles = count($vehicles);

        if ($totalVehicles > 0) {
            $this->currentIndex = $this->currentIndex > 0 ? $this->currentIndex - 1 : $totalVehicles - 1;
            // Debug temporal
            session()->flash('debug', 'Prev: ' . $this->currentIndex);
        }
    }

    public function getCurrentSet()
    {
        $vehicles = $this->modelsConfig['vehicles'][$this->activeCategory] ?? [];
        $total = count($vehicles);

        if ($total === 0) return [];

        $prev = ($this->currentIndex - 1 + $total) % $total;
        $current = $this->currentIndex;
        $next = ($this->currentIndex + 1) % $total;

        return [
            'left' => $vehicles[$prev],
            'center' => $vehicles[$current],
            'right' => $vehicles[$next]
        ];
    }

    public function goToSlide($index): void
    {
        $this->currentIndex = $index;
    }


    public function render()
    {
        return view('livewire.front.model-section');
    }
}
