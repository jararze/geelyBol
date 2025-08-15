{{-- resources/views/livewire/action-boxes.blade.php --}}
<section class="action-boxes pb-8"
         style="background: linear-gradient(to bottom, white, #d1d5db);">
    <div class="action-boxes__container">
        <h2 class="action-boxes__title">{{ $sectionTitle }}</h2>
        <div class="action-boxes__grid">
            @foreach($boxes as $box)
                <div class="action-box"
                     wire:click="redirectTo('{{ $box['route'] }}')"
                     style="--box-color: {{ $box['color'] }}">
                    <div class="action-box__icon" style="color: {{ $box['color'] }}">
                        {!! $box['svg_icon'] !!}
                    </div>
                    <h3 class="action-box__title">{{ $box['title'] }}</h3>
                </div>
            @endforeach
        </div>
    </div>
</section>
