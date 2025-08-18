<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.front.head')

</head>
<body class="min-h-screen bg-white">

<livewire:front.navigation/>



<main>
    {{ $slot }}
</main>

<livewire:front.footer/>
@livewireScripts
@stack('scripts')

{{-- Loader Script --}}
<script>
    // Mostrar loader al inicio de la página
    document.addEventListener('DOMContentLoaded', function() {
        // Si la página se está cargando, mostrar loader
        if (document.readyState !== 'complete') {
            if (window.pageLoader) {
                window.pageLoader.show('Cargando página...', 'progress');
            }
        }
    });
</script>
</body>
</html>
