<div>
    {{-- Hero del Vehículo --}}
    <livewire:front.vehicle-hero layout="top-left" :vehicle="$vehicle"  />

    <livewire:front.vehicle-sub-navigation :vehicle="$vehicle" />

    <section id="{!! $vehicle['slug'] !!}" data-section="{!! $vehicle['slug'] !!}">
        <livewire:front.vehicle-features :vehicle="$vehicle" />
    </section>

    <section id="versiones" data-section="versiones">
        <livewire:front.vehicle-versions
            :vehicle="$vehicle"
            :category="$categorySlug"
            :slug="$vehicleSlug"
        />
    </section>

    {{-- Action Boxes --}}
    <section id="servicios">
        <livewire:front.action-boxes-section/>
    </section>


    <section id="slider">
        <livewire:front.promotions-slider-section :vehicle="$vehicle" />
    </section>

    <section id="beneficios">
        <livewire:front.BenefitsSection/>
    </section>

    <livewire:front.video-reviews-section :vehicle="$vehicle" />

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
    ]"/>

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
                    'title' => 'Motor 2.0 Turbo',
                    'subtitle' => '218 hp Potencia',
                    'description' => 'Motor 2.0 Turbo con 218 hp que te brinda respuesta rápida en ciudad y potencia constante en carretera. El poder que necesitas, cuando lo necesites.',
                    'main_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente0.jpg',
                    'thumbnail_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente0.jpg',
                    'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                ],
                [
                    'id' => 'estabilidad-cma',
                    'title' => 'Estabilidad y Seguridad',
                    'subtitle' => 'PLATAFORMA CMA',
                    'description' => 'Una arquitectura modular e inteligente que garantiza agilidad, potencia y la máxima seguridad cada vez que conduzcas.',
                    'main_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente1.jpg',
                    'thumbnail_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente1.jpg',
                    'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
                ],
                [
                    'id' => 'tecnologia-avanzada',
                    'title' => 'POTENTE Y DINAMICO',
                    'subtitle' => 'Máxima Fluidez / Transmisión DCT de 7 Velocidades',
                    'description' => 'Te ofrece el arranque perfecto para cada situación, asegurando una respuesta inmediata al acelerador y una conducción excepcionalmente fluida.',
                    'main_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente2.jpg',
                    'thumbnail_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente2.jpg',
                    'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
                ],
                [
                    'id' => 'motor-turbo1',
                    'title' => 'Máxima Fluidez',
                    'subtitle' => 'Transmisión DCT de 7 Velocidades',
                    'description' => 'Te ofrece el arranque perfecto para cada situación, asegurando una respuesta inmediata al acelerador y una conducción excepcionalmente fluida.',
                    'main_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente02.jpg',
                    'thumbnail_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente02.jpg',
                    'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                ],
                [
                    'id' => 'estabilidad-cma1',
                    'title' => 'Frenado ',
                    'subtitle' => 'de 100KM a 0Km',
                    'description' => 'El verdadero poder no solo es acelerar, sino saber detenerse. Starray redefine la seguridad en la categoría con una distancia de frenado líder en su clase desde 100 km/h.',
                    'main_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente3.jpg',
                    'thumbnail_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente3.jpg',
                    'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
                ],
                [
                    'id' => 'tecnologia-avanzada1',
                    'title' => 'Conducción',
                    'subtitle' => '3 Modos de Conducción',
                    'description' => 'Con los modos de conducción seleccionables, transforma tu Starray al instante para adaptarla a tus preferencias. Elige entre una conducción orientada a la eficiencia con el modo Eco, una que privilegia el Comfort, o una que maximiza la respuesta para una experiencia más dinámica con el modo Sport. ',
                    'main_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente4.jpg',
                    'thumbnail_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente4.jpg',
                    'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
                ],
                [
                    'id' => 'tecnologia-avanzada2',
                    'title' => 'Prueba del Alce',
                    'subtitle' => 'Prueba del Alce',
                    'description' => 'Con el rendimiento líder en la Prueba del Alce, Starray demuestra estabilidad en situaciones de emergencia y control excepcional para maniobras rápidas y seguras.',
                    'main_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente5.jpg',
                    'thumbnail_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente5.jpg',
                    'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
                ]
            ]

        ]"/>

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
                    'title' => 'Sistema de Sonido',
                    'subtitle' => 'Infinity by Harman',
                    'description' => '9 parlantes diseñados para envolverte en un sonido multidimensional y de alta calidad.',
                    'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior10.jpg',
                    'thumbnail_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior10.jpg',
                    'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                ],
                [
                    'id' => 'interno-2',
                    'title' => 'Techo Panorámico',
                    'subtitle' => 'Más Grande de su Clase',
                    'description' => 'El lujo es espacio y luminosidad. El techo panorámico de Starray llena la cabina de luz natural, creando una sensación de apertura sin límites.',
                    'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior1.jpg',
                    'thumbnail_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior1.jpg',
                    'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
                ],
                [
                    'id' => 'interno-3',
                    'title' => 'Espacios de Almacenamiento',
                    'subtitle' => '',
                    'description' => 'Con 32 espacios de almacenamiento inteligentemente ubicados en toda la cabina, Starray está diseñada para adaptarse a todas tus necesidades de espacio y confort.',
                    'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior2.jpg',
                    'thumbnail_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior2.jpg',
                    'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
                ],
                [
                    'id' => 'interno-4',
                    'title' => 'Diseño y Comodidad',
                    'subtitle' => '',
                    'description' => 'Relájate en asientos de ecocuero de alta calidad, que combinan una estética moderna con un soporte superior, ajuste eléctrico y función de memoria. ',
                    'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior9.jpg',
                    'thumbnail_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior9.jpg',
                    'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                ],
                [
                    'id' => 'interno-5',
                    'title' => 'Diseño Interior Bi-tono',
                    'subtitle' => '',
                    'description' => 'El lujo es visual y sensorial. El diseño interior bi-tono de la Starray eleva la cabina a un nuevo nivel de sofisticación, modernidad y elegancia.',
                    'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior3.jpg',
                    'thumbnail_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior3.jpg',
                    'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
                ],
                [
                    'id' => 'interno-6',
                    'title' => '',
                    'subtitle' => '',
                    'description' => '',
                    'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior4.jpg',
                    'thumbnail_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior4.jpg',
                    'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
                ],
                [
                    'id' => 'interno-7',
                    'title' => '',
                    'subtitle' => '',
                    'description' => '',
                    'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior5.jpg',
                    'thumbnail_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior5.jpg',
                    'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
                ],
                [
                    'id' => 'interno-8',
                    'title' => '',
                    'subtitle' => '',
                    'description' => '',
                    'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior6.jpg',
                    'thumbnail_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior6.jpg',
                    'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
                ],
                [
                    'id' => 'interno-9',
                    'title' => '',
                    'subtitle' => '',
                    'description' => '',
                    'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior7.jpg',
                    'thumbnail_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior7.jpg',
                    'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
                ],
                [
                    'id' => 'interno-10',
                    'title' => '',
                    'subtitle' => '',
                    'description' => '',
                    'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior8.jpg',
                    'thumbnail_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior8.jpg',
                    'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
                ]
            ]
        ]"/>

    <livewire:front.feature-slider-section :featureData="[
        'header' => [
            'title' => 'TECNOLOGÍA: TABLET, HUD HOLOGRÁFICO Y MÁS'
        ],
        'layout' => [
            'direction' => 'left'
        ],
        'slides' => [
                    [
                        'id' => 'tecnologia-1',
                        'title' => 'Pantalla 13.2” HD',
                        'subtitle' => '',
                        'description' => 'Experimenta la pantalla de Starray con una visualización nítida y una interfaz intuitiva, diseñada para una interacción fluida y sin distracciones.',
                        'main_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia1.jpg',
                        'thumbnail_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia1.jpg',
                        'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                    ],
                    [
                        'id' => 'tecnologia-2',
                        'title' => 'HUD Holográfico de 25.2',
                        'subtitle' => '',
                        'description' => 'El copiloto que te permite mantener la mirada en el camino, proyectando información vital como la velocidad y las indicaciones de navegación directamente en tu campo de visión. ',
                        'main_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia2.jpg',
                        'thumbnail_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia2.jpg',
                        'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
                    ],
                    [
                        'id' => 'tecnologia-3',
                        'title' => 'Visores de Sol con Lentes Integradas',
                        'subtitle' => '',
                        'description' => 'El lujo está en los pequeños detalles: los visores de sol de Starray, únicos en el mundo, reducen el resplandor y mejora la visibilidad en días soleados.',
                        'main_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia3.jpg',
                        'thumbnail_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia3.jpg',
                        'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
                    ],
                    [
                        'id' => 'tecnologia-4',
                        'title' => '',
                        'subtitle' => '',
                        'description' => '',
                        'main_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia4.jpg',
                        'thumbnail_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia4.jpg',
                        'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                    ],
                    [
                        'id' => 'tecnologia-5',
                        'title' => '',
                        'subtitle' => '',
                        'description' => '',
                        'main_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia5.jpg',
                        'thumbnail_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia5.jpg',
                        'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
                    ]

                ]
        ]"/>

    <livewire:front.feature-slider-section :featureData="[
            'header' => [
                'title' => 'SEGURIDAD TOTAL: MÁS DE 8 ASISTENTES SMART'
            ],
            'layout' => [
                'direction' => 'right'
            ],
            'slides' => [
                    [
                        'id' => 'seguridad-1',
                        'title' => 'Sistema ADAS',
                        'subtitle' => '',
                        'description' => 'Desde mantenerte en tu carril hasta alertarte sobre una posible colisión, el sistema completo de ADAS trabaja en conjunto para prevenir accidentes y hacer cada viaje más seguro.',
                        'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad1.jpg',
                        'thumbnail_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad1.jpg',
                        'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                    ],
                    [
                        'id' => 'seguridad-2',
                        'title' => 'Visión de Starray de 540°',
                        'subtitle' => '',
                        'description' => 'Elimina todos los puntos ciegos con la visión panorámica de 540°, para una precisión milimétrica en estacionamientos y maniobras.',
                        'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad2.jpg',
                        'thumbnail_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad2.jpg',
                        'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
                    ],
                    [
                        'id' => 'seguridad-3',
                        'title' => 'Control Crucero Adaptativo',
                        'subtitle' => '',
                        'description' => 'Es un asistente inteligente que se encarga de mantener automáticamente una distancia segura con el vehículo de adelante, frenando y acelerando por ti.',
                        'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad3.jpg',
                        'thumbnail_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad3.jpg',
                        'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
                    ],
                    [
                        'id' => 'seguridad-4',
                        'title' => '',
                        'subtitle' => '',
                        'description' => '',
                        'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad4.jpg',
                        'thumbnail_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad4.jpg',
                        'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                    ],
                    [
                        'id' => 'seguridad-5',
                        'title' => '',
                        'subtitle' => '',
                        'description' => '',
                        'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad5.jpg',
                        'thumbnail_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad5.jpg',
                        'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
                    ],
                    [
                        'id' => 'seguridad-6',
                        'title' => '',
                        'subtitle' => '',
                        'description' => '',
                        'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad6.jpg',
                        'thumbnail_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad6.jpg',
                        'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
                    ],
                    [
                        'id' => 'seguridad-7',
                        'title' => '',
                        'subtitle' => '',
                        'description' => '',
                        'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad7.jpg',
                        'thumbnail_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad7.jpg',
                        'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
                    ],
                    [
                        'id' => 'seguridad-8',
                        'title' => '',
                        'subtitle' => '',
                        'description' => '',
                        'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad8.jpg',
                        'thumbnail_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad8.jpg',
                        'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'
                    ],
                    [
                        'id' => 'seguridad-9',
                        'title' => '',
                        'subtitle' => '',
                        'description' => '',
                        'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad9.jpg',
                        'thumbnail_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad9.jpg',
                        'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
                    ]

                ]
        ]"/>

    <livewire:front.mosaic-gallery-section/>


    <livewire:front.about-section
        :sectionData="[
                'logo' => 'frontend/images/logo-blanco.svg',
                'background_color' => '#000',
                'text_color' => '#fff'
            ]"
    />

    <livewire:front.test-drive-section
        layout="overlay-left"
        :sectionData="[
                'section_height' => 'min-h-[600px]',
                'show_image' => true,
                'background_image' => 'frontend/images/7080348 1.png'
        ]"/>

    <livewire:front.postventa-section
        layout="split-right"
        :sectionData="[
                'section_height' => 'min-h-[600px]'
            ]"
    />

    <livewire:front.direcciones-section
        layout="map-cards"
        :sectionData="[
                'background_color' => '#ffffff'
            ]"/>
</div>
