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
        $this->loadStaticBoxes();
    }

    private function loadStaticBoxes()
    {
        $this->boxes = [
            [
                'id' => 'test-drive',
                'title' => 'TEST DRIVE',
                'svg_icon' => file_get_contents(public_path("assets/images/icons/whatsapp.svg")),
                'route' => 'test-drive',
                'color' => '#2563eb'
            ],
            [
                'id' => 'cotiza',
                'title' => 'COTIZAR',
                'svg_icon' => file_get_contents(public_path("assets/images/icons/credit.svg")),
                'route' => 'cotizar',
                'color' => '#2563eb'
            ],
            [
                'id' => 'direcciones',
                'title' => 'DIRECCIONES',
                'svg_icon' => file_get_contents(public_path("assets/images/icons/location.svg")),
                'route' => 'direcciones',
                'color' => '#2563eb'
            ],
            [
                'id' => 'contactanos',
                'title' => 'CONTÁCTANOS',
                'svg_icon' => file_get_contents(public_path("assets/images/icons/contact.svg")),
                'route' => 'contacto',
                'color' => '#2563eb'
            ]
        ];
    }

    public function redirectTo($route)
    {
        return redirect()->route($route);
    }
    public function render()
    {
        return view('livewire.front.action-boxes-section');
    }
}
