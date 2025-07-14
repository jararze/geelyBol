{{-- resources/views/livewire/front/partials/vehicles-desktop.blade.php --}}
<div class="vehicle-carousel-container"
     x-data="{
        carousel: null,
        currentIndex: @entangle('currentIndex'),
        vehicles: @js($modelsConfig['vehicles'][$activeCategory] ?? [])
     }"
     x-init="
        carousel = new VehicleCarousel3D($el, {
            vehicles: vehicles,
            currentIndex: currentIndex
        });

        $watch('currentIndex', (value) => {
            if (carousel && carousel.currentIndex !== value) {
                carousel.goTo(value);
            }
        });

        window.addEventListener('carousel-changed', (e) => {
            currentIndex = e.detail.index;
        });
     "
     wire:listen="categoryChanged">
</div>


@push('scripts')
    <script src="{{ asset('assets/js/carousel-3d.js') }}"></script>
@endpush
