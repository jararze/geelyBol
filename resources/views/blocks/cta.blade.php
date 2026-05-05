<section class="bg-black text-white py-16 md:py-24">
    <div class="max-w-4xl mx-auto px-4 text-center">
        @if (!empty($data['title']))
            <h2 class="text-3xl md:text-5xl font-bold mb-4">{{ $data['title'] }}</h2>
        @endif

        @if (!empty($data['description']))
            <p class="text-lg text-white/80 mb-8 max-w-2xl mx-auto">{{ $data['description'] }}</p>
        @endif

        @if (!empty($data['button_text']) && !empty($data['button_link']))
            <a href="{{ $data['button_link'] }}"
               class="inline-block bg-white text-black px-8 py-3 rounded-lg font-medium hover:bg-gray-100 transition">
                {{ $data['button_text'] }}
            </a>
        @endif
    </div>
</section>
