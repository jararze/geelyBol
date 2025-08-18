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
        'title' => 'TECNOLOGÍA AVANZADA'
    ],
    'layout' => [
        'direction' => 'right'
    ],
    'slides' => [
        [
            'title' => 'CONECTIVIDAD TOTAL',
            'subtitle' => 'Sistema multimedia avanzado',
            'description' => 'Pantalla táctil de última generación con conectividad completa.',
            'main_image' => 'frontend/images/interior-tech.jpg'
        ]
    ]
]" />

    <livewire:front.feature-slider-section :featureData="[
    'header' => [
        'title' => 'TECNOLOGÍA AVANZADA'
    ],
    'layout' => [
        'direction' => 'left'
    ],
    'slides' => [
        [
            'title' => 'CONECTIVIDAD TOTAL',
            'subtitle' => 'Sistema multimedia avanzado',
            'description' => 'Pantalla táctil de última generación con conectividad completa.',
            'main_image' => 'frontend/images/interior-tech.jpg'
        ]
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
