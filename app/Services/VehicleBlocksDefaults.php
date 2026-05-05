<?php

namespace App\Services;

use App\Models\Vehicle;

/**
 * Genera el set por defecto de page_blocks para un vehiculo.
 *
 * - Si recibe un Vehicle, lo usa para hidratar nombre, descripciones, imagen,
 *   gallery y leer la primera version (relacion versions) para quick_specs.
 * - Si no recibe nada, devuelve placeholders genericos en espanol.
 *
 * El orden de los 10 bloques matchea el diseno final del sitio.
 */
class VehicleBlocksDefaults
{
    /**
     * @return array<int, array{type: string, data: array<string, mixed>}>
     */
    public static function generate(?Vehicle $vehicle = null): array
    {
        return [
            ['type' => 'hero', 'data' => self::heroBlock($vehicle)],
            ['type' => 'quick_specs', 'data' => self::quickSpecsBlock($vehicle)],
            ['type' => 'anchor_nav', 'data' => self::anchorNavBlock($vehicle)],
            ['type' => 'three_reasons', 'data' => self::threeReasonsBlock($vehicle)],
            ['type' => 'versions_pricing', 'data' => self::versionsPricingBlock($vehicle)],
            ['type' => 'quick_actions', 'data' => self::quickActionsBlock($vehicle)],
            ['type' => 'features', 'data' => self::featuresBlock($vehicle)],
            ['type' => 'video', 'data' => self::videoBlock($vehicle)],
            ['type' => 'feature_carousel', 'data' => self::featureCarouselBlock($vehicle)],
            ['type' => 'gallery', 'data' => self::galleryBlock($vehicle)],
        ];
    }

    protected static function heroBlock(?Vehicle $v): array
    {
        $name = $v?->name ?? 'Modelo';

        return [
            'title' => $name,
            'subtitle' => 'El SUV mas impactante.',
            'description' => $v?->description ?? 'Descubre el nuevo '.$name.': diseno, tecnologia y rendimiento en un solo vehiculo.',
            'background' => $v?->image,
            'cta_text' => 'Descubre mas',
            'cta_link' => '#versiones',
        ];
    }

    protected static function quickSpecsBlock(?Vehicle $v): array
    {
        $version = $v?->versions()->first();
        $vehicleSpecs = is_array($v?->specs) ? $v->specs : [];

        return [
            'items' => [
                [
                    'label' => 'Motor',
                    'value' => $version?->engine_displacement ?? ($vehicleSpecs['motor'] ?? '1.5 L'),
                    'suffix' => $version?->turbo ? 'Turbo' : '',
                ],
                [
                    'label' => 'Potencia',
                    'value' => $version?->horsepower ?? ($vehicleSpecs['potencia'] ?? '174'),
                    'suffix' => 'hp',
                ],
                [
                    'label' => 'Transmision',
                    'value' => $version?->transmission ?? ($vehicleSpecs['transmision'] ?? '7'),
                    'suffix' => 'velocidades',
                ],
                [
                    'label' => 'Plataforma',
                    'value' => $version?->platform ?? ($vehicleSpecs['plataforma'] ?? 'CMA'),
                    'suffix' => '',
                ],
            ],
        ];
    }

    protected static function anchorNavBlock(?Vehicle $v): array
    {
        $name = $v?->name ?? 'Modelo';

        return [
            'links' => [
                ['label' => $name, 'anchor' => '#hero'],
                ['label' => 'Versiones', 'anchor' => '#versiones'],
                ['label' => 'Tecnologia', 'anchor' => '#tecnologia'],
                ['label' => 'Diseno', 'anchor' => '#diseno'],
                ['label' => 'Galeria', 'anchor' => '#galeria'],
            ],
        ];
    }

    protected static function threeReasonsBlock(?Vehicle $v): array
    {
        $name = $v?->name ?? 'modelo';

        return [
            'title' => 'El SUV ultra moderno',
            'subtitle' => 'Tres razones para elegir al '.$name.': la combinacion perfecta de lujo, tecnologia y diseno.',
            'reasons' => [
                [
                    'title' => 'Lujo',
                    'subtitle' => 'Materiales premium e interior cuidado al detalle.',
                    'image' => null,
                ],
                [
                    'title' => 'Tecnologia',
                    'subtitle' => 'Asistencias inteligentes, conectividad total y pantalla HD.',
                    'image' => null,
                ],
                [
                    'title' => 'Diseno futurista',
                    'subtitle' => 'Lineas modernas, iluminacion LED y presencia imponente.',
                    'image' => null,
                ],
            ],
        ];
    }

    protected static function versionsPricingBlock(?Vehicle $v): array
    {
        return [
            'title' => 'Versiones y precios',
            'show_exterior_interior_tabs' => true,
        ];
    }

    protected static function quickActionsBlock(?Vehicle $v): array
    {
        return [
            'actions' => [
                [
                    'label' => 'WhatsApp',
                    'icon' => 'whatsapp',
                    'link' => 'https://wa.me/'.config('services.geely.whatsapp_number').'?text='.urlencode(config('services.geely.whatsapp_message').' '.($v?->name ?? '')),
                    'type' => 'external',
                ],
                [
                    'label' => 'Cotizar',
                    'icon' => 'drive',
                    'link' => '/cotizar',
                    'type' => 'internal',
                ],
                [
                    'label' => 'Direcciones',
                    'icon' => 'map',
                    'link' => '/direcciones',
                    'type' => 'internal',
                ],
                [
                    'label' => 'Contactanos',
                    'icon' => 'headset',
                    'link' => '/contactanos',
                    'type' => 'internal',
                ],
            ],
        ];
    }

    protected static function featuresBlock(?Vehicle $v): array
    {
        return [
            'title' => 'Con Geely Obtienes Mas',
            'description' => 'Geely te da los mejores beneficios y condiciones del mercado para que puedas empezar a conducir con total tranquilidad.',
            'highlights' => [
                [
                    'number' => '5',
                    'unit' => 'ANOS',
                    'separator' => 'o',
                    'description' => 'Garantia Extendida',
                ],
                [
                    'number' => '150.000',
                    'unit' => 'KM',
                    'separator' => 'EN',
                    'description' => 'Lo que suceda primero',
                ],
                [
                    'number' => '6',
                    'unit' => 'SERVICIOS',
                    'separator' => 'EN',
                    'description' => 'En 3 anos',
                ],
            ],
        ];
    }

    protected static function videoBlock(?Vehicle $v): array
    {
        $name = $v?->name ?? 'modelo';

        return [
            'title' => 'Videos y Resenas',
            'subtitle' => 'Conoce todo sobre Geely '.$name.' con los siguientes videos.',
            'youtube_url' => null,
        ];
    }

    protected static function featureCarouselBlock(?Vehicle $v): array
    {
        return [
            'sections' => [
                [
                    'title' => 'Potente y Dinamico',
                    'slides' => [
                        [
                            'title' => 'Motor Turbo',
                            'description' => 'Maxima potencia y respuesta inmediata.',
                            'label' => 'Motor 1.5 Turbo',
                            'image' => null,
                        ],
                        [
                            'title' => 'Transmision DCT',
                            'description' => 'Cambios suaves y precisos.',
                            'label' => 'Doble embrague',
                            'image' => null,
                        ],
                    ],
                ],
                [
                    'title' => 'Interior Lujoso y Totalmente Equipado',
                    'slides' => [
                        [
                            'title' => 'Asientos premium',
                            'description' => 'Confort y materiales de alta calidad.',
                            'label' => 'Cuero sintetico',
                            'image' => null,
                        ],
                        [
                            'title' => 'Climatizador bi-zona',
                            'description' => 'Temperatura ideal para todos.',
                            'label' => 'Bi-zona',
                            'image' => null,
                        ],
                    ],
                ],
                [
                    'title' => 'Tecnologia',
                    'slides' => [
                        [
                            'title' => 'Pantalla HD',
                            'description' => 'Sistema de info-entretenimiento de ultima generacion.',
                            'label' => 'Tactil HD',
                            'image' => null,
                        ],
                        [
                            'title' => 'Camara 360',
                            'description' => 'Maxima visibilidad al maniobrar.',
                            'label' => '360 HD',
                            'image' => null,
                        ],
                    ],
                ],
                [
                    'title' => 'Seguridad Total',
                    'slides' => [
                        [
                            'title' => 'Bolsas de aire',
                            'description' => 'Proteccion integral para todos los pasajeros.',
                            'label' => '6 airbags',
                            'image' => null,
                        ],
                        [
                            'title' => 'Frenos ABS y EBD',
                            'description' => 'Frenado optimo en cualquier condicion.',
                            'label' => 'ABS + EBD',
                            'image' => null,
                        ],
                    ],
                ],
            ],
        ];
    }

    protected static function galleryBlock(?Vehicle $v): array
    {
        $images = is_array($v?->gallery) ? array_values(array_filter($v->gallery)) : [];

        return [
            'title' => 'Galeria de Imagenes',
            'images' => $images,
        ];
    }
}
