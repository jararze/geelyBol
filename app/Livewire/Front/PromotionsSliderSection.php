<?php

namespace App\Livewire\Front;

use Livewire\Component;

class PromotionsSliderSection extends Component
{

    public $currentSlide = 0;
    public $promotionsData = [];

    private $defaultPromotionsData = [
        'section_background' => 'bg-gray-50',
        'section_padding' => 'py-16',

        'header' => [
            'title' => 'PROMOCIONES Y OFERTAS',
            'subtitle' => 'Por Pre-venta',
            'title_size' => 'text-3xl lg:text-4xl',
            'subtitle_size' => 'text-lg'
        ],

        'slides' => [
            [
                'id' => 'starray-50-discount',
                'title' => '$us. 1,000',
                'subtitle' => 'DE DESCUENTO',
                'description' => 'Aprovecha los precios de preventa para comprar tu Geely Starray. Válido en todas sus versiones.',
                'vehicle_model' => 'STARRAY',
                'vehicle_subtitle' => 'El SUV ultra moderno',
                'background_color' => 'bg-gradient-to-br from-gray-100 via-gray-200 to-gray-300',
                'text_color' => 'text-gray-800',
                'title_gradient' => 'bg-gradient-to-r from-blue-500 to-blue-700 bg-clip-text text-transparent',
                'image' => 'frontend/images/prom1.png',
                'button' => [
                    'text' => 'Obtener promo',
                    'style' => 'bg-white text-blue-600 hover:bg-gray-100'
                ]
            ],
//            [
//                'id' => 'starray-financing',
//                'title' => '0%',
//                'subtitle' => 'DE INTERÉS',
//                'description' => 'Financiamiento especial a 48 meses. Sin enganche. Válido para todos los modelos SUV.',
//                'vehicle_model' => 'STARRAY',
//                'vehicle_subtitle' => 'TECNOLOGÍA HÍBRIDA AVANZADA',
//                'background_color' => 'bg-gradient-to-br from-gray-100 via-gray-200 to-gray-300',
//                'text_color' => 'text-gray-800',
//                'title_gradient' => 'bg-gradient-to-r from-blue-500 to-blue-700 bg-clip-text text-transparent',
//                'image' => 'frontend/images/prom1.png',
//                'button' => [
//                    'text' => 'Más información',
//                    'style' => 'bg-white text-green-600 hover:bg-gray-100'
//                ]
//            ],
//            [
//                'id' => 'starray-exchange',
//                'title' => 'TU AUTO',
//                'subtitle' => 'COMO PARTE DE PAGO',
//                'description' => 'Recibe hasta $15,000 adicionales por tu vehículo usado. Evaluación gratuita incluida.',
//                'vehicle_model' => 'STARRAY',
//                'vehicle_subtitle' => 'PROGRAMA DE INTERCAMBIO',
//                'background_color' => 'bg-gradient-to-br from-gray-100 via-gray-200 to-gray-300',
//                'text_color' => 'text-gray-800',
//                'title_gradient' => 'bg-gradient-to-r from-blue-500 to-blue-700 bg-clip-text text-transparent',
//                'image' => 'frontend/images/prom1.png',
//                'button' => [
//                    'text' => 'Evaluar mi auto',
//                    'style' => 'bg-white text-purple-600 hover:bg-gray-100'
//                ]
//            ]
        ],

        'autoplay' => [
            'enabled' => true,
            'delay' => 5000 // 5 segundos
        ],

        'navigation' => [
            'dots_style' => 'w-3 h-3 bg-gray-400 hover:bg-gray-500 rounded-full',
            'active_dot_style' => 'w-8 h-3 bg-blue-600 rounded-full',
            'arrows_enabled' => true,
            'dots_container_class' => 'flex justify-center mt-6',
            'dots_wrapper_class' => 'bg-gray-200 rounded-full px-4 py-2 flex space-x-2'
        ]
    ];

    public function mount($promotionsData = [])
    {
        $this->promotionsData = array_merge($this->defaultPromotionsData, $promotionsData);
        $this->currentSlide = 0;
    }

    public function goToSlide($index)
    {
        $this->currentSlide = $index;
    }

    public function nextSlide()
    {
        $totalSlides = count($this->promotionsData['slides']);
        $this->currentSlide = ($this->currentSlide + 1) % $totalSlides;
    }

    public function prevSlide()
    {
        $totalSlides = count($this->promotionsData['slides']);
        $this->currentSlide = ($this->currentSlide - 1 + $totalSlides) % $totalSlides;
    }

    public function getCurrentSlide()
    {
        return $this->promotionsData['slides'][$this->currentSlide] ?? [];
    }

    public function claimPromotion($slideId)
    {
        session()->flash('message', 'Promoción solicitada correctamente. Te contactaremos pronto.');
    }
    public function render()
    {
        return view('livewire.front.promotions-slider-section');
    }
}
