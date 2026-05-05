@php
    $imageUrl = \App\Filament\Helpers\ImageHelper::resolveUrl($data['image'] ?? null);
    $imageRight = ($data['image_position'] ?? 'right') === 'right';
@endphp

<section class="bg-white py-16 md:py-20">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-16 items-center">
            <div class="{{ $imageRight ? 'md:order-1' : 'md:order-2' }}">
                @if (!empty($data['title']))
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">{{ $data['title'] }}</h2>
                @endif

                @if (!empty($data['content']))
                    <div class="prose prose-lg max-w-none text-gray-600">{!! $data['content'] !!}</div>
                @endif
            </div>

            <div class="{{ $imageRight ? 'md:order-2' : 'md:order-1' }}">
                @if ($imageUrl)
                    <img src="{{ $imageUrl }}"
                         alt="{{ $data['title'] ?? $vehicle->name }}"
                         class="w-full h-auto rounded-lg shadow-md">
                @endif
            </div>
        </div>
    </div>
</section>
