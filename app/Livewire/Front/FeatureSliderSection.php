<?php

namespace App\Livewire\Front;

use Livewire\Component;

class FeatureSliderSection extends Component
{
    public $currentSlide = 0;
    public $featureData = [];

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
                'main_image' => 'frontend/images/features/motor-turbo-main.jpg',
                'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
            ],
            [
                'id' => 'estabilidad-cma',
                'title' => 'ESTABILIDAD CON PLATAFORMA CMA',
                'subtitle' => '115 HP DE POTENCIA',
                'description' => 'Diseño ultra moderno y vanguardista que destaca en todos los espacios urbanos, citadinos y en los viajes más largos.',
                'main_image' => 'frontend/images/features/estabilidad-main.jpg',
                'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
            ],
            [
                'id' => 'tecnologia-avanzada',
                'title' => 'TECNOLOGÍA AVANZADA',
                'subtitle' => '115 HP DE POTENCIA',
                'description' => 'Sistema de tracción inteligente que se adapta a cualquier terreno para máxima seguridad.',
                'main_image' => 'frontend/images/features/tecnologia-main.jpg',
                'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
            ]
        ],

        'thumbnails' => [
            [
                'image' => 'frontend/images/features/motor-thumb.jpg',
                'title' => '115 HP DE POTENCIA'
            ],
            [
                'image' => 'frontend/images/features/estabilidad-thumb.jpg',
                'title' => 'ESTABILIDAD CON PLATAFORMA CMA'
            ],
            [
                'image' => 'frontend/images/features/tecnologia-thumb.jpg',
                'title' => '115 HP DE POTENCIA'
            ]
        ],

        'autoplay' => [
            'enabled' => true,
            'delay' => 5000
        ],

        'navigation' => [
            'dots_enabled' => true,
            'dots_container_class' => 'flex justify-center mt-8 space-x-2',
            'dots_style' => 'w-3 h-3 bg-gray-400 rounded-full',
            'active_dot_style' => 'w-8 h-3 bg-blue-600 rounded-full'
        ]
    ];

    public function mount($featureData = [])
    {
        $this->featureData = $this->defaultFeatureData;

        if (isset($featureData['section_background'])) {
            $this->featureData['section_background'] = $featureData['section_background'];
        }

        if (isset($featureData['header'])) {
            $this->featureData['header'] = array_merge($this->featureData['header'], $featureData['header']);
        }

        if (isset($featureData['layout'])) {
            $this->featureData['layout'] = array_merge($this->featureData['layout'], $featureData['layout']);
        }

        if (isset($featureData['slides'])) {
            $this->featureData['slides'] = $featureData['slides'];
        }

        if (isset($featureData['thumbnails'])) {
            $this->featureData['thumbnails'] = $featureData['thumbnails'];
        }

        if ($this->featureData['autoplay']['enabled']) {
            $this->dispatch('startAutoplay', delay: $this->featureData['autoplay']['delay']);
        }

        $this->currentSlide = 0;
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

    public function getCurrentSlide()
    {
        return $this->featureData['slides'][$this->currentSlide] ?? [];
    }
    public function render()
    {
        return view('livewire.front.feature-slider-section');
    }
}
