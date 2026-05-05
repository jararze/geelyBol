@php
    $items = $data['items'] ?? [];
@endphp

<section class="bg-white py-16 md:py-20">
    <div class="max-w-7xl mx-auto px-4">
        @if (!empty($data['title']))
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-12 text-center">{{ $data['title'] }}</h2>
        @endif

        @if (!empty($items))
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($items as $item)
                    <div class="text-center md:text-left">
                        @if (!empty($item['icon']))
                            <div class="mb-4 text-blue-600">
                                @if (str_starts_with($item['icon'], 'heroicon'))
                                    <x-dynamic-component :component="$item['icon']" class="w-10 h-10 mx-auto md:mx-0" />
                                @else
                                    <span class="text-3xl">{{ $item['icon'] }}</span>
                                @endif
                            </div>
                        @endif
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $item['title'] ?? '' }}</h3>
                        @if (!empty($item['description']))
                            <p class="text-gray-600">{{ $item['description'] }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
