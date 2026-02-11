<?php

namespace App\Livewire\Front;

use Livewire\Component;

class HeroSection extends Component
{
    // Ya NO necesitamos estas propiedades sincronizadas con el servidor
    // public $currentSlide = 0;
    // public $videoProgress = 0;
    // public $videoCurrentTime = 0;
    // public $videoDuration = 0;
    // public $isPaused = false;

    public $isMobile = false;

    public $heroConfig = [
        'autoplay' => true,
        'autoplay_interval' => 8000,
        'show_dots' => true,
        'show_arrows' => true,
        'pause_on_hover' => true,
        'show_video_controls' => true,

        'layout_config' => [
            'spacing' => 'space-y-4',
            'element_order' => ['title', 'subtitle', 'description', 'buttons']
        ],

        'slides' => [
            [
                'id' => 3,
                'media_type' => 'image',
                'media_src' => 'frontend/images/ban2710_web.jpg',
                'media_src_mobile' => 'frontend/images/ban2710_phone.jpg',
                'media_fit' => 'contain',
                'media_position' => 'center',
                'media_background' => 'bg-black',
                'object_position_mobile' => '50% 70%',
                'object_position_desktop' => '50% 50%',
                'overlay_opacity' => 0.3,
                'only_image' => true,
                'buttons' => false,
                'show_title' => false,
                'show_subtitle' => false,
                'show_description' => false,

                'title' => [
                    'text' => 'GX3 PRO LLEGÓ',
                    'highlight_text' => 'GX3 PRO',
                    'gradient_from' => '#fbbf24',
                    'gradient_to' => '#f59e0b',
                    'font_size' => 'text-4xl md:text-6xl',
                    'font_weight' => 'font-bold',
                    'text_color' => 'text-white',
                    'position' => 'top-left',
                    'margin_top' => 'mt-0',
                    'margin_bottom' => 'mb-6',
                    'line_height' => 'leading-tight',
                    'letter_spacing' => 'tracking-normal',
                    'line_wrap' => 'nowrap',
                    'max_width' => 'max-w-none',
                ],

                'subtitle' => [
                    'text' => 'El SUV compacto más esperado del año',
                    'font_size' => 'text-xl md:text-2xl',
                    'font_weight' => 'font-light',
                    'text_color' => 'text-white/90',
                    'position' => 'top-left',
                    'margin_top' => 'mt-0',
                    'margin_bottom' => 'mb-6',
                    'line_wrap' => 'nowrap',
                    'max_width' => 'max-w-none',
                ],

                'primary_button' => [
                    'text' => 'Descubre más',
                    'show' => true,
                    'style' => 'solid',
                    'bg_color' => 'bg-black',
                    'text_color' => 'text-white',
                    'hover_bg' => 'hover:bg-black/90',
                    'hover_scale' => 'hover:scale-105',
                    'size' => 'px-8 py-4 text-lg',
                    'font_weight' => 'font-semibold',
                    'border_radius' => 'rounded-lg',
                    'icon' => 'arrow-right',
                    'icon_position' => 'right',
                    'action' => 'scroll-to-models',
                ],

                'button_container' => [
                    'layout' => 'flex-col sm:flex-row',
                    'gap' => 'gap-4',
                    'position' => 'top-left',
                    'margin_top' => 'mt-0',
                    'margin_bottom' => 'mb-6',
                ]
            ],
        ]
    ];

    public function mount()
    {
        $this->isMobile = $this->detectMobile();
    }

    private function detectMobile()
    {
        $userAgent = request()->header('User-Agent');
        return preg_match('/(android|iphone|ipad|mobile)/i', $userAgent);
    }

    public function render()
    {
        return view('livewire.front.hero-section');
    }
}
