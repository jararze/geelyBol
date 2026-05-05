@php
    $links = $data['links'] ?? [];
@endphp

@if (!empty($links))
    <nav class="sticky top-0 z-30 bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4">
            <ul class="flex overflow-x-auto whitespace-nowrap gap-1 md:gap-2 scrollbar-hide">
                @foreach ($links as $link)
                    @php
                        $href = $link['anchor'] ?? '#';
                        $label = $link['label'] ?? '';
                    @endphp
                    <li>
                        <a href="{{ $href }}"
                           class="inline-block px-4 md:px-6 py-3 text-sm md:text-base font-medium text-gray-700 hover:text-blue-600 hover:border-b-2 hover:border-blue-600 transition">
                            {{ $label }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>

    <style>
        html { scroll-behavior: smooth; }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
@endif
