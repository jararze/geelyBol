<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.front.head')

    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">

        <livewire:front.navigation/>

        <livewire:front.hero-section/>

        <livewire:front.model-section />

        <span class="text-red-500 text-2xl">HOLAA</span>


        <main>
            {{ $slot }}
        </main>


        @livewireScripts
        @stack('scripts')
    </body>
</html>
