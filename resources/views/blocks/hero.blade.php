@php
    $bg = \App\Filament\Helpers\ImageHelper::resolveUrl($data['background'] ?? null);
@endphp

<section class="relative w-full overflow-hidden bg-black text-white">
    @if ($bg)
        <div class="absolute inset-0">
            <img src="{{ $bg }}" alt="{{ $data['title'] ?? $vehicle->name }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/40"></div>
        </div>
    @endif

    <div class="relative z-10 max-w-7xl mx-auto px-4 py-24 md:py-32 text-center md:text-left">
        @if (!empty($data['subtitle']))
            <p class="text-sm md:text-base uppercase tracking-widest text-white/80 mb-3">{{ $data['subtitle'] }}</p>
        @endif

        @if (!empty($data['title']))
            <h1 class="text-4xl md:text-6xl font-bold mb-4 drop-shadow-lg">{{ $data['title'] }}</h1>
        @endif

        @if (!empty($data['description']))
            <p class="text-base md:text-lg text-white/90 max-w-2xl mb-8 mx-auto md:mx-0">{{ $data['description'] }}</p>
        @endif

        @if (!empty($data['cta_text']) && !empty($data['cta_link']))
            <a href="{{ $data['cta_link'] }}"
               class="inline-block bg-white text-black px-8 py-3 rounded-lg font-medium hover:bg-gray-100 transition">
                {{ $data['cta_text'] }}
            </a>
        @endif
    </div>
</section>
