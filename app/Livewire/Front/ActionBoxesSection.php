<?php

namespace App\Livewire\Front;

use Livewire\Component;

class ActionBoxesSection extends Component
{
    public $sectionTitle = '¿QUÉ DESEAS HACER HOY?';
    public $backgroundColor = '#e5e7eb';
    public $boxes;

    public function mount()
    {
        $this->boxes = $this->getBoxesProperty();

    }

    public function getBoxesProperty()
    {
        return [
            [
                'id' => 'test-drive',
                'title' => 'TEST DRIVE',
                'svg_icon' => file_get_contents(public_path("assets/images/icons/whatsapp.svg")),
                'route' => 'forms.base',
                'color' => '#2563eb',
                'is_anchor' => false
            ],
            [
                'id' => 'cotiza',
                'title' => 'COTIZAR',
                'svg_icon' => file_get_contents(public_path("assets/images/icons/credit.svg")),
                'route' => 'forms.base',
                'color' => '#2563eb',
                'is_anchor' => false
            ],
            [
                'id' => 'direcciones',
                'title' => 'DIRECCIONES',
                'svg_icon' => file_get_contents(public_path("assets/images/icons/location.svg")),
                'route' => '#direcciones',
                'color' => '#2563eb',
                'is_anchor' => true
            ],
            [
                'id' => 'contactanos',
                'title' => 'CONTÁCTANOS',
                'svg_icon' => file_get_contents(public_path("assets/images/icons/contact.svg")),
                'route' => 'forms.base',
                'color' => '#2563eb',
                'is_anchor' => false
            ]
        ];
    }

    private function getCachedSvg($iconName)
    {
        return cache()->remember("svg_icon_{$iconName}", 3600, function() use ($iconName) {
            return file_get_contents(public_path("assets/images/icons/{$iconName}.svg"));
        });
    }

    public function redirectTo($route)
    {
        // Si es un ancla, no hacer nada (dejar que el href maneje)
        if (str_starts_with($route, '#')) {
            return;
        }

        // Si es una ruta normal, redirigir
        return redirect()->route($route);
    }
    public function render()
    {
        return view('livewire.front.action-boxes-section');
    }
}
