<?php

namespace App\Livewire\Front;

use App\Models\HeroSlide;
use Livewire\Component;

class HeroSection extends Component
{
    public $isMobile = false;

    public $heroConfig = [];

    public function mount()
    {
        $this->isMobile = $this->detectMobile();
        $this->heroConfig = $this->loadHeroConfig();
    }

    private function loadHeroConfig()
    {
        $dbSlides = HeroSlide::active()->ordered()->get();

        if ($dbSlides->isNotEmpty()) {
            $slides = $dbSlides->map(function ($slide) {
                return [
                    'id' => $slide->id,
                    'media_type' => $slide->media_type,
                    'media_src' => $slide->media_src,
                    'media_src_mobile' => $slide->media_src_mobile,
                    'media_fit' => 'contain',
                    'media_position' => 'center',
                    'media_background' => 'bg-black',
                    'overlay_opacity' => $slide->overlay_opacity ?? 0,
                    'only_image' => true,
                    'buttons' => false,
                    'show_title' => false,
                    'show_subtitle' => false,
                    'show_description' => false,
                    'title' => [
                        'text' => $slide->title ?? '',
                        'gradient_from' => $slide->gradient_from ?? '#fbbf24',
                        'gradient_to' => $slide->gradient_to ?? '#f59e0b',
                    ],
                    'subtitle' => [
                        'text' => $slide->subtitle ?? '',
                    ],
                    'primary_button' => [
                        'text' => $slide->button_text ?? '',
                        'show' => !empty($slide->button_text),
                        'action' => $slide->button_action ?? '',
                        'url' => $slide->button_url ?? '',
                    ],
                ];
            })->toArray();

            return [
                'autoplay' => true,
                'autoplay_interval' => 8000,
                'show_dots' => true,
                'show_arrows' => true,
                'pause_on_hover' => true,
                'show_video_controls' => true,
                'slides' => $slides,
            ];
        }

        // LEGACY - fallback hardcodeado
        return $this->getLegacyHeroConfig();
    }

    // LEGACY - configuración hardcodeada original
    private function getLegacyHeroConfig()
    {
        return [
            'autoplay' => true,
            'autoplay_interval' => 8000,
            'show_dots' => true,
            'show_arrows' => true,
            'pause_on_hover' => true,
            'show_video_controls' => true,
            'slides' => [
                [
                    'id' => 3,
                    'media_type' => 'image',
                    'media_src' => 'frontend/images/ban2710_web.jpg',
                    'media_src_mobile' => 'frontend/images/ban2710_phone.jpg',
                    'media_fit' => 'contain',
                    'media_position' => 'center',
                    'media_background' => 'bg-black',
                    'overlay_opacity' => 0.3,
                    'only_image' => true,
                    'buttons' => false,
                    'show_title' => false,
                    'show_subtitle' => false,
                    'show_description' => false,
                    'title' => [
                        'text' => 'GX3 PRO LLEGÓ',
                        'gradient_from' => '#fbbf24',
                        'gradient_to' => '#f59e0b',
                    ],
                    'subtitle' => [
                        'text' => 'El SUV compacto más esperado del año',
                    ],
                    'primary_button' => [
                        'text' => 'Descubre más',
                        'show' => true,
                        'action' => 'scroll-to-models',
                    ],
                ],
            ],
        ];
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
