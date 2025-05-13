<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>401 | Not Authorize Page</title>
    <meta name="robots" content="noindex">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div class="w-full h-screen flex items-center justify-center">
        <div>
            <img src="{{ asset('assets/image/errorpage/401.svg') }}" alt="not authorize image"
                class="object-cover overflow-hidden w-60 aspect-auto block">
            <h1 class="text-center my-4">401 <span>Otorias Anda Tidak Dikenali</span></h1>
            <a href="javascript:void(0)" onclick="history.back()"
                class="w-full max-w-sm text-center bg-primary-500 text-gray-100 rounded block">Kembali</a>
        </div>
    </div>

</body>

</html>
