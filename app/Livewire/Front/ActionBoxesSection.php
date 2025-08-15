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
                'svg_icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9L18 10H6l-2.5 1.1c-.8.2-1.5 1-1.5 1.9v3c0 .6.4 1 1 1h2"/><circle cx="7" cy="17" r="2"/><path d="M9 17h6"/><circle cx="17" cy="17" r="2"/><path d="M5 9V6a1 1 0 0 1 1-1h4l2 2h6a1 1 0 0 1 1 1v1"/><path d="M12 8v4"/><path d="M10 10h4"/></svg>',
                'route' => 'test-drive',
                'color' => '#2563eb'
            ],
            [
                'id' => 'cotiza',
                'title' => 'COTIZA',
                'svg_icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9L18 10H6l-2.5 1.1c-.8.2-1.5 1-1.5 1.9v3c0 .6.4 1 1 1h2"/><circle cx="7" cy="17" r="2"/><path d="M9 17h6"/><circle cx="17" cy="17" r="2"/><path d="M8 10h8"/><path d="M8 12h6"/></svg>',
                'route' => 'cotizar',
                'color' => '#2563eb'
            ],
            [
                'id' => 'direcciones',
                'title' => 'DIRECCIONES',
                'svg_icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>',
                'route' => 'direcciones',
                'color' => '#2563eb'
            ],
            [
                'id' => 'contactanos',
                'title' => 'CONTÁCTANOS',
                'svg_icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>',
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
