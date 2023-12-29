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
        @livewireStyles
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen   bg-white dark:bg-gray-900">
            @include('components.navigation')


            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            {{-- <main>
                @yield('content')
            </main> --}}
        </div>
        @livewireScripts
        <script src="{{ asset('asset/js/darkmode.js') }}"></script>
        <script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script>
        <x-livewire-alert::flash />

    </body>
</html>
