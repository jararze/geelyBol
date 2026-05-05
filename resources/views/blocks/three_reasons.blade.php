@php
    $reasons = $data['reasons'] ?? [];
@endphp

<section id="diseno" class="bg-white py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 lg:gap-12">
            <div class="lg:col-span-1">
                @if (!empty($data['title']))
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight mb-4">
                        {{ $data['title'] }}
                    </h2>
                @endif
                @if (!empty($data['subtitle']))
                    <p class="text-base md:text-lg text-gray-600">{{ $data['subtitle'] }}</p>
                @endif
            </div>

            <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
                @foreach ($reasons as $reason)
                    @php $img = \App\Filament\Helpers\ImageHelper::resolveUrl($reason['image'] ?? null); @endphp
                    <div class="relative overflow-hidden rounded-lg group bg-gray-200 aspect-[3/4]">
                        @if ($img)
                            <img src="{{ $img }}"
                                 alt="{{ $reason['title'] ?? '' }}"
                                 class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-5 text-white">
                            <h3 class="text-xl md:text-2xl font-bold mb-1">{{ $reason['title'] ?? '' }}</h3>
                            @if (!empty($reason['subtitle']))
                                <p class="text-sm text-white/90">{{ $reason['subtitle'] }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
