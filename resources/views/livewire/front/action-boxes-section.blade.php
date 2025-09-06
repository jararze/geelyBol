{{-- resources/views/livewire/action-boxes.blade.php --}}
<section class="action-boxes pb-8"
         style="background: linear-gradient(to bottom, white, #d1d5db);">
    <div class="action-boxes__container">
        <h2 class="action-boxes__title">{{ $sectionTitle }}</h2>
        <div class="action-boxes__grid">
            @foreach($this->boxes as $box)
                @php
                    $isAnchor = ($box['is_anchor'] ?? false) || str_starts_with($box['route'], '#');
                    $href = $isAnchor ? $box['route'] : route($box['route']);
                @endphp

                <a href="{{ $href }}">
                    <div class="action-box" style="--box-color: {{ $box['color'] }}">
                        <div class="action-box__icon" style="color: {{ $box['color'] }}">
                            {!! $box['svg_icon'] !!}
                        </div>
                        <h3 class="action-box__title">{{ $box['title'] }}</h3>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
