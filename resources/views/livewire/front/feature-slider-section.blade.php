<section class="{{ $featureData['section_background'] }} {{ $featureData['section_padding'] }}">
    <div class="container mx-auto px-4">
        <!-- Header -->
        @if(!empty($featureData['header']['title']))
            <div class="mb-8">
                <h2 class="{{ $featureData['header']['title_size'] }} {{ $featureData['header']['title_weight'] }} {{ $featureData['header']['title_color'] }}">
                    {{ $featureData['header']['title'] }}
                </h2>
            </div>
        @endif

        @php $currentSlideData = $featureData['slides'][$currentSlide] ?? $featureData['slides'][0]; @endphp

        <div class="relative overflow-hidden">
            @if($featureData['layout']['direction'] === 'left')
                <div class="flex items-start gap-6">
                    <!-- Imagen Principal - NUNCA cambia con fade -->
                    <div class="w-2/3">
                        <div class="relative h-[400px] rounded-2xl overflow-hidden bg-gray-200">
                            <img src="{{ asset($currentSlideData['main_image']) }}"
                                 class="w-full h-full object-cover">

                            <div class="absolute inset-0 ">
                                <div class="absolute bottom-6 left-6 text-white">
                                    <h3 class="text-2xl font-bold mb-2">{{ $currentSlideData['title'] }}</h3>
                                    <p class="text-lg opacity-90">{{ $currentSlideData['subtitle'] }}</p>
                                    <p class="text-sm opacity-80 mt-1">{{ $currentSlideData['description'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Thumbnails - se cortan en la derecha -->
                    <div class="w-1/3 flex gap-3 pr-0" style="margin-right: -100px;">
                        @foreach($featureData['slides'] as $index => $slide)
                            <div wire:click="goToSlide({{ $index }})"
                                 class="flex-shrink-0 cursor-pointer transition-transform duration-200 {{ $currentSlide === $index ? 'scale-105 ring-2 ring-blue-500' : 'hover:scale-102' }}"
                                 style="width: 200px;">

                                <div class="relative h-32 rounded-xl overflow-hidden">
                                    <img src="{{ asset($featureData['thumbnails'][$index]['image']) }}"
                                         class="w-full h-full object-cover">

                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent">
                                        <div class="absolute bottom-2 left-3 text-white">
                                            <p class="text-xs font-semibold">{{ $featureData['thumbnails'][$index]['title'] }}</p>
                                        </div>
                                    </div>
                                </div>

                                @if($index === 0)
                                    <div class="mt-3 px-1">
                                        <h4 class="font-bold text-sm text-gray-900 leading-tight mb-1">
                                            ESTABILIDAD CON<br>PLATAFORMA CMA
                                        </h4>
                                        <p class="text-xs text-gray-600 leading-relaxed">
                                            Diseño ultra moderno y vanguardista que destaca en todos los espacios urbanos, citadinos y en los viajes más largos.
                                        </p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

            @else
                <!-- Layout Derecha -->
                <div class="flex items-start gap-6">
                    <!-- Thumbnails - se cortan en la izquierda -->
                    <div class="w-1/3 flex gap-3 pl-0" style="margin-left: -100px;">
                        @foreach($featureData['slides'] as $index => $slide)
                            <div wire:click="goToSlide({{ $index }})"
                                 class="flex-shrink-0 cursor-pointer transition-transform duration-200 {{ $currentSlide === $index ? 'scale-105 ring-2 ring-blue-500' : 'hover:scale-102' }}"
                                 style="width: 200px;">

                                <div class="relative h-32 rounded-xl overflow-hidden">
                                    <img src="{{ asset($featureData['thumbnails'][$index]['image']) }}"
                                         class="w-full h-full object-cover">

                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent">
                                        <div class="absolute bottom-2 right-3 text-white text-right">
                                            <p class="text-xs font-semibold">{{ $featureData['thumbnails'][$index]['title'] }}</p>
                                        </div>
                                    </div>
                                </div>

                                @if($index === 0)
                                    <div class="mt-3 px-1 text-right">
                                        <h4 class="font-bold text-sm text-gray-900 leading-tight mb-1">
                                            ESTABILIDAD CON<br>PLATAFORMA CMA
                                        </h4>
                                        <p class="text-xs text-gray-600 leading-relaxed">
                                            Diseño ultra moderno y vanguardista que destaca en todos los espacios urbanos.
                                        </p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Imagen Principal -->
                    <div class="w-2/3">
                        <div class="relative h-[400px] rounded-2xl overflow-hidden bg-gray-200">
                            <img src="{{ asset($currentSlideData['main_image']) }}"
                                 class="w-full h-full object-cover">

                            <div class="absolute inset-0 {{ $currentSlideData['background_overlay'] ?? 'bg-gradient-to-r from-blue-600/80 to-transparent' }}">
                                <div class="absolute bottom-6 right-6 text-white text-right">
                                    <h3 class="text-2xl font-bold mb-2">{{ $currentSlideData['title'] }}</h3>
                                    <p class="text-lg opacity-90">{{ $currentSlideData['subtitle'] }}</p>
                                    <p class="text-sm opacity-80 mt-1">{{ $currentSlideData['description'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Dots -->
        @if($featureData['navigation']['dots_enabled'])
            <div class="{{ $featureData['navigation']['dots_container_class'] }}">
                @foreach($featureData['slides'] as $index => $slide)
                    <button wire:click="goToSlide({{ $index }})"
                            class="transition-all duration-200 {{ $currentSlide === $index ? $featureData['navigation']['active_dot_style'] : $featureData['navigation']['dots_style'] }}">
                    </button>
                @endforeach
            </div>
        @endif
    </div>
</section>
