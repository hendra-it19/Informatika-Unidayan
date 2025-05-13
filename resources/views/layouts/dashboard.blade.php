<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="noindex">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @notifyCss
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('css')
    <title>{{ ucfirst(auth()->user()->role) }} | {{ $judulHalaman ?? 'Dashboard' }}</title>
</head>

<body class="relative ">

    <div class="absolute z-[9999999]">
        <x-notify::notify />
    </div>

    @include('layouts.dashboard.navbar')

    @include('layouts.dashboard.sidebar')

    <div class="p-4 sm:ml-64 pt-16 bg-gray-100 ">
        @yield('pages')
        @include('layouts.dashboard.footer')
    </div>

    @notifyJs
    @stack('js')
</body>

</html>
