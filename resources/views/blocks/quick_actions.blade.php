@php
    $actions = $data['actions'] ?? [];

    $iconMap = [
        'whatsapp' => 'M16.6 14.2c-.3-.1-1.5-.7-1.7-.8-.2-.1-.4-.1-.6.1-.2.3-.6.8-.8 1-.1.2-.3.2-.5.1-.3-.1-1.1-.4-2.1-1.3-.8-.7-1.3-1.6-1.5-1.8-.1-.3 0-.4.1-.5.1-.1.3-.3.4-.5.1-.1.2-.3.3-.4.1-.2.1-.3 0-.5-.1-.1-.6-1.5-.8-2-.2-.5-.4-.4-.6-.4h-.5c-.2 0-.5.1-.7.3-.3.3-1 1-1 2.4 0 1.4 1 2.8 1.2 3 .1.2 2.1 3.2 5 4.4.7.3 1.3.5 1.7.6.7.2 1.4.2 1.9.1.6-.1 1.7-.7 1.9-1.4.2-.7.2-1.3.2-1.4 0-.1-.2-.2-.4-.3zM12 2C6.5 2 2 6.5 2 12c0 1.8.5 3.5 1.3 5L2 22l5.1-1.3c1.4.8 3 1.2 4.7 1.2 5.5 0 10-4.5 10-10S17.5 2 12 2z',
        'phone' => 'M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z',
        'map' => 'M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z',
        'headset' => 'M12 1c-4.97 0-9 4.03-9 9v7c0 1.66 1.34 3 3 3h3v-8H5v-2c0-3.87 3.13-7 7-7s7 3.13 7 7v2h-4v8h3c1.66 0 3-1.34 3-3v-7c0-4.97-4.03-9-9-9z',
        'mail' => 'M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z',
        'drive' => 'M5 11l1.5-4.5h11L19 11m-1.5 5a1.5 1.5 0 01-1.5-1.5 1.5 1.5 0 011.5-1.5 1.5 1.5 0 011.5 1.5 1.5 1.5 0 01-1.5 1.5m-11 0A1.5 1.5 0 015 14.5 1.5 1.5 0 016.5 13 1.5 1.5 0 018 14.5 1.5 1.5 0 016.5 16M18.92 6c-.2-.58-.76-1-1.42-1h-11c-.66 0-1.21.42-1.42 1L3 12v8a1 1 0 001 1h1a1 1 0 001-1v-1h12v1a1 1 0 001 1h1a1 1 0 001-1v-8l-2.08-6z',
    ];
@endphp

@if (!empty($actions))
    <section class="bg-gray-50 py-12 md:py-16">
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                @foreach ($actions as $action)
                    @php
                        $icon = $action['icon'] ?? '';
                        $type = $action['type'] ?? 'external';
                        $target = $type === 'external' ? '_blank' : '_self';
                        $rel = $type === 'external' ? 'noopener noreferrer' : '';
                        $path = $iconMap[$icon] ?? $iconMap['drive'];
                    @endphp
                    <a href="{{ $action['link'] ?? '#' }}"
                       target="{{ $target }}"
                       @if($rel) rel="{{ $rel }}" @endif
                       class="bg-white rounded-lg p-6 flex flex-col items-center justify-center text-center shadow-sm hover:shadow-md transition border border-gray-100 hover:border-blue-200">
                        <div class="w-12 h-12 mb-3 rounded-full bg-blue-50 flex items-center justify-center">
                            <svg viewBox="0 0 24 24" class="w-6 h-6 text-blue-600" fill="currentColor">
                                <path d="{{ $path }}"/>
                            </svg>
                        </div>
                        <span class="text-sm md:text-base font-medium text-gray-800">{{ $action['label'] ?? '' }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endif
