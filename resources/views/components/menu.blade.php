<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Spectrolab</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Gustitos') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    <!--tailwindcss-->
    <!--<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">-->
    <!--fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" href="{{ asset('imagenes/logo.jpeg') }}">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div class="relative min-h-screen md:flex bg-gray-200">
        <!--menu moviles-->
        <div class="bg-blue-500 text-gray-100 flex justify-between md:hidden">
            <!--logo-->
            <a href="#" class="block p-4 text-white font-bold">Sis Spectrolab</a>
            <!--menu-->
            <button class="menu-celulares p-4 focus:outline-none focus:bg-gray-700">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <!--sidebar-->
        <div
            class="z-20 menu-principal bg-blue-400 text-gray-100 w-64 py-7 px-2 absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition duration-200 ease-in-out">
            <div class="px-12 pb-4">
                @if (Auth::user()->profile_photo_path != null)
                    <img class="rounded-full w-24 h-24" src="{{ asset(Auth::user()->profile_photo_path) }}"
                        alt="insco">
                @else
                    {{-- <img class="w-24 h-24 rounded-full" src="{{ asset('imagenes/logo.jpeg') }}" alt="logo empresa"> --}}
                @endif

            </div>
            <div class="ml-3 relative bg-blue-400 text-gray-100">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button
                                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="h-8 w-8 rounded-full object-cover"
                                    src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                        @else
                            <span class="inline-flex rounded-md">
                                <button type="button"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                    {{ Auth::user()->name }}

                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
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
                            {{ __('Cuenta de usuario') }}
                        </div>

                        {{-- <x-jet-dropdown-link href="{{ route('profile.show') }}"> --}}
                        <x-dropdown-link href="{{-- route('perfil.show') --}}">
                            {{ __('Perfil') }}
                        </x-dropdown-link>

                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                {{ __('API Tokens') }}
                            </x-dropdown-link>
                        @endif

                        <div class="border-t border-gray-100"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                {{ __('Cerrar sesión') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            <!--menu-->
            <nav class="py-4 text-sm lg:text-base">
                <a href="{{ route('dashboard') }}"
                    class="block rounded py-2 px-4 hover:bg-gray-500 hover:text-white"><i
                        class="fas fa-laptop-code"></i> Principal</a>
                <a href="#"
                class="block rounded py-2 px-4 hover:bg-gray-500 hover:text-white"><i class="fa-solid fa-user-pen"></i>
                Cuenta</a>
                <a href="{{route('vista_insumos')}}"
                class="block rounded py-2 px-4 hover:bg-gray-500 hover:text-white"><i
                    class="fa-solid fa-boxes-packing"></i> Ver articulos</a>
                <a href="{{ route('vista_compras') }}"
                    class="block rounded py-2 px-4 hover:bg-gray-500 hover:text-white"><i class="fa-solid fa-store"></i>
                    Registrar compra</a>
                <a href="{{ route('vista_consumos') }}"
                    class="block rounded py-2 px-4 hover:bg-gray-500 hover:text-white"><i
                        class="fa-solid fa-pen-to-square"></i> Registrar salida</a>
                <a href="{{ route('vista_proveedores') }}"
                    class="block rounded py-2 px-4 hover:bg-gray-500 hover:text-white"><i
                        class="fa-solid fa-truck-field"></i> Ver Proveedores</a>
                <a href="{{ route('vista_unidades') }}"
                    class="block rounded py-2 px-4 hover:bg-gray-500 hover:text-white"><i class="fa-solid fa-cube"></i>
                    Ver Unidades</a>
                <a href="{{ route('vista_solicitantes') }}"
                    class="block rounded py-2 px-4 hover:bg-gray-500 hover:text-white"><i
                        class="fa-solid fa-user-group"></i> Ver Solicitantes</a>
                <a href="{{ route('vista_categorias') }}"
                    class="block rounded py-2 px-4 hover:bg-gray-500 hover:text-white"><i
                        class="fa-solid fa-list"></i> Ver Categorias</a>
            </nav>
        </div>
        <!--contenido-->
        <div class="flex-1 px-0 py-0 text-2xl font-semibold" id="contenido">
            {{-- Auth::user()->name.' '.Auth::user()->id --}}
            {{ $slot }}
        </div>
    </div>

    @livewireScripts
</body>

</html>
