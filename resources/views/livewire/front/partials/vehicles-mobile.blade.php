{{-- resources/views/livewire/front/partials/vehicles-mobile.blade.php --}}
<div class="relative">
    {{-- Current Vehicle --}}
    @if(isset($modelsConfig['vehicles'][$activeCategory][$currentSlide]))
        @php $vehicle = $modelsConfig['vehicles'][$activeCategory][$currentSlide]; @endphp

        <div class="text-center px-4">
            {{-- Vehicle Name --}}
            <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $vehicle['name'] }}</h3>

            {{-- Vehicle Image --}}
            <div class="relative mb-6">
                <img src="{{ asset($vehicle['image']) }}"
                     alt="{{ $vehicle['name'] }}"
                     class="w-full h-auto max-w-sm mx-auto">
            </div>

            {{-- Pricing --}}
            <div class="mb-6">
                <div class="text-sm text-gray-500 mb-1">
                    {{ $vehicle['pricing']['from_label'] }}
                    <span class="{{ $vehicle['pricing']['price_before_color'] }} {{ $vehicle['pricing']['price_before_decoration'] }}">
                        {{ $vehicle['pricing']['currency_before'] }} {{ $vehicle['pricing']['price_before'] }}
                    </span>
                </div>

                <div class="flex justify-center items-center space-x-2 mb-4">
                    <span class="{{ $vehicle['pricing']['discount_label_color'] }} text-sm font-medium">
                        {{ $vehicle['pricing']['discount_label'] }}
                    </span>
                    <span class="{{ $vehicle['pricing']['price_now_color'] }} text-2xl {{ $vehicle['pricing']['price_now_weight'] }}">
                        {{ $vehicle['pricing']['currency_now'] }} {{ $vehicle['pricing']['price_now'] }}
                    </span>
                </div>

                {{-- Button --}}
                @if($vehicle['button_primary']['show'])
                    <button class="{{ $vehicle['button_primary']['bg_color'] }} {{ $vehicle['button_primary']['text_color'] }}
                                   {{ $vehicle['button_primary']['hover_bg'] }} px-8 py-3
                                   {{ $vehicle['button_primary']['border_radius'] }} {{ $vehicle['button_primary']['font_weight'] }}
                                   transition-colors duration-200 mb-4">
                        {{ $vehicle['button_primary']['text'] }}
                    </button>
                @endif
            </div>

            {{-- Description --}}
            <p class="text-gray-600 max-w-xs mx-auto">{{ $vehicle['description'] }}</p>
        </div>
    @endif

    {{-- Navigation Arrows --}}
    @if(count($modelsConfig['vehicles'][$activeCategory]) > 1)
        <button wire:click="prevSlide"
                class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white
                       p-2 rounded-full shadow-lg transition-all duration-200 z-10">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>

        <button wire:click="nextSlide"
                class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white
                       p-2 rounded-full shadow-lg transition-all duration-200 z-10">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    @endif
</div>
