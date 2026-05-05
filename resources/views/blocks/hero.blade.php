@php
    $bg = \App\Filament\Helpers\ImageHelper::resolveUrl($data['background'] ?? null);
    $vehicleDesktop = \App\Filament\Helpers\ImageHelper::resolveUrl($vehicle->image ?? null);
    $vehicleMobile = \App\Filament\Helpers\ImageHelper::resolveUrl($vehicle->image_mobile ?? null) ?: $vehicleDesktop;
    $title = $data['title'] ?? $vehicle->name;
@endphp

<section id="hero" class="relative w-full overflow-hidden bg-black text-white">
    @if ($bg)
        <div class="absolute inset-0">
            <img src="{{ $bg }}" alt="{{ $title }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/40 to-transparent"></div>
        </div>
    @else
        <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-black to-gray-800"></div>
    @endif

    <div class="relative z-10 max-w-7xl mx-auto px-4 py-16 md:py-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">

            <div class="text-center lg:text-left">
                <div class="mb-6 flex justify-center lg:justify-start">
                    <span class="text-2xl md:text-3xl font-bold tracking-[0.3em] text-white/90">GEELY</span>
                </div>

                <h1 class="text-5xl md:text-7xl font-bold uppercase tracking-tight drop-shadow-lg mb-4">
                    {{ $title }}
                </h1>

                @if (!empty($data['subtitle']))
                    <p class="text-base md:text-xl uppercase tracking-widest text-white/80 mb-6">
                        {{ $data['subtitle'] }}
                    </p>
                @endif

                @if (!empty($data['description']))
                    <p class="text-base md:text-lg text-white/90 max-w-xl mb-8 mx-auto lg:mx-0">
                        {{ $data['description'] }}
                    </p>
                @endif

                @if (!empty($data['cta_text']) && !empty($data['cta_link']))
                    <a href="{{ $data['cta_link'] }}"
                       class="inline-block bg-white text-black px-8 py-3 rounded-lg font-medium hover:bg-gray-100 transition uppercase tracking-wide">
                        {{ $data['cta_text'] }}
                    </a>
                @endif
            </div>

            <div class="flex justify-center lg:justify-end items-end">
                @if ($vehicleDesktop)
                    <picture>
                        @if ($vehicleMobile && $vehicleMobile !== $vehicleDesktop)
                            <source media="(max-width: 768px)" srcset="{{ $vehicleMobile }}">
                        @endif
                        <img src="{{ $vehicleDesktop }}"
                             alt="{{ $title }}"
                             class="w-full max-w-2xl h-auto object-contain drop-shadow-2xl">
                    </picture>
                @endif
            </div>

        </div>
    </div>
</section>
