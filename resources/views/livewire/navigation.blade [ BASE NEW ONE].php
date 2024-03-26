<header x-data="{ open: false }" class="bg-gray-600 sticky top-0 z-50">

    {{-- MENU DE NAVEGACION --}}

    <div class="cointainer flex items-center h-16 justify-between md:justify-start">
        {{-- Link --}}
        <a x-on:click="open = !open" {{-- Esta linea permiteque se muestre/>oculte el menu --}}
            class="flex flex-col items-center justify-center order-last md:order-first px-6 md:px-4 bg-white bg-opacity-25 text-white cursor-pointer font-semibold h-full">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path class="inline-flex"stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
            </svg>

            <span class="hidden md:block">Texto 1</span>
        </a>

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="mx-6">
            <x-application-mark class="block h-9 w-auto" />
        </a>

        {{-- Buscador --}}
        <div class="flex-1 hidden md:block">
            {{--    hidden - En pantalla pequeña que lo oculte
                    md:block - Pero despues de una pantalla mediana que lo muestre --}}
            @livewire('search')
        </div>


        <!-- Settings Dropdown -->
        <div class="mx-6 relative hidden md:block">
            @auth
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button
                                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                                    alt="{{ Auth::user()->name }}" />
                            </button>
                        @else
                            <span class="inline-flex rounded-md">
                                <button type="button"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                    {{ Auth::user()->name }}

                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </span>
                        @endif
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Account') }}
                        </div>

                        <x-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        {{-- SEGURIDAD - PERMISO --}}
                        @can('Ver dashboard')
                            <x-dropdown-link href="{{ route('admin.home') }}">
                                Administrator
                            </x-dropdown-link>
                        @endcan

                        <div class="border-t border-gray-100"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf

                            <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            @else
                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">
                        <i class="fas fa-user-circle text-white text-3xl cursor-pointer"></i>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link href="{{ route('login') }}">
                            {{ __('Login') }}
                        </x-dropdown-link>
                        <x-dropdown-link href="{{ route('register') }}">
                            {{ __('Register') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>

            @endauth
        </div>

        <div class="hidden md:block">
            @livewire('dropdown-cart')
        </div>




    </div>


    <nav x-show="open" id="navigation-menu" class="bg-gray-700 bg-opacity-25 w-full absolute">


        {{-- Menu Computadora - NO SE ESTA USANDO, pero aqui se podria desarrollar algo --}}
        {{-- <div class="container h-full hidden md:block">

            <div class="grid grid-cols-4 h-full relative">

                <ul class="bg-white">
                    <h1>hola x</h1>
                </ul>

            </div>
        </div> --}}



        {{-- Menu Mobile --}}

        <div class="bg-white overflow-y-auto md:hidden">

            <div class="container bg-gray-200 py-3 mb-2">
                @livewire('search')
            </div>

            <p class="text-gray-500 px-6 my-2">USUARIOS SXP</p>

            {{-- LIVEWIRE - OJO -  CARRITO DE COMPRAS PARA TELEFONOS, OSEA EN PANTALLA PEQUEÑA --}}
            @livewire('mobile-cart')

            @auth
                <a href="{{ route('profile.show') }}"
                    class="py-2 px-4 text-sm flex items-center text-gray-500 hover:bg-blue-500 hover:text-white">

                    <span class="flex justify-center w-9">
                        {{-- !! - Ayuda a evitar poner HTML en pantalla --}}
                        <i class="fas fa-address-card"></i>
                    </span>

                    Perfil

                </a>


                <a href=""
                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit()"
                    class="py-2 px-4 text-sm flex items-center text-gray-500 hover:bg-blue-500 hover:text-white">

                    <span class="flex justify-center w-9">
                        {{-- !! - Ayuda a evitar poner HTML en pantalla --}}
                        <i class="fas fa-sign-out-alt"></i>
                    </span>

                    Cerrar Session

                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="py-2 px-4 text-sm flex items-center text-gray-500 hover:bg-blue-500 hover:text-white">

                    <span class="flex justify-center w-9">
                        {{-- !! - Ayuda a evitar poner HTML en pantalla --}}
                        <i class="far fa-user-circle"></i>
                    </span>

                    Iniciar Session

                </a>
                <a href="{{ route('register') }}"
                    class="py-2 px-4 text-sm flex items-center text-gray-500 hover:bg-blue-500 hover:text-white">

                    <span class="flex justify-center w-9">
                        {{-- !! - Ayuda a evitar poner HTML en pantalla --}}
                        <i class="fas fa-fingerprint"></i>
                    </span>

                    Registrate

                </a>

            @endauth

        </div>
    </nav>


</header>
