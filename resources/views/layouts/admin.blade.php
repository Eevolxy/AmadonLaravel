<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — Amadon Admin</title>
    <script src="https://kit.fontawesome.com/3d888d57a7.js" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen bg-gray-100">
    {{-- Sidebar --}}
    <aside class="w-64 bg-gray-900 text-white flex flex-col shrink-0">
        <div class="p-6 border-b border-gray-800">
            <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold">
                <i class="fa-solid fa-angles-up text-cyan-400"></i> Amadon
            </a>
            <p class="text-xs text-gray-400 mt-1">Administration</p>
        </div>

        <nav class="flex-1 p-4 space-y-1">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition
                      {{ request()->routeIs('admin.dashboard') ? 'bg-cyan-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                <i class="fa-solid fa-chart-pie w-5 text-center"></i> Tableau de bord
            </a>
            <a href="{{ route('admin.products.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition
                      {{ request()->routeIs('admin.products.*') ? 'bg-cyan-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                <i class="fa-solid fa-box w-5 text-center"></i> Produits
            </a>
            <a href="{{ route('admin.orders.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition
                      {{ request()->routeIs('admin.orders.*') ? 'bg-cyan-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                <i class="fa-solid fa-receipt w-5 text-center"></i> Commandes
            </a>
            <a href="{{ route('admin.coupons.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition
                      {{ request()->routeIs('admin.coupons.*') ? 'bg-cyan-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                <i class="fa-solid fa-ticket w-5 text-center"></i> Coupons
            </a>
        </nav>

        <div class="p-4 border-t border-gray-800">
            <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm text-gray-400 hover:bg-gray-800 hover:text-white transition">
                <i class="fa-solid fa-arrow-left w-5 text-center"></i> Retour au site
            </a>
        </div>
    </aside>

    {{-- Main content --}}
    <div class="flex-1 flex flex-col">
        <header class="bg-white border-b border-gray-200 px-8 py-4 flex items-center justify-between">
            <h1 class="text-xl font-bold text-gray-800">@yield('page-title', 'Administration')</h1>
            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-500">{{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-sm text-gray-400 hover:text-red-500 transition cursor-pointer">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>
            </div>
        </header>

        <main class="flex-1 p-8">
            @if (session('success'))
                <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-3 text-sm text-green-700 font-medium">
                    <i class="fa-solid fa-check-circle mr-1"></i> {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-3 text-sm text-red-700 font-medium">
                    <i class="fa-solid fa-circle-exclamation mr-1"></i> {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
