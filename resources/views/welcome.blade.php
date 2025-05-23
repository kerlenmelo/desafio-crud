<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Desafio CRUD</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-gray-100 light:bg-gray-900">
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen">
        @if (Route::has('login'))
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
            @auth
            <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm">
                Dashboard
            </a>
            @else
            <a href=" {{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm">
                Login
            </a>

            @if (Route::has('register'))
            <a href=" {{ route('register') }}" class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm">
                Cadastre-se
            </a>
            @endif
            @endauth
        </div>
        @endif

        <div class=" max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-center">
                <a href=" {{ route('login') }}">
                    <img src="{{ asset('img/logo.png') }}" style="height: 180px; width: 180px" alt="Logo">
                </a>
            </div>
        </div>
</body>

</html>