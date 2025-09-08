<?php

namespace App\Livewire\Front;

use Livewire\Component;

class HeroSection extends Component
{

    public $currentSlide = 0;
    public $videoProgress = 0; // Progreso del video (0-100)
    public $videoCurrentTime = 0;
    public $videoDuration = 0;
    public $isPaused = false;

    public $isMobile = false;

    public $heroConfig = [
        'autoplay' => true,
        'autoplay_interval' => 8000,
        'show_dots' => true,
        'show_arrows' => true,
        'pause_on_hover' => true,
        'show_video_controls' => true,

        'layout_config' => [
            'spacing' => 'space-y-4', // space-y-2, space-y-4, space-y-6, space-y-8
            'element_order' => ['title', 'subtitle', 'description', 'buttons'] // Orden personalizable
        ],

        'slides' => [
            [
                'id' => 1,
                'media_type' => 'image', // image, video
                'media_src' => 'frontend/images/Banner 1.jpg',
                'media_src_mobile' => 'frontend/images/Banner Mobile.jpg',
                'media_fit' => 'contain', // cover, contain, fill, scale-down
                'media_position' => 'center', // center, top, bottom, left, right
                'media_background' => 'bg-black', // Color de fondo si la imagen no cubre todo
                'object_position_mobile' => '20% 40%', // En móvil enfoca el auto (parte inferior)
                'object_position_desktop' => '50% 50%', // En desktop enfoca el centro
                'overlay_opacity' => 0.4,
                'only_image' => true,
                'buttons' => false,
                'show_title' => false,    // Ocultar título
                'show_subtitle' => false, // Ocultar subtítulo
                'show_description' => false, // Ocultar descripción

                'title' => [
                    'text' => 'BIENVENIDO A GEELY',
                    'highlight_text' => 'BIENVENIDO A GEELY',
                    'gradient_from' => '#f97316',
                    'gradient_to' => '#fb923c',
                    'font_size' => 'text-4xl md:text-6xl',
                    'font_weight' => 'font-bold',
                    'text_color' => 'text-white',
                    'position' => 'top-left', // top-left, top-middle, top-right, middle-left, middle-middle, middle-right, bottom-left, bottom-middle, bottom-right
                    'margin_top' => 'mt-20', // Margen superior
                    'margin_bottom' => 'mb-6', // Margen inferior
                    'line_height' => 'leading-tight',
                    'letter_spacing' => 'tracking-normal',
                    'line_wrap' => 'nowrap', // nowrap, wrap, break-words
                    'max_width' => 'max-w-none', // max-w-none para una línea, max-w-2xl para wrap
                ],

                'subtitle' => [
                    'text' => 'UN MUNDO DE TECNOLOGÍA, SEGURIDAD Y DISEÑO.',
                    'font_size' => 'text-xl md:text-2xl',
                    'font_weight' => 'font-light',
                    'text_color' => 'text-white/90',
                    'position' => 'top-left', // Independiente del título
                    'margin_top' => 'mt-0', // Margen superior
                    'margin_bottom' => 'mb-6', // Margen inferior
                    'line_wrap' => 'nowrap', // nowrap, wrap, break-words
                    'max_width' => 'max-w-none', // max-w-none para una línea, max-w-2xl para wrap
                ],

                'description' => [
                    'text' => 'La marca que revolucionó Asia y Europa, llega a Bolivia.',
                    'highlight_text' => 'llega a Bolivia',
                    'highlight_style' => 'font-semibold text-white',
                    'font_size' => 'text-lg',
                    'font_weight' => 'font-normal',
                    'text_color' => 'text-white/80',
                    'position' => 'top-left', // Independiente
                    'margin_top' => 'mt-0', // Margen superior
                    'margin_bottom' => 'mb-[600px]', // Margen inferior
                    'line_wrap' => 'wrap',
                    'max_width' => 'max-w-xl',
                ],

                'primary_button' => [
                    'text' => 'Descubre más',
                    'show' => true,
                    'style' => 'solid', // solid, outline, ghost
                    'bg_color' => 'bg-black',
                    'text_color' => 'text-white',
                    'hover_bg' => 'hover:bg-black/90',
                    'hover_scale' => 'hover:scale-105',
                    'size' => 'px-8 py-4 text-lg',
                    'font_weight' => 'font-semibold',
                    'border_radius' => 'rounded-lg',
                    'icon' => 'arrow-right',
                    'icon_position' => 'right', // left, right, none
                    'action' => 'scroll-to-models',
                    'line_wrap' => 'wrap',
                    'max_width' => 'max-w-2xl',
                ],


                'button_container' => [
                    'layout' => 'flex-col sm:flex-row',
                    'gap' => 'gap-4',
                    'position' => 'bottom-left', // Posición del contenedor de botones
                    'margin_top' => 'mt-auto', // Margen superior
                    'margin_bottom' => 'mb-6', // Margen inferior
                ]
            ],

            [
                'id' => 2,
                'media_type' => 'image',
                'media_src' => 'frontend/images/Banner Web 2.jpg',
                'media_src_mobile' => 'frontend/images/Banner Mobile 2.jpg',
                'video_poster' => 'frontend/images/vehicles/starray/starray.jpg',
                'media_background' => 'bg-black',
                'video_autoplay' => true,
                'video_muted' => true,
                'video_loop' => true,
                'video_preload' => 'auto', // auto, metadata, none
                'video_quality' => 'high', // high, medium, low
                'overlay_opacity' => 0.5,
                'only_image' => true,
                'media_fit' => 'contain', // cover, contain, fill, scale-down
                'media_position' => 'center', // center, top, bottom, left, right
                'buttons' => false,
                'show_title' => false,    // Ocultar título
                'show_subtitle' => false, // Ocultar subtítulo
                'show_description' => false, // Ocultar descripción


                'title' => [
                    'text' => 'TECNOLOGÍA AVANZADA',
                    'highlight_text' => 'TECNOLOGÍA',
                    'gradient_from' => '#3b82f6',
                    'gradient_to' => '#8b5cf6',
                    'font_size' => 'text-5xl md:text-7xl',
                    'font_weight' => 'font-bold',
                    'text_color' => 'text-white',
                    'position' => 'top-left',
                    'margin_top' => 'mt-0', // Margen superior
                    'margin_bottom' => 'mb-6', // Margen inferior
                    'line_height' => 'leading-tight',
                    'letter_spacing' => 'tracking-normal',
                    'line_wrap' => 'wrap', // nowrap, wrap, break-words
                    'max_width' => 'max-w-none', // max-w-none para una línea, max-w-2xl para wrap
                ],

                'subtitle' => [
                    'text' => 'Innovación que transforma tu experiencia de conducir',
                    'font_size' => 'text-2xl md:text-3xl',
                    'font_weight' => 'font-light',
                    'text_color' => 'text-white/90',
                    'position' => 'top-left', // Independiente del título
                    'margin_top' => 'mt-0', // Margen superior
                    'margin_bottom' => 'mb-6', // Margen inferior
                    'line_wrap' => 'wrap', // nowrap, wrap, break-words
                    'max_width' => 'max-w-none', // max-w-none para una línea, max-w-2xl para wrap
                ],

                'primary_button' => [
                    'text' => 'Descubre más',
                    'show' => true,
                    'style' => 'solid', // solid, outline, ghost
                    'bg_color' => 'bg-black',
                    'text_color' => 'text-white',
                    'hover_bg' => 'hover:bg-black/90',
                    'hover_scale' => 'hover:scale-105',
                    'size' => 'px-8 py-4 text-lg',
                    'font_weight' => 'font-semibold',
                    'border_radius' => 'rounded-lg',
                    'icon' => 'arrow-right',
                    'icon_position' => 'right', // left, right, none
                    'action' => 'scroll-to-models',
                ],

                'button_container' => [
                    'layout' => 'flex-col sm:flex-row',
                    'gap' => 'gap-4',
                    'position' => 'top-left', // Posición del contenedor de botones
                    'margin_top' => 'mt-0', // Margen superior
                    'margin_bottom' => 'mb-6', // Margen inferior
                ]
            ],

            [
                'id' => 3,
                'media_type' => 'image',
                'media_src' => 'frontend/images/Banner Web 3.jpg',
                'media_src_mobile' => 'frontend/images/Banner Mobile 3.jpg',
                'media_fit' => 'contain', // cover, contain, fill, scale-down
                'media_position' => 'center', // center, top, bottom, left, right
                'media_background' => 'bg-black', // Color de fondo si la imagen no cubre todo
                'object_position_mobile' => '50% 70%', // En móvil enfoca el auto (parte inferior)
                'object_position_desktop' => '50% 50%', // En desktop enfoca el centro
                'overlay_opacity' => 0.3,
                'only_image' => true,
                'buttons' => false,
                'show_title' => false,    // Ocultar título
                'show_subtitle' => false, // Ocultar subtítulo
                'show_description' => false, // Ocultar descripción

                'title' => [
                    'text' => 'GX3 PRO LLEGÓ',
                    'highlight_text' => 'GX3 PRO',
                    'gradient_from' => '#fbbf24',
                    'gradient_to' => '#f59e0b',
                    'font_size' => 'text-4xl md:text-6xl',
                    'font_weight' => 'font-bold',
                    'text_color' => 'text-white',
                    'position' => 'top-left',
                    'margin_top' => 'mt-0', // Margen superior
                    'margin_bottom' => 'mb-6', // Margen inferior
                    'line_height' => 'leading-tight',
                    'letter_spacing' => 'tracking-normal',
                    'line_wrap' => 'nowrap', // nowrap, wrap, break-words
                    'max_width' => 'max-w-none', // max-w-none para una línea, max-w-2xl para wrap
                ],

                'subtitle' => [
                    'text' => 'El SUV compacto más esperado del año',
                    'font_size' => 'text-xl md:text-2xl',
                    'font_weight' => 'font-light',
                    'text_color' => 'text-white/90',
                    'position' => 'top-left', // Independiente del título
                    'margin_top' => 'mt-0', // Margen superior
                    'margin_bottom' => 'mb-6', // Margen inferior
                    'line_wrap' => 'nowrap', // nowrap, wrap, break-words
                    'max_width' => 'max-w-none', // max-w-none para una línea, max-w-2xl para wrap
                ],

                'primary_button' => [
                    'text' => 'Descubre más',
                    'show' => true,
                    'style' => 'solid', // solid, outline, ghost
                    'bg_color' => 'bg-black',
                    'text_color' => 'text-white',
                    'hover_bg' => 'hover:bg-black/90',
                    'hover_scale' => 'hover:scale-105',
                    'size' => 'px-8 py-4 text-lg',
                    'font_weight' => 'font-semibold',
                    'border_radius' => 'rounded-lg',
                    'icon' => 'arrow-right',
                    'icon_position' => 'right', // left, right, none
                    'action' => 'scroll-to-models',
                ],

                'button_container' => [
                    'layout' => 'flex-col sm:flex-row',
                    'gap' => 'gap-4',
                    'position' => 'top-left', // Posición del contenedor de botones
                    'margin_top' => 'mt-0', // Margen superior
                    'margin_bottom' => 'mb-6', // Margen inferior
                ]
            ]
        ]
    ];

    public function updateVideoProgress($currentTime, $duration)
    {
        $this->videoCurrentTime = $currentTime;
        $this->videoDuration = $duration;
        $this->videoProgress = $duration > 0 ? ($currentTime / $duration) * 100 : 0;
    }

    public function videoEnded()
    {
        $this->nextSlide();
    }

    public function isOnlyImage($slide)
    {
        return isset($slide['only_image']) && $slide['only_image'] === true;
    }

    public function mount()
    {
        $this->isMobile = $this->detectMobile();
    }

    private function detectMobile()
    {
        $userAgent = request()->header('User-Agent');
        return preg_match('/(android|iphone|ipad|mobile)/i', $userAgent);
    }

    public function pauseVideo()
    {
        $this->isPaused = true;
        $this->dispatch('pause-video');
    }

    public function playVideo()
    {
        $this->isPaused = false;
        $this->dispatch('play-video');
    }

    public function nextSlide()
    {
        $this->currentSlide = ($this->currentSlide + 1) % count($this->heroConfig['slides']);
        $this->videoProgress = 0;
        $this->videoCurrentTime = 0;
        $this->videoDuration = 0;
    }

    public function prevSlide()
    {
        $this->currentSlide = $this->currentSlide > 0 ? $this->currentSlide - 1 : count($this->heroConfig['slides']) - 1;
        $this->videoProgress = 0;
        $this->videoCurrentTime = 0;
        $this->videoDuration = 0;
    }

    public function goToSlide($index)
    {
        $this->currentSlide = $index;
        $this->videoProgress = 0;
        $this->videoCurrentTime = 0;
        $this->videoDuration = 0;
    }

    public function render()
    {
        return view('livewire.front.hero-section');
    }
}
