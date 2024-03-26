<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">

    <!-- Styles -->
    @livewireStyles

    @yield('css') {{-- Agrege esto para DropZone --}}
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-invitation')


        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts

    @yield('js') {{-- Agrege esto para DropZone --}}


    {{-- MASTER CLASS - @stack('script') - Sirve para recibir un script que viene desde un
    componente de Livewire enviado por un - @push('script') y lo inserta en esta plantilla
    para que se ejecute y trabaje.
    En este caso tenemos uno que viene desde:( livewire.store.payment.payment-oder.blade.php)
    que contiene lo de paypal. --}}
    @stack('script')

</body>

</html>
