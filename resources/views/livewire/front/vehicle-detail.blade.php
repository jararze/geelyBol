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

    ]" />

    <livewire:front.feature-slider-section :featureData="[
        'header' => [
            'title' => 'INTERIOR LUJOSO Y TOTALMENTE EQUIPADO'
        ],
        'layout' => [
            'direction' => 'right'
        ],
    ]" />

    <livewire:front.feature-slider-section :featureData="[
    'header' => [
        'title' => 'TECNOLOGIA: TABLET, HUD HOLOGRADICO Y MAS'
    ],
    'layout' => [
        'direction' => 'left'
    ],

    ]" />

    <livewire:front.feature-slider-section :featureData="[
        'header' => [
            'title' => 'SEGURIDAD TOAL: MAS DE 8 ASISTENTES SMART'
        ],
        'layout' => [
            'direction' => 'right'
        ],
    ]" />

    <livewire:front.mosaic-gallery-section />

    {{-- Mosaico personalizado --}}
    <livewire:front.mosaic-gallery-section :galleryData="[
        'layout' => [
            'columns' => 4,
            'gap' => 'gap-2',
            'container_height' => 'h-[700px]'
        ],
        'images' => [
            ['column' => 1, 'row_span' => 1, 'image' => 'frontend/images/mosaico/1.png', 'alt' => 'Image 1'],
            ['column' => 1, 'row_span' => 1, 'image' => 'frontend/images/mosaico/2.jpg', 'alt' => 'Image 2'],
            ['column' => 2, 'row_span' => 2, 'image' => 'frontend/images/mosaico/3.jpg', 'alt' => 'Image 3'],
            ['column' => 3, 'row_span' => 2, 'image' => 'frontend/images/mosaico/4.png', 'alt' => 'Image 4'],
            ['column' => 4, 'row_span' => 1, 'image' => 'frontend/images/mosaico/5.png', 'alt' => 'Image 5'],
            ['column' => 4, 'row_span' => 1, 'image' => 'frontend/images/mosaico/1.png', 'alt' => 'Image 6']
        ]
    ]" />




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
