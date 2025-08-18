<?php

namespace App\Livewire\Front;

use Livewire\Component;

class VehicleSubNavigation extends Component
{

    public $activeSection = '';
    public $menuItems = [];

    private $defaultMenuItems = [
        [
            'id' => 'starray',
            'label' => 'Starray',
            'anchor' => '#starray',
            'active' => true
        ],
        [
            'id' => 'versiones',
            'label' => 'Versiones',
            'anchor' => '#versiones',
            'active' => false
        ],
        [
            'id' => 'tecnologia',
            'label' => 'Tecnología',
            'anchor' => '#tecnologia',
            'active' => false
        ],
        [
            'id' => 'diseno',
            'label' => 'Diseño',
            'anchor' => '#diseno',
            'active' => false
        ]
    ];

    public function mount($menuItems = [])
    {
        $this->menuItems = empty($menuItems) ? $this->defaultMenuItems : $menuItems;
        $this->activeSection = $this->menuItems[0]['id'] ?? '';
    }
    public function render()
    {
        return view('livewire.front.vehicle-sub-navigation');
    }
}
