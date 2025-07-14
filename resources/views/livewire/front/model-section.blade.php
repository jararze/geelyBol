{{-- resources/views/livewire/front/model-section.blade.php --}}
<section class="{{ $modelsConfig['section_settings']['background_color'] }} {{ $modelsConfig['section_settings']['padding_y'] }}">
    <div class="container mx-auto px-4">
        {{-- Header --}}
        <div class="{{ $modelsConfig['header']['text_align'] }} {{ $modelsConfig['header']['margin_bottom'] }}">
            <h2 class="{{ $modelsConfig['header']['title_color'] }} {{ $modelsConfig['header']['title_size'] }} {{ $modelsConfig['header']['title_weight'] }}">
                {{ $modelsConfig['header']['title'] }}
            </h2>
            <p class="{{ $modelsConfig['header']['subtitle_color'] }} {{ $modelsConfig['header']['subtitle_size'] }} {{ $modelsConfig['header']['subtitle_max_width'] }} mx-auto mt-4">
                {{ $modelsConfig['header']['subtitle'] }}
            </p>
        </div>

        {{-- Categories Navigation --}}
        <div class="flex justify-center mb-16">
            <div class="flex space-x-12">
                @foreach($modelsConfig['categories'] as $category)
                    <button
                        wire:click="setActiveCategory('{{ $category['id'] }}')"
                        class="relative px-4 py-2 font-medium text-lg transition-all duration-200
                               {{ $activeCategory === $category['id']
                                  ? 'text-purple-600'
                                  : 'text-gray-400 hover:text-purple-600' }}"
                    >
                        {{ $category['label'] }}
                        @if($activeCategory === $category['id'])
                            <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-purple-600"></div>
                        @endif
                    </button>
                @endforeach
            </div>
        </div>

        {{-- Vehicles Display --}}
        @if(isset($modelsConfig['vehicles'][$activeCategory]))
            <div class="relative">
                {{-- Desktop View --}}
                <div class="hidden lg:block">
                    @include('livewire.front.partials.vehicles-desktop')
                </div>

                {{-- Mobile View --}}
                <div class="lg:hidden">
                    @include('livewire.front.partials.vehicles-mobile')
                </div>
            </div>
        @endif
    </div>
</section>
