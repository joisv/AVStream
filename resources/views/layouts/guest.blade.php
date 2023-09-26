<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {!! SEO::generate(true) !!}

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-background">

            <div class="w-full sm:max-w-2xl flex-col-reverse flex sm:flex sm:flex-row sm:items-center sm:justify-between mt-6 sm:space-x-4 p-4 sm:p-0 space-y-10 sm:space-y-0 overflow-hidden">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
