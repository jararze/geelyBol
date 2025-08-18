<div>
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

            {{-- Content Grid --}}
            @php $currentSlide = $this->getCurrentSlide(); @endphp

            @if(($featureData['layout']['direction'] ?? 'left') === 'left')
                {{-- Layout: Imagen Principal a la Izquierda --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-center">
                    {{-- Imagen Principal --}}
                    <div class="{{ $featureData['layout']['main_image_size'] ?? 'lg:col-span-2' }}">
                        <div class="relative rounded-2xl overflow-hidden aspect-video">
                            <img src="{{ asset($currentSlide['main_image'] ?? 'frontend/images/default-feature.jpg') }}"
                                 alt="{{ $currentSlide['title'] ?? 'Feature' }}"
                                 class="w-full h-full object-cover">

                            {{-- Overlay con información --}}
                            <div class="absolute inset-0 {{ $currentSlide['background_overlay'] ?? 'bg-gradient-to-r from-blue-600/80 to-transparent' }} flex items-end">
                                <div class="p-8 text-white">
                                    <h3 class="text-2xl lg:text-3xl font-bold mb-2">
                                        {{ $currentSlide['title'] ?? '' }}
                                    </h3>
                                    <p class="text-lg mb-4">
                                        {{ $currentSlide['subtitle'] ?? '' }}
                                    </p>
                                    <p class="text-sm opacity-90 max-w-md">
                                        {{ $currentSlide['description'] ?? '' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Thumbnails --}}
                    <div class="{{ $featureData['layout']['content_size'] ?? 'lg:col-span-1' }}">
                        <div class="space-y-4">
                            @foreach(($featureData['thumbnails'] ?? []) as $index => $thumbnail)
                                <div wire:click="goToSlide({{ $index }})"
                                     class="relative rounded-lg overflow-hidden cursor-pointer transition-all duration-300 {{ $currentSlide === $index ? 'ring-4 ring-blue-500 scale-105' : 'hover:scale-102' }}">
                                    <div class="aspect-video {{ $currentSlide === $index ? '' : 'opacity-70' }}">
                                        <img src="{{ asset($thumbnail['image'] ?? 'frontend/images/default-thumb.jpg') }}"
                                             alt="{{ $thumbnail['title'] ?? 'Thumbnail' }}"
                                             class="w-full h-full object-cover">

                                        {{-- Thumbnail overlay --}}
                                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                                            <h4 class="text-white text-sm font-semibold text-center px-2">
                                                {{ $thumbnail['title'] ?? '' }}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                {{-- Layout: Imagen Principal a la Derecha --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-center">
                    {{-- Thumbnails --}}
                    <div class="{{ $featureData['layout']['content_size'] ?? 'lg:col-span-1' }}">
                        <div class="space-y-4">
                            @foreach(($featureData['thumbnails'] ?? []) as $index => $thumbnail)
                                <div wire:click="goToSlide({{ $index }})"
                                     class="relative rounded-lg overflow-hidden cursor-pointer transition-all duration-300 {{ $currentSlide === $index ? 'ring-4 ring-blue-500 scale-105' : 'hover:scale-102' }}">
                                    <div class="aspect-video {{ $currentSlide === $index ? '' : 'opacity-70' }}">
                                        <img src="{{ asset($thumbnail['image'] ?? 'frontend/images/default-thumb.jpg') }}"
                                             alt="{{ $thumbnail['title'] ?? 'Thumbnail' }}"
                                             class="w-full h-full object-cover">

                                        {{-- Thumbnail overlay --}}
                                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                                            <h4 class="text-white text-sm font-semibold text-center px-2">
                                                {{ $thumbnail['title'] ?? '' }}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Imagen Principal --}}
                    <div class="{{ $featureData['layout']['main_image_size'] ?? 'lg:col-span-2' }}">
                        <div class="relative rounded-2xl overflow-hidden aspect-video">
                            <img src="{{ asset($currentSlide['main_image'] ?? 'frontend/images/default-feature.jpg') }}"
                                 alt="{{ $currentSlide['title'] ?? 'Feature' }}"
                                 class="w-full h-full object-cover">

                            {{-- Overlay con información --}}
                            <div class="absolute inset-0 {{ $currentSlide['background_overlay'] ?? 'bg-gradient-to-r from-blue-600/80 to-transparent' }} flex items-end">
                                <div class="p-8 text-white">
                                    <h3 class="text-2xl lg:text-3xl font-bold mb-2">
                                        {{ $currentSlide['title'] ?? '' }}
                                    </h3>
                                    <p class="text-lg mb-4">
                                        {{ $currentSlide['subtitle'] ?? '' }}
                                    </p>
                                    <p class="text-sm opacity-90 max-w-md">
                                        {{ $currentSlide['description'] ?? '' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

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
</div>
