<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full no-scrollbar">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="robots" content="index, follow">

        <title>{{ config('app.name', 'PTQ Web') }}</title>

        <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo-ptq.svg') }}">
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @routes
        @vite(['resources/js/app.js', "resources/js/pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased h-full bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 selection:bg-emerald-500 selection:text-whiter">
        @inertia
    </body>
</html>