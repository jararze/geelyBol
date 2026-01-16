<!-- resources/views/livewire/hero-section.blade.php -->
{{--<section class="relative min-h-[65vh] sm:min-h-[75vh] md:min-h-[80vh] lg:min-h-[85vh] xl:min-h-[90vh] overflow-hidden"--}}
<section class="relative overflow-hidden bg-black lg:!h-[calc(100vh-80px)] lg:!h-[calc(100svh-80px)]"
         style="height: calc(100vh - 64px); height: calc(100svh - 64px);"
         x-data="{
                currentSlide: @entangle('currentSlide'),
                totalSlides: {{ count($heroConfig['slides']) }},
                autoplay: {{ $heroConfig['autoplay'] ? 'true' : 'false' }},
                interval: null,
                currentVideo: null,
                videoProgress: @entangle('videoProgress'),

                startAutoplay() {
                    if (this.autoplay && this.getCurrentSlideType() === 'image') {
                        this.interval = setInterval(() => {
                            $wire.nextSlide();
                        }, {{ $heroConfig['autoplay_interval'] }});
                    }
                },

                stopAutoplay() {
                    if (this.interval) {
                        clearInterval(this.interval);
                        this.interval = null;
                    }
                },

                getCurrentSlideType() {
                    const slides = @js($heroConfig['slides']);
                    return slides[this.currentSlide]?.media_type || 'image';
                },

                optimizeVideoLoading() {
                    // Optimizar carga de videos adyacentes
                    const videos = this.$el.querySelectorAll('video');
                    videos.forEach((video, index) => {
                        if (index === this.currentSlide) {
                            // Video actual: carga completa
                            video.preload = 'auto';
                            if (!video.src && video.querySelector('source')) {
                                video.load();
                            }
                        } else if (Math.abs(index - this.currentSlide) === 1 ||
                                  (this.currentSlide === 0 && index === this.totalSlides - 1) ||
                                  (this.currentSlide === this.totalSlides - 1 && index === 0)) {
                            // Videos adyacentes: solo metadata
                            video.preload = 'metadata';
                        } else {
                            // Videos lejanos: no cargar
                            video.preload = 'none';
                        }
                    });
                },

                handleSlideChange() {
                    this.stopAutoplay();
                    this.optimizeVideoLoading();

                    if (this.getCurrentSlideType() === 'image') {
                        setTimeout(() => this.startAutoplay(), 100);
                    }

                    if (this.getCurrentSlideType() === 'video') {
                        this.$nextTick(() => {
                            this.setupVideoEvents();
                        });
                    }
                },

                setupVideoEvents() {
                    const video = this.$el.querySelector('.current-video');
                    if (video) {
                        this.currentVideo = video;

                        // Solo configurar eventos si no están ya configurados
                        if (!video.hasAttribute('data-events-setup')) {
                            video.setAttribute('data-events-setup', 'true');

                            video.addEventListener('loadedmetadata', () => {
                                $wire.updateVideoProgress(0, video.duration);
                            });

                            video.addEventListener('timeupdate', () => {
                                $wire.updateVideoProgress(video.currentTime, video.duration);
                            });

                            video.addEventListener('ended', () => {
                                $wire.videoEnded();
                            });

                            video.addEventListener('error', (e) => {
                                console.warn('Video loading error, skipping to next slide');
                                setTimeout(() => $wire.nextSlide(), 1000);
                            });
                        }

                        // Intentar reproducir si está pausado
                        if (video.paused && video.readyState >= 3) {
                            video.play().catch(console.warn);
                        }
                    }
                }
            }"
         x-init="
                handleSlideChange();
                $watch('currentSlide', () => handleSlideChange());
            "
         @mouseenter="stopAutoplay(); if(currentVideo) currentVideo.pause()"
         @mouseleave="startAutoplay(); if(currentVideo && !$wire.isPaused) currentVideo.play()"
>
    {{-- Slides Container --}}
    @foreach($heroConfig['slides'] as $index => $slide)

        <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out {{ $currentSlide === $index ? 'opacity-100' : 'opacity-0' }}">

            {{-- Background Media --}}
            @if($slide['media_type'] === 'video' && !($slide['only_image'] ?? false))
                @php
                    $isCurrentSlide = $currentSlide === $index;
                    $totalSlides = count($heroConfig['slides']);
                    $isNextSlide = $index === (($currentSlide + 1) % $totalSlides);
                    $isPrevSlide = $index === (($currentSlide - 1 + $totalSlides) % $totalSlides);
                    $isAdjacent = $isNextSlide || $isPrevSlide;
                @endphp

                <video
                    class="absolute inset-0 w-full h-full object-{{ $slide['media_fit'] ?? 'cover' }} object-{{ $slide['media_position'] ?? 'center' }} {{ $isCurrentSlide ? 'current-video' : '' }}"
                    @if($isCurrentSlide)
                        preload="auto"
                    @if($slide['video_autoplay'] ?? false) autoplay @endif
                    @elseif($isAdjacent)
                        preload="metadata"
                    @else
                        preload="none"
                    @endif
                    @if($slide['video_muted'] ?? false) muted @endif
                    @if($slide['video_loop'] ?? false) loop @endif
                    playsinline
                    webkit-playsinline
                    poster="{{ $slide['video_poster'] ?? '' }}"
                >
                    <source src="{{ $slide['media_src'] }}" type="video/mp4">
                </video>
            @else
                {{-- Imagen como elemento img para mantener aspect ratio --}}
                <div class="absolute inset-0 w-full h-full flex items-center justify-center">
                    {{-- Imagen Desktop --}}
                    <img src="{{ $slide['media_src'] }}"
                         alt="Slide image"
                         class="hidden sm:block w-full h-full object-contain"
                         style="transform: scale({{ $slide['image_scale'] ?? '1.2' }});"
                    />

                    {{-- Imagen Mobile --}}
                    @if(!empty($slide['media_src_mobile']))
                        <img src="{{ $slide['media_src_mobile'] }}"
                             alt="Slide image mobile"
                             class="block sm:hidden w-full h-full object-contain"
                        />
                    @else
                        <img src="{{ $slide['media_src'] }}"
                             alt="Slide image"
                             class="block sm:hidden w-full h-full object-contain"
                        />
                    @endif
                </div>
            @endif

            {{-- Overlay --}}
            @if(!($slide['only_image'] ?? false))
                <div class="absolute inset-0 bg-black z-10" style="opacity: {{ $slide['overlay_opacity'] ?? '0' }}"></div>
            @endif
        </div>

    @endforeach

    {{-- Navigation Arrows --}}
    @if($heroConfig['show_arrows'] && count($heroConfig['slides']) > 1)
        <button
            wire:click="nextSlide"
            class="absolute right-6 top-1/2 transform -translate-y-1/2 rounded-full p-3 text-white transition-all z-20"
            style="background-color: rgba(0, 0, 0, 0.7) !important; backdrop-filter: blur(4px) !important;"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>

        <button
            wire:click="prevSlide"
            class="absolute left-6 top-1/2 transform -translate-y-1/2 rounded-full p-3 text-white transition-all z-20"
            style="background-color: rgba(0, 0, 0, 0.7) !important; backdrop-filter: blur(4px) !important;"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
    @endif

    {{-- Smart Dots/Progress Pagination --}}
    @if($heroConfig['show_dots'] && count($heroConfig['slides']) > 1)
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex items-center space-x-3 z-20">
            @foreach($heroConfig['slides'] as $index => $slide)
                @if($slide['media_type'] === 'video' && $currentSlide === $index)
                    {{-- Video Progress Bar --}}
                    <div class="relative">
                        <div class="w-16 h-1 bg-white/30 rounded-full overflow-hidden">
                            <div
                                class="h-full bg-white transition-all duration-300 rounded-full"
                                :style="`width: ${videoProgress}%`"
                            ></div>
                        </div>
                        <button
                            wire:click="goToSlide({{ $index }})"
                            class="absolute inset-0 w-full h-full"
                        ></button>
                    </div>
                @else
                    {{-- Normal Dot --}}
                    <button
                        wire:click="goToSlide({{ $index }})"
                        class="w-3 h-3 rounded-full transition-all duration-300 {{ $currentSlide === $index ? 'bg-white scale-125' : 'bg-white/50 hover:bg-white/70' }}"
                    ></button>
                @endif
            @endforeach
        </div>
    @endif
</section>
