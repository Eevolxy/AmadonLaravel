<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amadon</title>
    <script src="https://kit.fontawesome.com/3d888d57a7.js" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex flex-col">
    @include('layouts.header')

    @yield('content')

    @livewireScripts
</body>
</html>
