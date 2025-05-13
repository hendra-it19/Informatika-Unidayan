<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="noindex">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
    <title>{{ ucfirst(auth()->user()->role) }} | {{ $judulHalaman ?? 'Dashboard' }}</title>
</head>

<body class="relative">

    @include('layouts.dashboard.navbar')

    @include('layouts.dashboard.sidebar')

    <div class="p-4 sm:ml-64 pt-16 bg-gray-100 relative">
        @yield('pages')
    </div>

    @livewireScripts
    @stack('js')
</body>

</html>
