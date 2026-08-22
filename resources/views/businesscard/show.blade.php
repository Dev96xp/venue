<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $name }} — {{ $company }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400;600;700&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100 min-h-screen flex items-center justify-center px-4 py-10">

    <div class="w-full max-w-sm bg-white rounded-2xl shadow-lg overflow-hidden">

        <div class="px-6 pt-8 pb-6 text-center">
            <x-app-logo class="h-10 w-auto mx-auto mb-4" />

            <div class="mx-auto h-24 w-24 rounded-full flex items-center justify-center"
                style="background-color: #ec4899;">
                <span class="text-white text-3xl font-bold" style="font-family: Montserrat">
                    {{ collect(explode(' ', $name))->map(fn ($part) => mb_substr($part, 0, 1))->join('') }}
                </span>
            </div>

            <a href="{{ route('home') }}" class="block mt-5">
                <h1 class="text-2xl font-bold text-gray-800" style="font-family: Montserrat">
                    {{ $name }}
                </h1>
            </a>

            <p class="mt-1 text-sm font-semibold uppercase tracking-wide" style="color: #ec4899;">
                {{ $title }}
            </p>

            <p class="mt-1 text-gray-600">
                {{ $company }}
            </p>

            <p class="mt-2 text-gray-500 text-sm">
                {{ $phone }}
            </p>
        </div>

        <div class="px-6 pb-8 space-y-3">
            <a href="tel:{{ $phone_tel }}"
                class="flex items-center justify-center gap-2 w-full rounded-lg bg-gray-800 text-white font-semibold py-3 hover:bg-gray-700 transition">
                Llamar
            </a>

            <a href="https://wa.me/{{ $phone_wa }}" target="_blank" rel="noopener"
                class="flex items-center justify-center gap-2 w-full rounded-lg bg-green-600 text-white font-semibold py-3 hover:bg-green-500 transition">
                WhatsApp
            </a>

            <a href="{{ route('businesscard.vcard') }}"
                class="flex items-center justify-center gap-2 w-full rounded-lg border border-gray-300 text-gray-800 font-semibold py-3 hover:bg-gray-50 transition">
                Guardar contacto
            </a>
        </div>
    </div>

</body>

</html>
