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
                'main_image' => 'frontend/images/features/principal1.jpg',
                'thumbnail_image' => 'frontend/images/features/Rectangle 3.png',
                'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
            ],
            [
                'id' => 'estabilidad-cma',
                'title' => 'ESTABILIDAD CON PLATAFORMA CMA',
                'subtitle' => '115 HP DE POTENCIA',
                'description' => 'Diseño ultra moderno y vanguardista que destaca en todos los espacios urbanos, citadinos y en los viajes más largos.',
                'main_image' => 'frontend/images/features/principal2.jpg',
                'thumbnail_image' => 'frontend/images/features/2.png',
                'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
            ],
            [
                'id' => 'tecnologia-avanzada',
                'title' => 'TECNOLOGÍA AVANZADA',
                'subtitle' => '115 HP DE POTENCIA',
                'description' => 'Sistema de tracción inteligente que se adapta a cualquier terreno para máxima seguridad.',
                'main_image' => 'frontend/images/features/principal3.jpg',
                'thumbnail_image' => 'frontend/images/features/3.png',
                'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
            ]
        ],


        'autoplay' => [
            'enabled' => true,
            'delay' => 7000
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

        // Forzar re-render
        $this->dispatch('slideChanged', [
            'currentSlide' => $this->currentSlide,
            'timestamp' => now()->timestamp
        ]);
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
