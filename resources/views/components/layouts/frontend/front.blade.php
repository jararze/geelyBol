<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.front.head')

</head>
<body class="min-h-screen bg-white">

<livewire:front.navigation/>

<livewire:front.hero-section/>

<livewire:front.model-section/>

<livewire:front.action-boxes-section/>

<livewire:front.BenefitsSection/>

<livewire:front.about-section
    :sectionData="[
                    'logo' => 'frontend/images/logo-blanco.svg',
                    'background_color' => '#000',
                    'text_color' => '#fff'
                ]"
/>

{{-- Layout con texto a la izquierda e imagen a la derecha --}}
<livewire:front.about-section
    layout="split-left"
    :sectionData="[
                    'logo' => 'frontend/images/logo-blanco.svg',
                    'background_color' => '#000',
                    'text_color' => '#fff'
                ]"
/>

{{-- Layout con imagen a la izquierda y texto a la derecha --}}
<livewire:front.about-section layout="split-right"
                              :sectionData="[
                    'logo' => 'frontend/images/logo-blanco.svg',
                    'background_color' => '#000',
                    'text_color' => '#fff'
                ]"
/>

<livewire:front.about-section layout="compact-right"
                              :sectionData="[
                    'logo' => 'frontend/images/logo-negro.svg',
                    'background_color' => '#fff',
                    'text_color' => '#000'
                ]"
/>

<livewire:front.about-section layout="compact-left"
                              :sectionData="[
                    'logo' => 'frontend/images/logo-negro.svg',
                    'background_color' => '#fff',
                    'text_color' => '#000'
                ]"
/>


{{-- Imagen ocupa 1/3 del espacio --}}
<livewire:front.test-drive-section
    layout="hero"
    :sectionData="[
        'image_position' => 'top-third',
        'show_features' => true
    ]"/>


{{-- Con imagen--}}
<livewire:front.test-drive-section
    layout="overlay-left"
    :sectionData="[
        'section_height' => 'min-h-[600px]',
        'show_image' => true,
        'background_image' => 'frontend/images/7080348 1.png'
    ]"/>


{{-- Banner sin imagen --}}
<livewire:front.test-drive-section
    layout="banner"
    :sectionData="[
        'show_image' => false
    ]"
/>

{{-- Banner delgado --}}
<livewire:front.test-drive-section layout="banner-thin"/>



{{-- Layout 1: Split derecha --}}
<livewire:front.postventa-section
    layout="split-right"
    :sectionData="[
        'section_height' => 'min-h-[600px]'
    ]"
/>

{{-- Layout 2: Compacto --}}
<livewire:front.postventa-section
    layout="compact"
    :sectionData="[
        'section_height' => 'min-h-[600px]'
    ]"
/>

{{-- Layout 3: Overlay con subtítulo --}}
<livewire:front.postventa-section
    layout="overlay-left"
    :sectionData="[
        'subtitle' => 'SERVICIO',
        'title' => 'POSVENTA DE CALIDAD GLOBAL',
        'section_height' => 'min-h-[900px]'
    ]" />

{{-- Layout con mapa (fondo blanco) --}}
<livewire:front.direcciones-section
    layout="map-cards"
    :sectionData="[
        'background_color' => '#ffffff'
    ]" />




<main>
    {{ $slot }}
</main>

<livewire:front.footer/>
@livewireScripts
@stack('scripts')
</body>
</html>
