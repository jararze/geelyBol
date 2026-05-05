@php
    $sections = $data['sections'] ?? [];
@endphp

@if (!empty($sections))
    <section id="tecnologia" class="bg-white py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4 space-y-16 md:space-y-20">
            @foreach ($sections as $sectionIndex => $section)
                @php $slides = $section['slides'] ?? []; @endphp

                <div x-data="{ current: 0, total: {{ count($slides) }} }">
                    @if (!empty($section['title']))
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-8 md:mb-10 text-center md:text-left uppercase tracking-tight">
                            {{ $section['title'] }}
                        </h2>
                    @endif

                    @if (!empty($slides))
                        <div class="relative">
                            @foreach ($slides as $slideIndex => $slide)
                                @php $img = \App\Filament\Helpers\ImageHelper::resolveUrl($slide['image'] ?? null); @endphp

                                <div x-show="current === {{ $slideIndex }}" x-cloak
                                     class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 items-stretch">

                                    <div class="md:col-span-2 relative overflow-hidden rounded-lg bg-gray-200 aspect-video md:aspect-[16/10]">
                                        @if ($img)
                                            <img src="{{ $img }}" alt="{{ $slide['title'] ?? '' }}"
                                                 class="absolute inset-0 w-full h-full object-cover">
                                            <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/70 to-transparent p-6">
                                                @if (!empty($slide['label']))
                                                    <span class="inline-block bg-white/90 backdrop-blur text-gray-900 text-xs uppercase tracking-widest font-bold px-3 py-1 rounded">
                                                        {{ $slide['label'] }}
                                                    </span>
                                                @endif
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex flex-col justify-center bg-gray-50 rounded-lg p-6 md:p-8">
                                        @if (!empty($slide['title']))
                                            <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-3">{{ $slide['title'] }}</h3>
                                        @endif
                                        @if (!empty($slide['description']))
                                            <p class="text-sm md:text-base text-gray-600">{{ $slide['description'] }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                            @if (count($slides) > 1)
                                <div class="flex justify-center gap-2 mt-6">
                                    @foreach ($slides as $slideIndex => $_)
                                        <button type="button"
                                                @click="current = {{ $slideIndex }}"
                                                :class="current === {{ $slideIndex }} ? 'bg-blue-600 w-8' : 'bg-gray-300 w-2'"
                                                class="h-2 rounded-full transition-all"
                                                aria-label="Slide {{ $slideIndex + 1 }}"></button>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </section>
@endif
