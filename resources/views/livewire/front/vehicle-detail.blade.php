<div>
    {{-- Hero del Vehículo --}}
    <livewire:front.vehicle-hero layout="top-left"/>

    <livewire:front.vehicle-sub-navigation
        :menuItems="[
            ['id' => 'starray', 'label' => 'Starray', 'anchor' => '#starray'],
            ['id' => 'versiones', 'label' => 'Versiones', 'anchor' => '#versiones'],
            ['id' => 'tecnologia', 'label' => 'Tecnología', 'anchor' => '#tecnologia'],
            ['id' => 'diseno', 'label' => 'Diseño', 'anchor' => '#diseno']
        ]"
    />

    <section id="starray" data-section="starray">
        <livewire:front.vehicle-features
            :featuresData="[
            'header' => [
                'title' => 'EL SUV ULTRA MODERNO',
                'subtitle' => '3 Razones para elegir a Geely Starray:'
            ]
        ]" />
    </section>

    <section id="versiones" data-section="versiones">
        <livewire:front.vehicle-versions />
    </section>

    {{-- Action Boxes --}}
    <section id="servicios">
        <livewire:front.action-boxes-section />
    </section>

    <livewire:front.promotions-slider-section />


    <section id="beneficios" >
        <livewire:front.BenefitsSection />
    </section>

    <livewire:front.video-reviews-section />

    <livewire:front.section-breaker-section :breakerData="[
    'section_background' => 'bg-gray-50',
    'section_padding' => 'py-20',
    'content' => [
        'title' => 'GEELY STARRAY',
        'subtitle' => 'Caracteristicas',
        'title_color' => 'text-blue-600',
        'subtitle_color' => 'text-black',
        'title_size' => 'text-4xl lg:text-5xl',
        'text_align' => 'text-left',
        'max_width' => 'max-w-full',
    ]
]" />

    <livewire:front.feature-slider-section :featureData="[
    'header' => [
        'title' => 'POTENTE Y DINAMICO'
    ],
    'layout' => [
        'direction' => 'left'
    ],
    'slides' => [
            [
                'id' => 'motor-turbo',
                'title' => 'MOTOR 2.0 TURBO',
                'subtitle' => '2.0 Turbo Motor - 215 hp Potencia',
                'description' => 'Diseño ultra moderno y vanguardista que destaca en todos los espacios urbanos, citadinos y en los viajes más largos.',
                'main_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente0.jpg',
                'thumbnail_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente0.jpg',
                'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
            ],
            [
                'id' => 'estabilidad-cma',
                'title' => 'ESTABILIDAD CON PLATAFORMA CMA',
                'subtitle' => '115 HP DE POTENCIA',
                'description' => 'Diseño ultra moderno y vanguardista que destaca en todos los espacios urbanos, citadinos y en los viajes más largos.',
                'main_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente1.jpg',
                'thumbnail_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente1.jpg',
                'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
            ],
            [
                'id' => 'tecnologia-avanzada',
                'title' => 'TECNOLOGÍA AVANZADA',
                'subtitle' => '115 HP DE POTENCIA',
                'description' => 'Sistema de tracción inteligente que se adapta a cualquier terreno para máxima seguridad.',
                'main_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente2.jpg',
                'thumbnail_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente2.jpg',
                'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
            ],
            [
                'id' => 'motor-turbo1',
                'title' => 'MOTOR 2.0 TURBO',
                'subtitle' => '2.0 Turbo Motor - 215 hp Potencia',
                'description' => 'Diseño ultra moderno y vanguardista que destaca en todos los espacios urbanos, citadinos y en los viajes más largos.',
                'main_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente02.jpg',
                'thumbnail_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente02.jpg',
                'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
            ],
            [
                'id' => 'estabilidad-cma1',
                'title' => 'ESTABILIDAD CON PLATAFORMA CMA',
                'subtitle' => '115 HP DE POTENCIA',
                'description' => 'Diseño ultra moderno y vanguardista que destaca en todos los espacios urbanos, citadinos y en los viajes más largos.',
                'main_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente3.jpg',
                'thumbnail_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente3.jpg',
                'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
            ],
            [
                'id' => 'tecnologia-avanzada1',
                'title' => 'TECNOLOGÍA AVANZADA',
                'subtitle' => '115 HP DE POTENCIA',
                'description' => 'Sistema de tracción inteligente que se adapta a cualquier terreno para máxima seguridad.',
                'main_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente4.jpg',
                'thumbnail_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente4.jpg',
                'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
            ],
            [
                'id' => 'tecnologia-avanzada2',
                'title' => 'TECNOLOGÍA AVANZADA',
                'subtitle' => '115 HP DE POTENCIA',
                'description' => 'Sistema de tracción inteligente que se adapta a cualquier terreno para máxima seguridad.',
                'main_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente5.jpg',
                'thumbnail_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente5.jpg',
                'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
            ]
        ]

    ]" />

    <livewire:front.feature-slider-section :featureData="[
        'header' => [
            'title' => 'INTERIOR LUJOSO Y TOTALMENTE EQUIPADO'
        ],
        'layout' => [
            'direction' => 'right'
        ],
        'slides' => [
            [
                'id' => 'interno-1',
                'title' => 'MOTOR 2.0 TURBO',
                'subtitle' => '2.0 Turbo Motor - 215 hp Potencia',
                'description' => 'Diseño ultra moderno y vanguardista que destaca en todos los espacios urbanos, citadinos y en los viajes más largos.',
                'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior10.jpg',
                'thumbnail_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior10.jpg',
                'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
            ],
            [
                'id' => 'interno-2',
                'title' => 'ESTABILIDAD CON PLATAFORMA CMA',
                'subtitle' => '115 HP DE POTENCIA',
                'description' => 'Diseño ultra moderno y vanguardista que destaca en todos los espacios urbanos, citadinos y en los viajes más largos.',
                'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior1.jpg',
                'thumbnail_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior1.jpg',
                'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
            ],
            [
                'id' => 'interno-3',
                'title' => 'TECNOLOGÍA AVANZADA',
                'subtitle' => '115 HP DE POTENCIA',
                'description' => 'Sistema de tracción inteligente que se adapta a cualquier terreno para máxima seguridad.',
                'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior2.jpg',
                'thumbnail_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior2.jpg',
                'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
            ],
            [
                'id' => 'interno-4',
                'title' => 'MOTOR 2.0 TURBO',
                'subtitle' => '2.0 Turbo Motor - 215 hp Potencia',
                'description' => 'Diseño ultra moderno y vanguardista que destaca en todos los espacios urbanos, citadinos y en los viajes más largos.',
                'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior9.jpg',
                'thumbnail_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior9.jpg',
                'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
            ],
            [
                'id' => 'interno-5',
                'title' => 'ESTABILIDAD CON PLATAFORMA CMA',
                'subtitle' => '115 HP DE POTENCIA',
                'description' => 'Diseño ultra moderno y vanguardista que destaca en todos los espacios urbanos, citadinos y en los viajes más largos.',
                'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior3.jpg',
                'thumbnail_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior3.jpg',
                'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
            ],
            [
                'id' => 'interno-6',
                'title' => 'TECNOLOGÍA AVANZADA',
                'subtitle' => '115 HP DE POTENCIA',
                'description' => 'Sistema de tracción inteligente que se adapta a cualquier terreno para máxima seguridad.',
                'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior4.jpg',
                'thumbnail_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior4.jpg',
                'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
            ],
            [
                'id' => 'interno-7',
                'title' => 'TECNOLOGÍA AVANZADA',
                'subtitle' => '115 HP DE POTENCIA',
                'description' => 'Sistema de tracción inteligente que se adapta a cualquier terreno para máxima seguridad.',
                'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior5.jpg',
                'thumbnail_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior5.jpg',
                'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
            ],
            [
                'id' => 'interno-8',
                'title' => 'ESTABILIDAD CON PLATAFORMA CMA',
                'subtitle' => '115 HP DE POTENCIA',
                'description' => 'Diseño ultra moderno y vanguardista que destaca en todos los espacios urbanos, citadinos y en los viajes más largos.',
                'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior6.jpg',
                'thumbnail_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior6.jpg',
                'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
            ],
            [
                'id' => 'interno-9',
                'title' => 'TECNOLOGÍA AVANZADA',
                'subtitle' => '115 HP DE POTENCIA',
                'description' => 'Sistema de tracción inteligente que se adapta a cualquier terreno para máxima seguridad.',
                'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior7.jpg',
                'thumbnail_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior7.jpg',
                'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
            ],
            [
                'id' => 'interno-10',
                'title' => 'TECNOLOGÍA AVANZADA',
                'subtitle' => '115 HP DE POTENCIA',
                'description' => 'Sistema de tracción inteligente que se adapta a cualquier terreno para máxima seguridad.',
                'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior8.jpg',
                'thumbnail_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior8.jpg',
                'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
            ]
        ]
    ]" />

    <livewire:front.feature-slider-section :featureData="[
    'header' => [
        'title' => 'TECNOLOGIA: TABLET, HUD HOLOGRADICO Y MAS'
    ],
    'layout' => [
        'direction' => 'left'
    ],
    'slides' => [
                [
                    'id' => 'tecnologia-1',
                    'title' => 'MOTOR 2.0 TURBO',
                    'subtitle' => '2.0 Turbo Motor - 215 hp Potencia',
                    'description' => 'Diseño ultra moderno y vanguardista que destaca en todos los espacios urbanos, citadinos y en los viajes más largos.',
                    'main_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia1.jpg',
                    'thumbnail_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia1.jpg',
                    'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                ],
                [
                    'id' => 'tecnologia-2',
                    'title' => 'ESTABILIDAD CON PLATAFORMA CMA',
                    'subtitle' => '115 HP DE POTENCIA',
                    'description' => 'Diseño ultra moderno y vanguardista que destaca en todos los espacios urbanos, citadinos y en los viajes más largos.',
                    'main_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia2.jpg',
                    'thumbnail_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia2.jpg',
                    'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
                ],
                [
                    'id' => 'tecnologia-3',
                    'title' => 'TECNOLOGÍA AVANZADA',
                    'subtitle' => '115 HP DE POTENCIA',
                    'description' => 'Sistema de tracción inteligente que se adapta a cualquier terreno para máxima seguridad.',
                    'main_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia3.jpg',
                    'thumbnail_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia3.jpg',
                    'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
                ],
                [
                    'id' => 'tecnologia-4',
                    'title' => 'MOTOR 2.0 TURBO',
                    'subtitle' => '2.0 Turbo Motor - 215 hp Potencia',
                    'description' => 'Diseño ultra moderno y vanguardista que destaca en todos los espacios urbanos, citadinos y en los viajes más largos.',
                    'main_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia4.jpg',
                    'thumbnail_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia4.jpg',
                    'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                ],
                [
                    'id' => 'tecnologia-5',
                    'title' => 'ESTABILIDAD CON PLATAFORMA CMA',
                    'subtitle' => '115 HP DE POTENCIA',
                    'description' => 'Diseño ultra moderno y vanguardista que destaca en todos los espacios urbanos, citadinos y en los viajes más largos.',
                    'main_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia5.jpg',
                    'thumbnail_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia5.jpg',
                    'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
                ]

            ]
    ]" />

    <livewire:front.feature-slider-section :featureData="[
        'header' => [
            'title' => 'SEGURIDAD TOAL: MAS DE 8 ASISTENTES SMART'
        ],
        'layout' => [
            'direction' => 'right'
        ],
        'slides' => [
                [
                    'id' => 'seguridad-1',
                    'title' => 'MOTOR 2.0 TURBO',
                    'subtitle' => '2.0 Turbo Motor - 215 hp Potencia',
                    'description' => 'Diseño ultra moderno y vanguardista que destaca en todos los espacios urbanos, citadinos y en los viajes más largos.',
                    'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad1.jpg',
                    'thumbnail_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad1.jpg',
                    'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                ],
                [
                    'id' => 'seguridad-2',
                    'title' => 'ESTABILIDAD CON PLATAFORMA CMA',
                    'subtitle' => '115 HP DE POTENCIA',
                    'description' => 'Diseño ultra moderno y vanguardista que destaca en todos los espacios urbanos, citadinos y en los viajes más largos.',
                    'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad2.jpg',
                    'thumbnail_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad2.jpg',
                    'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
                ],
                [
                    'id' => 'seguridad-3',
                    'title' => 'TECNOLOGÍA AVANZADA',
                    'subtitle' => '115 HP DE POTENCIA',
                    'description' => 'Sistema de tracción inteligente que se adapta a cualquier terreno para máxima seguridad.',
                    'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad3.jpg',
                    'thumbnail_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad3.jpg',
                    'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
                ],
                [
                    'id' => 'seguridad-4',
                    'title' => 'MOTOR 2.0 TURBO',
                    'subtitle' => '2.0 Turbo Motor - 215 hp Potencia',
                    'description' => 'Diseño ultra moderno y vanguardista que destaca en todos los espacios urbanos, citadinos y en los viajes más largos.',
                    'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad4.jpg',
                    'thumbnail_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad4.jpg',
                    'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                ],
                [
                    'id' => 'seguridad-5',
                    'title' => 'ESTABILIDAD CON PLATAFORMA CMA',
                    'subtitle' => '115 HP DE POTENCIA',
                    'description' => 'Diseño ultra moderno y vanguardista que destaca en todos los espacios urbanos, citadinos y en los viajes más largos.',
                    'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad5.jpg',
                    'thumbnail_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad5.jpg',
                    'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
                ],
                [
                    'id' => 'seguridad-6',
                    'title' => 'ESTABILIDAD CON PLATAFORMA CMA',
                    'subtitle' => '115 HP DE POTENCIA',
                    'description' => 'Diseño ultra moderno y vanguardista que destaca en todos los espacios urbanos, citadinos y en los viajes más largos.',
                    'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad6.jpg',
                    'thumbnail_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad6.jpg',
                    'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
                ],
                [
                    'id' => 'seguridad-7',
                    'title' => 'TECNOLOGÍA AVANZADA',
                    'subtitle' => '115 HP DE POTENCIA',
                    'description' => 'Sistema de tracción inteligente que se adapta a cualquier terreno para máxima seguridad.',
                    'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad7.jpg',
                    'thumbnail_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad7.jpg',
                    'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
                ],
                [
                    'id' => 'seguridad-8',
                    'title' => 'MOTOR 2.0 TURBO',
                    'subtitle' => '2.0 Turbo Motor - 215 hp Potencia',
                    'description' => 'Diseño ultra moderno y vanguardista que destaca en todos los espacios urbanos, citadinos y en los viajes más largos.',
                    'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad8.jpg',
                    'thumbnail_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad8.jpg',
                    'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                ],
                [
                    'id' => 'seguridad-9',
                    'title' => 'ESTABILIDAD CON PLATAFORMA CMA',
                    'subtitle' => '115 HP DE POTENCIA',
                    'description' => 'Diseño ultra moderno y vanguardista que destaca en todos los espacios urbanos, citadinos y en los viajes más largos.',
                    'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad9.jpg',
                    'thumbnail_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad9.jpg',
                    'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
                ]

            ]
    ]" />

    <livewire:front.mosaic-gallery-section />

    {{-- Mosaico personalizado --}}
{{--    <livewire:front.mosaic-gallery-section :galleryData="[--}}
{{--        'layout' => [--}}
{{--            'columns' => 4,--}}
{{--            'gap' => 'gap-2',--}}
{{--            'container_height' => 'h-[700px]'--}}
{{--        ],--}}
{{--        'images' => [--}}
{{--            ['column' => 1, 'row_span' => 1, 'image' => 'frontend/images/mosaico/1.png', 'alt' => 'Image 1'],--}}
{{--            ['column' => 1, 'row_span' => 1, 'image' => 'frontend/images/mosaico/2.jpg', 'alt' => 'Image 2'],--}}
{{--            ['column' => 2, 'row_span' => 2, 'image' => 'frontend/images/mosaico/3.jpg', 'alt' => 'Image 3'],--}}
{{--            ['column' => 3, 'row_span' => 2, 'image' => 'frontend/images/mosaico/4.png', 'alt' => 'Image 4'],--}}
{{--            ['column' => 4, 'row_span' => 1, 'image' => 'frontend/images/mosaico/5.png', 'alt' => 'Image 5'],--}}
{{--            ['column' => 4, 'row_span' => 1, 'image' => 'frontend/images/mosaico/1.png', 'alt' => 'Image 6']--}}
{{--        ]--}}
{{--    ]" />--}}




    <livewire:front.about-section
        layout="split-left"
        :sectionData="[
                'logo' => 'frontend/images/logo-blanco.svg',
                'background_color' => '#000',
                'text_color' => '#fff'
            ]"
    />

    <livewire:front.test-drive-section
        layout="banner"
        :sectionData="[
        'show_image' => false
        ]"/>

    <livewire:front.postventa-section
        layout="overlay-left"
        :sectionData="[
                'subtitle' => 'SERVICIO',
                'title' => 'POSVENTA DE CALIDAD GLOBAL',
                'section_height' => 'min-h-[900px]'
            ]"
    />

    <livewire:front.direcciones-section
        layout="map-cards"
        :sectionData="[
                'background_color' => '#ffffff'
            ]" />
</div>
