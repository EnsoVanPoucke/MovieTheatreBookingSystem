<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Movies</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen">
        <div class="bg-cyan-500">
            @include('components.mainheader')
        </div>
        <div class="bg-cyan-900">
            @livewire('banner-carousel')
        </div>
        <main class="bg-gray-100">
            @yield('content')
        </main>
    </div>
</body>

</html>