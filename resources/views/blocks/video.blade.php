@php
    $url = $data['youtube_url'] ?? '';
    $videoId = null;

    if ($url) {
        if (preg_match('#(?:youtube\.com/watch\?v=|youtu\.be/|youtube\.com/embed/)([A-Za-z0-9_-]{11})#', $url, $matches)) {
            $videoId = $matches[1];
        }
    }
@endphp

<section class="bg-gray-900 py-16 md:py-20">
    <div class="max-w-5xl mx-auto px-4">
        @if (!empty($data['title']))
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-10 text-center">{{ $data['title'] }}</h2>
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
        @endif
    </div>
</section>
