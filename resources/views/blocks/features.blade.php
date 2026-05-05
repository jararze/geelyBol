@php
    $highlights = $data['highlights'] ?? [];
@endphp

<section class="relative overflow-hidden bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800 py-16 md:py-24 text-white">
    <div class="absolute inset-0 opacity-20"
         style="background-image: radial-gradient(circle at 20% 20%, white 1px, transparent 1px), radial-gradient(circle at 80% 70%, white 1px, transparent 1px); background-size: 80px 80px, 50px 50px;"></div>

    <div class="relative max-w-7xl mx-auto px-4 text-center">
        @if (!empty($data['title']))
            <h2 class="text-3xl md:text-5xl font-bold uppercase tracking-tight mb-4">
                {{ $data['title'] }}
            </h2>
        @endif

        @if (!empty($data['description']))
            <p class="text-base md:text-lg text-white/90 max-w-3xl mx-auto mb-12">
                {{ $data['description'] }}
            </p>
        @endif

        @if (!empty($highlights))
            <div class="flex flex-col md:flex-row items-center justify-center gap-6 md:gap-4">
                @foreach ($highlights as $i => $h)
                    @if ($i > 0 && !empty($highlights[$i - 1]['separator'] ?? null))
                        <div class="text-white/70 text-2xl md:text-3xl font-light italic px-2">
                            {{ $highlights[$i - 1]['separator'] }}
                        </div>
                    @endif

                    <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl px-8 py-8 min-w-[200px] flex-1 max-w-sm">
                        <div class="text-5xl md:text-7xl font-bold leading-none mb-2">
                            {{ $h['number'] ?? '' }}
                        </div>
                        @if (!empty($h['unit']))
                            <div class="text-base md:text-lg uppercase tracking-widest font-medium mb-3">
                                {{ $h['unit'] }}
                            </div>
                        @endif
                        @if (!empty($h['description']))
                            <div class="text-sm text-white/80">
                                {{ $h['description'] }}
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
