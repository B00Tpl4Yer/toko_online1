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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{ asset('asset/css/sweetalert2.min.css') }}">
        <script src="{{ asset('asset/js/sweetalert2.min.js') }}"></script>
        @livewireStyles

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen  bg-white dark:bg-gray-900">
            @include('components.navigation')


            <!-- Page Content -->
            {{-- <main>
                {{ $slot }}
            </main> --}}
            <main class="px-5 max-w-full">
                @yield('content')
            </main>
        </div>
        @livewireScripts
        <script src="{{ asset('asset/js/darkmode.js') }}"></script>
        <script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script>
        <x-livewire-alert::flash />


    </body>
</html>
