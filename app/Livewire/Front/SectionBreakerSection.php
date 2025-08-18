<?php

namespace App\Livewire\Front;

use Livewire\Component;

class SectionBreakerSection extends Component
{

    public $breakerData = [];

    private $defaultBreakerData = [
        'section_background' => 'bg-gray-100',
        'section_padding' => 'py-16',

        'content' => [
            'title' => '¿QUÉ DESEAS HACER HOY?',
            'subtitle' => 'Explora todas las opciones disponibles para ti',
            'title_size' => 'text-3xl lg:text-4xl',
            'subtitle_size' => 'text-lg lg:text-xl',
            'title_color' => 'text-gray-900',
            'subtitle_color' => 'text-gray-600',
            'title_font_weight' => 'font-bold',
            'subtitle_font_weight' => 'font-normal',
            'text_align' => 'text-center',
            'max_width' => 'max-w-4xl',
            'spacing' => 'space-y-4'
        ],

        'styles' => [
            'title_gradient' => false,
            'title_gradient_colors' => 'bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent',
            'subtitle_gradient' => false,
            'subtitle_gradient_colors' => 'bg-gradient-to-r from-gray-600 to-gray-800 bg-clip-text text-transparent'
        ]
    ];

    public function mount($breakerData = [])
    {
        // Merge recursivo para mantener la estructura completa
        $this->breakerData = array_merge_recursive($this->defaultBreakerData, $breakerData);

        // O mejor aún, hacer merge individual por sección:
        $this->breakerData = $this->defaultBreakerData;

        if (isset($breakerData['section_background'])) {
            $this->breakerData['section_background'] = $breakerData['section_background'];
        }

        if (isset($breakerData['section_padding'])) {
            $this->breakerData['section_padding'] = $breakerData['section_padding'];
        }

        if (isset($breakerData['content'])) {
            $this->breakerData['content'] = array_merge($this->breakerData['content'], $breakerData['content']);
        }

        if (isset($breakerData['styles'])) {
            $this->breakerData['styles'] = array_merge($this->breakerData['styles'], $breakerData['styles']);
        }
    }
    public function render()
    {
        return view('livewire.front.section-breaker-section');
    }
}
