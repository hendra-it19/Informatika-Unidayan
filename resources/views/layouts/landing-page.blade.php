<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @php
        if (empty($metaDescription)) {
            $metaDescription =
                'Website resmi program studi Teknik Informatika Universitas Dayanu Ikhsanuddin Kota Baubau';
        }
        if (empty($metaKeyword)) {
            $metaKeyword = 'Informatika Unidayan,IT Unidayan,Teknik Informatika,Universitas Dayanu Ikhsanuddin';
        }
        if (empty($metaAuthor)) {
            $metaAuthor = 'Hendra, S.T';
        }
    @endphp

    <meta name="description" content="{{ $metaDescription }}">
    <meta name="keywords" content="{{ $metaKeyword }}">
    <meta name="author" content="{{ $metaAuthor }}">

    <title>{{ $judulHalaman ?? 'Judul Halaman' }} | {{ config('app.name') }}</title>

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/notification.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/aos/aos.css') }}">
    @stack('css')

<body class="relative w-full">
    <div id="loader"
        class="loader fixed z-[9999] w-full h-full bg-gray-700 bg-opacity-40 flex items-center justify-center transition-all duration-500">
        <x-loadingpage />
    </div>

    <div id="content">

        @include('layouts.landing-page.navbar')

        <x-button-scroll-top />
        @yield('pages')

        @include('layouts.landing-page.footer')

    </div>

    <script src="{{ asset('assets/js/navbar.js') }}"></script>
    <script src="{{ asset('vendor/aos/aos.js') }}"></script>
    <script>
        AOS.init();
        document.onreadystatechange = function() {
            if (document.readyState !== "complete") {
                document.querySelector(
                    "#loader").style.visibility = "visible";
            } else {
                document.querySelector(
                    "#loader").style.display = "none";
            }
        };
    </script>
    @stack('js')
</body>

</html>
