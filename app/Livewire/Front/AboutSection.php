<?php

namespace App\Livewire\Front;

use App\Models\Page;
use Livewire\Component;

class AboutSection extends Component
{

    public $layout = 'centered'; // centered, split-left, split-right, compact-left, compact-right
    public $sectionData = [];

    private $defaultSectionData = [
        'logo' => 'frontend/images/logo-negro.svg',
        'title' => 'GEELY',
        'description' => '',
        'button_text' => 'Descubre más',
        'button_url' => 'https://global.geely.com/',
        'background_color' => '#000000',
        'text_color' => '#fff',
        'car_image' => 'frontend/images/7080348 1.png',
        'car_alt' => 'Geely Starray',
        'image_height' => 'h-[400px] lg:h-[500px]',
        'image_classes' => 'w-full object-cover'
    ];

    public function mount($layout = 'centered', $sectionData = [])
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
            $page = Page::where('slug', 'about')->where('is_active', true)->first();

            if (!$page) {
                return [];
            }

            $data = [
                'title' => $page->title,
                'description' => $page->content,
                'button_text' => $page->button_text,
                'button_url' => $page->button_url,
            ];

            if ($page->image) {
                $data['logo'] = $page->image;
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
            'logo' => 'frontend/images/logo-negro.svg',
            'title' => 'GEELY',
            'description' => 'En Geely Bolivia, ofrecemos vehículos que combinan seguridad, tecnología avanzada y un diseño de vanguardia. Creemos que la movilidad de calidad debe ser una experiencia al alcance de todos. Es por eso que cada uno de nuestros autos está creado para quienes valoran la innovación, la eficiencia y las nuevas formas de moverse con libertad y confianza.',
            'button_text' => 'Descubre más',
            'button_url' => 'https://global.geely.com/',
            'background_color' => '#000000',
            'text_color' => '#fff',
            'car_image' => 'frontend/images/7080348 1.png',
            'car_alt' => 'Geely Starray',
            'image_height' => 'h-[400px] lg:h-[500px]',
            'image_classes' => 'w-full object-cover'
        ];
    }

    public function render()
    {
        return view('livewire.front.about-section');
    }
}
