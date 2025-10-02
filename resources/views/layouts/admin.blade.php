<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400&family=Montserrat:wght@200&family=Playfair+Display&family=Roboto:wght@300&family=Zen+Antique+Soft&display=swap"
        rel="stylesheet">

    {{-- font-family: 'Cormorant Garamond', serif; --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400&family=Montserrat:wght@200&family=Playfair+Display&family=Roboto:wght@300&family=Zen+Antique+Soft&display=swap"
        rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Scheherazade+New&display=swap" rel="stylesheet">


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Bootstrap css v5.3 --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    {{-- Date Picker Part 1/4 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Styles -->
    @livewireStyles
    @livewireCalendarScripts    {{-- Lo agregue para que funcione el calendario de Livewire --}}


    {{-- Agrege esto para DropZone --}}

    {{-- Formatea EL PHONE NUMBER      ojo ojo --}}
    <script src="{{ asset('js/format_phone_numbercsd.js') }}"></script>

    @yield('css') {{-- Agrege esto para DropZone --}}

</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">
        {{-- @livewire('navigation-menu')        YA NO SE USA --}}

        <!-- Page Heading -->
        {{-- YA NO SE USA
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif --}}

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    {{-- @livewireScripts ........  OJO   OJO  OJO --}}

    @yield('js') {{-- Agrege esto para DropZone --}}

    {{-- Bootstrap js v5.3 --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>

    {{-- Date Picker Part 2/4 --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    {{-- Date Picker Part 3/4 --}}
    <script>
        flatpickr('#datep')
    </script>



    {{-- MASTER CLASS - @stack('script') - Sirve para recibir un script que viene desde un
    componente de Livewire enviado por un - @push('script') y lo inserta en esta plantilla
    para que se ejecute y trabaje.
    En este caso tenemos uno que viene desde:( livewire.admin.user.create-user.blade.php)
    que contiene lo de crear un user. --}}
    @stack('script')
    @stack('js') {{-- Supuestamente se esta usando para SweetAlert2 --}}

</body>

</html>
