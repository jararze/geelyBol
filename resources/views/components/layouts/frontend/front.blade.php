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

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-MV85ZF26');</script>
<!-- End Google Tag Manager -->

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MV85ZF26"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</body>
</html>
