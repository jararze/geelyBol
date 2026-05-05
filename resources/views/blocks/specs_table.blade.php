@php
    $rows = $data['rows'] ?? [];
@endphp

<section class="bg-gray-50 py-16 md:py-20">
    <div class="max-w-5xl mx-auto px-4">
        @if (!empty($data['title']))
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-10 text-center">{{ $data['title'] }}</h2>
        @endif

        @if (!empty($rows))
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <dl>
                    @foreach ($rows as $index => $row)
                        <div class="grid grid-cols-1 md:grid-cols-2 px-6 py-4 {{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }}">
                            <dt class="text-sm font-medium text-gray-600">{{ $row['label'] ?? '' }}</dt>
                            <dd class="text-sm text-gray-900 mt-1 md:mt-0">{{ $row['value'] ?? '' }}</dd>
                        </div>
                    @endforeach
                </dl>
            </div>
        @endif
    </div>
</section>
