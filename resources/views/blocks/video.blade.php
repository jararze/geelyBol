@php
    $url = $data['youtube_url'] ?? '';
    $videoId = null;

    if ($url) {
        if (preg_match('#(?:youtube\.com/watch\?v=|youtu\.be/|youtube\.com/embed/)([A-Za-z0-9_-]{11})#', $url, $matches)) {
            $videoId = $matches[1];
        }
    }
@endphp

<section class="bg-gray-900 py-16 md:py-20 text-white">
    <div class="max-w-5xl mx-auto px-4">
        @if (!empty($data['title']))
            <h2 class="text-3xl md:text-4xl font-bold mb-3 text-center uppercase tracking-tight">
                {{ $data['title'] }}
            </h2>
        @endif

        @if (!empty($data['subtitle']))
            <p class="text-base md:text-lg text-white/80 max-w-2xl mx-auto mb-10 text-center">
                {{ $data['subtitle'] }}
            </p>
        @endif

        @if ($videoId)
            <div class="relative w-full overflow-hidden rounded-lg shadow-lg" style="padding-top: 56.25%;">
                <iframe class="absolute inset-0 w-full h-full"
                        src="https://www.youtube.com/embed/{{ $videoId }}"
                        title="{{ $data['title'] ?? $vehicle->name }}"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                </iframe>
            </div>
        @else
            <div class="bg-gray-800 rounded-lg p-12 text-center text-white/60 border border-white/10">
                Video por agregar.
            </div>
        @endif
    </div>
</section>
