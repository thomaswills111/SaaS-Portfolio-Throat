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
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-screen mx-auto py-6 px-4 sm:px-6 lg:px-8 dark:bg-gray-800">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="w-4/5 mt-6 p-4 mx-auto overflow-hidden
                     bg-white dark:bg-gray-800
                     rounded sm:rounded-lg shadow-md ">
                {{ $slot }}
            </main>
        </div>
    </body>
<footer class="text-center">
    <div class=" flex flex-row justify-evenly text-center
    max-w-screen mx-auto px-4 sm:px-6 lg:px-8 dark:bg-gray-800">
        <div class="text-center text-xs dark:text-gray-400">
            <p class="pt-5">&copy; Thomas Wills 2023</p>
        </div>
        <div class="flex flex-row justify-evenly dark:text-bg-200 m-2 text-start">
            <ul class="justify-left">
                <li>
                    <a class="dark:text-gray-400 text-s" href="{{route('static.contact')}}">Contact Us</a>
                </li>
                <li>
                    <a class="dark:text-gray-400 text-s" href="{{route('static.terms')}}">Terms & Conditions</a>
                </li>
                <li>
                    <a class="dark:text-gray-400 text-s" href="{{route('static.privacy')}}">Privacy Policy</a>
                </li>
                <li>
                    <a class="dark:text-gray-400 text-s" href="{{route('static.colours')}}">Colours</a>
                </li>
                <li>
                    <a class="dark:text-gray-400 text-s" href="{{route('static.icons')}}">Icons</a>
                </li>
            </ul>
        </div>
    </div>
</footer>
</html>
