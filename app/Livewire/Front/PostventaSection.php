<?php

namespace App\Livewire\Front;

use App\Models\Page;
use Livewire\Component;

class PostventaSection extends Component
{

    public $layout = 'split-right'; // split-right, compact, overlay-left
    public $sectionData = [];

    private $defaultSectionData = [
        'title' => 'POSVENTA',
        'subtitle' => '',
        'description' => '',
        'button_text' => 'Agenda ahora',
        'button_url' => '#',
        'building_image' => 'frontend/images/geely-building.png',
        'building_image_mobile' => 'frontend/images/Geely_Bolivia_building_mobile.jpg',
        'background_color' => '#ffffff',
        'text_color' => '#333333',
        'show_image' => true,
        'section_height' => 'min-h-[500px]',
        'image_classes' => 'w-full h-full object-cover'
    ];

    public function mount($layout = 'split-right', $sectionData = [])
    {
        $this->layout = $layout;

        // Load from database first
        $dbData = $this->loadFromDatabase();

        // Fallback to hardcoded config if DB is empty
        if (empty($dbData)) {
            $dbData = $this->getDataLegacy();
        }

        $this->sectionData = array_merge($this->defaultSectionData, $dbData, $sectionData);
    }

    private function loadFromDatabase(): array
    {
        try {
            $page = Page::where('slug', 'posventa')->where('is_active', true)->first();

            if (!$page) {
                return [];
            }

            $data = [
                'title' => $page->title,
                'description' => $page->content,
                'button_text' => $page->button_text,
                'button_url' => $page->button_url,
            ];

            if ($page->subtitle) {
                $data['subtitle'] = $page->subtitle;
            }

            if ($page->image) {
                $data['building_image'] = $page->image;
            }

            if ($page->image_mobile) {
                $data['building_image_mobile'] = $page->image_mobile;
            }

            return array_filter($data, fn($value) => $value !== null);
        } catch (\Exception $e) {
            return [];
        }
    }

    // LEGACY - Hardcoded data (fallback)
    private function getDataLegacy(): array
    {
        return [
            'title' => 'POSVENTA',
            'subtitle' => '',
            'description' => 'En Geely, tu tranquilidad continúa después de la compra. Disfruta hasta 5 años de garantía, repuestos originales y un servicio técnico especializado que cuida tu vehículo como el primer día. Porque para nosotros, lo importante no es solo venderte un auto, sino acompañarte en cada kilómetro.',
            'button_text' => 'Agenda ahora',
            'button_url' => '#',
            'building_image' => 'frontend/images/geely-building.png',
            'building_image_mobile' => 'frontend/images/Geely_Bolivia_building_mobile.jpg',
            'background_color' => '#ffffff',
            'text_color' => '#333333',
            'show_image' => true,
            'section_height' => 'min-h-[500px]',
            'image_classes' => 'w-full h-full object-cover'
        ];
    }

    public function render()
    {
        return view('livewire.front.postventa-section');
    }
}
