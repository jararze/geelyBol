@php
    $items = $data['items'] ?? [];
@endphp

@if (!empty($items))
    <section class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 py-8 md:py-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-0">
                @foreach ($items as $i => $item)
                    <div class="text-center px-2 md:px-6 {{ $i > 0 ? 'md:border-l md:border-gray-200' : '' }}">
                        <div class="text-3xl md:text-4xl font-bold text-gray-900 leading-none mb-1">
                            {{ $item['value'] ?? '' }}
                            @if (!empty($item['suffix']))
                                <span class="text-sm md:text-base font-medium text-gray-500 ml-1">{{ $item['suffix'] }}</span>
                            @endif
                        </div>
                        <div class="text-xs md:text-sm uppercase tracking-wider text-gray-500">
                            {{ $item['label'] ?? '' }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
