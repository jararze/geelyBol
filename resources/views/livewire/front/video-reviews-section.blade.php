<div>
    <div x-data="{
    autoplay: {{ $videosData['autoplay']['enabled'] ? 'true' : 'false' }},
    delay: {{ $videosData['autoplay']['delay'] }},
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
         class="{{ $videosData['section_background'] }} {{ $videosData['section_padding'] }}">

        <div class="container mx-auto px-4">
            {{-- Header --}}
            <div class="text-left mb-12">
                <h2 class="{{ $videosData['header']['title_size'] }} font-bold {{ $videosData['header']['title_color'] }} mb-4">
                    {{ $videosData['header']['title'] }}
                </h2>
                <p class="{{ $videosData['header']['subtitle_size'] }} {{ $videosData['header']['subtitle_color'] }}">
                    {{ $videosData['header']['subtitle'] }}
                </p>
            </div>

            {{-- Video Container --}}
            {{-- Video Container --}}
            <div class="max-w-6xl mx-auto">
                @php $currentVideo = $this->getCurrentVideo(); @endphp

                <div class="relative {{ $videosData['section_background'] }} rounded-lg overflow-hidden">
                    {{-- Títulos FUERA del video - arriba --}}
                    <div class="p-6 text-right">
                        <h3 class="text-xxl font-bold bg-gradient-to-r from-blue-700 to-blue-300 bg-clip-text text-transparent mb-1">
                            {{ $currentVideo['subtitle'] ?? '' }}
                        </h3>
                        <p class="text-blue-400 font-xl">
                            {{ $currentVideo['channel'] ?? '' }}
                        </p>
                    </div>

                    {{-- Video Player --}}
                    <div class="relative aspect-video" x-data="{ playing: false }">
                        {{-- Thumbnail --}}
                        <div x-show="!playing" class="relative w-full h-full">
                            <img src="{{ asset($currentVideo['thumbnail'] ?? 'frontend/images/default-video.jpg') }}"
                                 alt="{{ $currentVideo['title'] ?? 'Video' }}"
                                 class="w-full h-full object-cover">

                            <div class="absolute inset-0 flex items-center justify-center">
                                <button @click="playing = true"
                                        class="bg-black bg-opacity-50 rounded-full p-4 hover:bg-opacity-70 transition-all transform hover:scale-110">
                                    <svg class="w-12 h-12 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </button>
                            </div>

                            <div class="absolute bottom-4 right-4 bg-black bg-opacity-75 text-white px-2 py-1 rounded text-sm">
                                {{ $currentVideo['duration'] ?? '00:00' }}
                            </div>
                        </div>

                        {{-- YouTube iframe con construcción dinámica --}}
                        <div x-show="playing" x-html="playing ? '<iframe src=&quot;https://www.youtube.com/embed/POBCHlhgO0Q&quot; class=&quot;w-full h-full&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share&quot; allowfullscreen referrerpolicy=&quot;strict-origin-when-cross-origin&quot;></iframe>' : ''">
                        </div>
                    </div>

                    {{-- Video Info abajo --}}

                </div>
            </div>

            {{-- Dots Navigation --}}
            <div class="{{ $videosData['navigation']['dots_container_class'] }}">
                <div class="{{ $videosData['navigation']['dots_wrapper_class'] }}">
                    @foreach($videosData['videos'] as $index => $video)
                        <button wire:click="goToSlide({{ $index }})"
                                class="transition-all duration-300 {{ $this->currentSlide === $index ? $videosData['navigation']['active_dot_style'] : $videosData['navigation']['dots_style'] }}">
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- Flash Messages --}}
            @if (session()->has('message'))
                <div class="mt-6 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded-lg">
                    {{ session('message') }}
                </div>
            @endif
        </div>
    </div>
</div>
