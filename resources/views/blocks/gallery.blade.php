@php
    $images = $data['images'] ?? [];
@endphp

<section id="galeria" class="bg-white py-16 md:py-20">
    <div class="max-w-7xl mx-auto px-4">
        @if (!empty($data['title']))
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-10 text-center">{{ $data['title'] }}</h2>
        @endif

        @if (!empty($images))
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($images as $image)
                    @php $url = \App\Filament\Helpers\ImageHelper::resolveUrl($image); @endphp
                    @if ($url)
                        <div class="overflow-hidden rounded-lg bg-gray-100">
                            <img src="{{ $url }}"
                                 alt="{{ $vehicle->name }}"
                                 class="w-full h-64 md:h-80 object-cover hover:scale-105 transition duration-500">
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</section>
