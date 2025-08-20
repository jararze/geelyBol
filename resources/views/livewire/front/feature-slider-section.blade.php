<div x-data="{
    autoplay: {{ $featureData['autoplay']['enabled'] ? 'true' : 'false' }},
    delay: {{ $featureData['autoplay']['delay'] }},
    interval: null,
    startAutoplay() {
        if (this.autoplay) {
            this.interval = setInterval(() => {
                $wire.call('nextSlide');
            }, this.delay);
        }
    },
    stopAutoplay() {
        if (this.interval) {
            clearInterval(this.interval);
            this.interval = null;
        }
    }
}"
     x-init="startAutoplay()"
     @mouseenter="stopAutoplay()"
     @mouseleave="startAutoplay()"
     class="{{ $featureData['section_background'] ?? 'bg-gray-100' }} {{ $featureData['section_padding'] ?? 'py-16' }}">

    <div class="container mx-auto px-4">
        {{-- Header --}}
        <div class="mb-12">
            <h2 class="{{ $featureData['header']['title_size'] ?? 'text-3xl lg:text-4xl' }} {{ $featureData['header']['title_weight'] ?? 'font-bold' }} {{ $featureData['header']['title_color'] ?? 'text-gray-900' }}">
                {{ $featureData['header']['title'] ?? '' }}
            </h2>
        </div>

        {{-- Carousel Container --}}
        <div class="relative">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-4 items-center">

                {{-- Imagen Anterior (lado izquierdo) --}}
                <div class="hidden lg:block">
                    @php
                        $prevIndex = ($this->currentSlide - 1 + count($featureData['slides'])) % count($featureData['slides']);
                        $prevSlide = $featureData['slides'][$prevIndex] ?? [];
                    @endphp
                    <div class="relative rounded-lg overflow-hidden opacity-60 transform scale-75 transition-all">
                        <div class="aspect-[4/3]">
                            <img src="{{ asset($prevSlide['main_image'] ?? 'frontend/images/default-feature.jpg') }}"
                                 alt="Previous"
                                 class="w-full h-full object-cover">

                            {{-- Título en overlay --}}
                            <div class="absolute bottom-0 left-0 right-0 bg-black/60 p-3">
                                <h4 class="text-white text-sm font-semibold text-center">
                                    {{ $prevSlide['subtitle'] ?? '' }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Imagen Principal (centro) --}}
                <div class="lg:col-span-3">
                    @php $currentSlide = $this->getCurrentSlide(); @endphp
                    <div class="relative rounded-2xl overflow-hidden">
                        <div class="aspect-video">
                            <img src="{{ asset($currentSlide['main_image'] ?? 'frontend/images/default-feature.jpg') }}"
                                 alt="{{ $currentSlide['title'] ?? 'Feature' }}"
                                 class="w-full h-full object-cover">

                            {{-- Overlay con información --}}
                            <div class="absolute inset-0 {{ $currentSlide['background_overlay'] ?? 'bg-gradient-to-r from-blue-600/80 to-transparent' }} flex flex-col justify-between">
                                {{-- Título principal arriba --}}
                                <div class="p-6">
                                    <div class="text-center text-black">
                                        <h3 class="text-4xl lg:text-5xl font-bold mb-2">
                                            {{ explode(' ', $currentSlide['subtitle'] ?? '')[0] ?? '' }}
                                            <span class="text-lg">{{ explode(' ', $currentSlide['subtitle'] ?? '')[1] ?? '' }}</span>
                                        </h3>
                                        <h3 class="text-4xl lg:text-5xl font-bold">
                                            {{ explode(' ', $currentSlide['subtitle'] ?? '')[2] ?? '' }}
                                            <span class="text-lg">{{ explode(' ', $currentSlide['subtitle'] ?? '')[3] ?? '' }}</span>
                                        </h3>
                                    </div>
                                </div>

                                {{-- Información abajo --}}
                                <div class="p-6">
                                    <div class="text-white">
                                        <h4 class="text-xl font-bold mb-2">
                                            {{ $currentSlide['title'] ?? '' }}
                                        </h4>
                                        <p class="text-sm opacity-90 max-w-md">
                                            {{ $currentSlide['description'] ?? '' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Imagen Siguiente (lado derecho) --}}
                <div class="hidden lg:block">
                    @php
                        $nextIndex = ($this->currentSlide + 1) % count($featureData['slides']);
                        $nextSlide = $featureData['slides'][$nextIndex] ?? [];
                    @endphp
                    <div class="relative rounded-lg overflow-hidden opacity-60 transform scale-75 transition-all">
                        <div class="aspect-[4/3]">
                            <img src="{{ asset($nextSlide['main_image'] ?? 'frontend/images/default-feature.jpg') }}"
                                 alt="Next"
                                 class="w-full h-full object-cover">

                            {{-- Título en overlay --}}
                            <div class="absolute bottom-0 left-0 right-0 bg-black/60 p-3">
                                <h4 class="text-white text-sm font-semibold text-center">
                                    {{ $nextSlide['subtitle'] ?? '' }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Navigation Arrows --}}
            <button wire:click="prevSlide"
                    class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white rounded-full p-3 shadow-lg transition-all">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>

            <button wire:click="nextSlide"
                    class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white rounded-full p-3 shadow-lg transition-all">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>

        {{-- Dots Navigation --}}
        @if($featureData['navigation']['dots_enabled'] ?? true)
            <div class="{{ $featureData['navigation']['dots_container_class'] ?? 'flex justify-center mt-8 space-x-2' }}">
                @foreach(($featureData['slides'] ?? []) as $index => $slide)
                    <button wire:click="goToSlide({{ $index }})"
                            class="transition-all duration-300 {{ $this->currentSlide === $index ? ($featureData['navigation']['active_dot_style'] ?? 'w-8 h-3 bg-blue-600 rounded-full') : ($featureData['navigation']['dots_style'] ?? 'w-3 h-3 bg-gray-400 rounded-full') }}">
                    </button>
                @endforeach
            </div>
        @endif
    </div>
</div>
