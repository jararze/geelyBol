@php
    $seoTitle = $vehicle->seo_title ?: $vehicle->name . ' - Geely Bolivia';
    $seoDescription = $vehicle->seo_description ?: ($vehicle->description ?? '');
@endphp

<div>
    @section('title', $seoTitle)
    @push('meta')
        @if ($seoDescription)
            <meta name="description" content="{{ $seoDescription }}">
        @endif
        <meta property="og:title" content="{{ $seoTitle }}">
        @if ($seoDescription)
            <meta property="og:description" content="{{ $seoDescription }}">
        @endif
    @endpush

    @if (empty($blocks))
        <section class="bg-white">
            <div class="max-w-7xl mx-auto px-4 py-20 text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">{{ $vehicle->name }}</h1>
                @if ($vehicle->description)
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">{{ $vehicle->description }}</p>
                @endif
                @php $mainImage = \App\Filament\Helpers\ImageHelper::resolveUrl($vehicle->image); @endphp
                @if ($mainImage)
                    <img src="{{ $mainImage }}" alt="{{ $vehicle->name }}" class="mx-auto mt-10 max-w-4xl w-full h-auto">
                @endif
            </div>
        </section>
    @else
        @foreach ($blocks as $block)
            @includeIf('blocks.' . ($block['type'] ?? ''), [
                'data' => $block['data'] ?? [],
                'vehicle' => $vehicle,
                'versions' => $versions ?? collect(),
            ])
        @endforeach
    @endif
</div>
