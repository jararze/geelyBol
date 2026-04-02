<?php

namespace App\Livewire\Front;

use App\Models\Vehicle;
use App\Models\VehicleSection;
use Livewire\Component;

class MosaicGallerySection extends Component
{

    public $galleryData = [];
    public $vehicle = [];

    private $defaultGalleryData = [
        'section_background' => 'bg-white',
        'section_padding' => 'pt-16',

        'header' => [
            'title' => 'GALERÍA DE IMÁGENES',
            'title_size' => 'text-3xl lg:text-4xl',
            'title_color' => 'text-gray-900',
            'title_weight' => 'font-bold',
            'show_header' => true
        ],

        'layout' => [
            'columns' => 3,
            'gap' => 'gap-0',
            'container_height' => 'h-[700px]'
        ],

        'images' => [
            [
                'column' => 1,
                'row_span' => 1,
                'image' => 'frontend/images/mosaico/1.png',
                'alt' => 'Interior detail',
                'overlay' => false
            ],
        ]
    ];

    public function mount($vehicle = [], $galleryData = [])
    {
        $this->vehicle = $vehicle;
        $vehicleSlug = $vehicle['slug'] ?? 'default';

        // Load from database first
        $vehicleConfig = $this->loadFromDatabase($vehicleSlug);

        // Fallback to hardcoded config
        if (empty($vehicleConfig)) {
            $vehicleConfig = $this->getVehicleConfigLegacy($vehicleSlug);
        }

        $this->galleryData = array_merge($this->defaultGalleryData, $vehicleConfig, $galleryData);
    }

    private function loadFromDatabase($slug)
    {
        $vehicle = Vehicle::where('slug', $slug)->first();
        if (!$vehicle) {
            return [];
        }

        $section = VehicleSection::where('vehicle_id', $vehicle->id)
            ->where('section_type', 'gallery')
            ->where('is_active', true)
            ->with('items')
            ->first();

        if (!$section) {
            return [];
        }

        $config = [];

        if ($section->config) {
            $config['layout'] = [
                'columns' => $section->config['columns'] ?? 3,
                'gap' => $section->config['gap'] ?? 'gap-0',
                'container_height' => $section->config['container_height'] ?? 'h-[700px]',
            ];
        }

        $images = [];
        foreach ($section->items->where('is_active', true)->sortBy('order') as $item) {
            $images[] = [
                'column' => $item->column_position ?? 1,
                'row_span' => $item->row_span ?? 1,
                'image' => $item->main_image ?? '',
                'alt' => $item->alt_text ?? '',
                'overlay' => $item->overlay ?? false,
            ];
        }

        if (!empty($images)) {
            $config['images'] = $images;
        }

        return $config;
    }

    // LEGACY - Hardcoded vehicle configurations (fallback)
    private function getVehicleConfigLegacy($slug)
    {
        $configs = [
            'starray' => [
                'layout' => ['columns' => 3, 'gap' => 'gap-0', 'container_height' => 'h-[700px]'],
                'images' => [
                    ['column' => 1, 'row_span' => 1, 'image' => 'frontend/images/mosaico/1.png', 'alt' => 'Interior detail', 'overlay' => false],
                    ['column' => 1, 'row_span' => 1, 'image' => 'frontend/images/mosaico/2.jpg', 'alt' => 'Seat detail', 'overlay' => false],
                    ['column' => 2, 'row_span' => 2, 'image' => 'frontend/images/mosaico/3.jpg', 'alt' => 'Car front view', 'overlay' => false],
                    ['column' => 3, 'row_span' => 1, 'image' => 'frontend/images/mosaico/4.png', 'alt' => 'Grille detail', 'overlay' => false],
                    ['column' => 3, 'row_span' => 1, 'image' => 'frontend/images/mosaico/5.png', 'alt' => 'Dashboard', 'overlay' => false],
                ]
            ],
            'gx3-pro' => [
                'layout' => ['columns' => 2, 'gap' => 'gap-0', 'container_height' => 'h-[700px]'],
                'images' => [
                    ['column' => 1, 'row_span' => 1, 'image' => 'frontend/images/vehicles/gx3pro/mosaic/GX3 Pro Trasero.jpg', 'alt' => 'Interior detail', 'overlay' => false],
                    ['column' => 1, 'row_span' => 1, 'image' => 'frontend/images/vehicles/gx3pro/mosaic/0_4-zoom_322a3488.jpg', 'alt' => 'Seat detail', 'overlay' => false],
                    ['column' => 2, 'row_span' => 1, 'image' => 'frontend/images/vehicles/gx3pro/mosaic/GX3 Pro Diagonal.jpg', 'alt' => 'Grille detail', 'overlay' => false],
                    ['column' => 2, 'row_span' => 1, 'image' => 'frontend/images/vehicles/gx3pro/mosaic/GX3 Pro Aro.jpg', 'alt' => 'Dashboard', 'overlay' => false],
                ]
            ],
            'cityray' => [
                'layout' => ['columns' => 3, 'gap' => 'gap-0', 'container_height' => 'h-[700px]'],
                'images' => [
                    ['column' => 1, 'row_span' => 1, 'image' => 'frontend/images/vehicles/cityray/mosaic/1.jpg', 'alt' => 'Interior detail', 'overlay' => false],
                    ['column' => 1, 'row_span' => 1, 'image' => 'frontend/images/vehicles/cityray/mosaic/2.jpg', 'alt' => 'Seat detail', 'overlay' => false],
                    ['column' => 2, 'row_span' => 2, 'image' => 'frontend/images/vehicles/cityray/mosaic/3.jpg', 'alt' => 'Car front view', 'overlay' => false],
                    ['column' => 2, 'row_span' => 2, 'image' => 'frontend/images/vehicles/cityray/mosaic/4.jpg', 'alt' => 'Grille detail', 'overlay' => false],
                    ['column' => 3, 'row_span' => 1, 'image' => 'frontend/images/vehicles/cityray/mosaic/5.jpg', 'alt' => 'Dashboard', 'overlay' => false],
                    ['column' => 3, 'row_span' => 2, 'image' => 'frontend/images/vehicles/cityray/mosaic/6.jpg', 'alt' => 'Dashboard', 'overlay' => false],
                ]
            ],
            'coolray' => [
                'layout' => ['columns' => 3, 'gap' => 'gap-0', 'container_height' => 'h-[700px]'],
                'images' => [
                    ['column' => 1, 'row_span' => 2, 'image' => 'frontend/images/vehicles/coolray/mosaic/1.jpg', 'alt' => 'Interior detail', 'overlay' => false],
                    ['column' => 2, 'row_span' => 2, 'image' => 'frontend/images/vehicles/coolray/mosaic/2.jpg', 'alt' => 'Seat detail', 'overlay' => false],
                    ['column' => 3, 'row_span' => 2, 'image' => 'frontend/images/vehicles/coolray/mosaic/3.jpg', 'alt' => 'Grille detail', 'overlay' => false],
                ]
            ],
        ];

        return $configs[$slug] ?? [];
    }

    public function getImagesByColumn($column)
    {
        return collect($this->galleryData['images'])
            ->where('column', $column)
            ->values();
    }

    public function render()
    {
        return view('livewire.front.mosaic-gallery-section');
    }
}
