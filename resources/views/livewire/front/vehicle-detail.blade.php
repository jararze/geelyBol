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

    <livewire:front.section-breaker-section :vehicle="$vehicle" />

    <livewire:front.feature-slider-section
        :vehicle="$vehicle"
        section="potente_dinamico"
    />

    <livewire:front.feature-slider-section
        :vehicle="$vehicle"
        section="interior_lujoso"
    />

    <livewire:front.feature-slider-section
        :vehicle="$vehicle"
        section="tecnologia"
    />

    <livewire:front.feature-slider-section
        :vehicle="$vehicle"
        section="seguridad"
    />

    <livewire:front.mosaic-gallery-section :vehicle="$vehicle"  />


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
