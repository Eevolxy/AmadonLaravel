<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Amadon — Ta marketplace e-commerce moderne.">
    <title>@yield('title', 'Amadon') — Amadon</title>
    <script src="https://kit.fontawesome.com/3d888d57a7.js" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex flex-col min-h-screen bg-gray-50 text-gray-900">
    @include('layouts.header')

    @yield('content')

    @include('layouts.footer')

    @livewireScripts
</body>
</html>
