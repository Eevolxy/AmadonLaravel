<header class="bg-gray-800 text-white py-4 px-10 flex justify-between items-center">
    <a href="{{ route('home') }}" class="hover:cursor-pointer text-3xl font-bold">
        <i class="fa-solid fa-angles-up text-cyan-300"></i>
        Amadon
    </a>
    @if (!request()->routeIs("login", "register"))
    <nav class="text-gray-800 text-xl bg-gray-100 px-15 py-2 rounded-full">
        <ul class="flex gap-10 *:hover:bg-gray-800 *:hover:text-white *:rounded-full
        *:px-5 *:transition-color *:duration-300">
        <li><a href="{{ route('products') }}">
            <i class="fa-solid fa-box"></i>
            Produits
        </a></li>
        <li><a href="{{ route('contact.index') }}">
            <i class="fa-solid fa-envelope"></i>
            Nous contacter
        </a></li>
        <li><a href="{{ route('cart.index') }}">
                <i class="fa-solid fa-basket-shopping"></i>
                Panier
                @php
                    $cartCount = 0;
                    if (auth()->check()) {
                        $userCart = auth()->user()->cart;
                        if ($userCart) $cartCount = $userCart->items->sum('quantity');
                    } else {
                        $sessionCart = \App\Models\Cart::where('session_id', session()->getId())->first();
                        if ($sessionCart) $cartCount = $sessionCart->items->sum('quantity');
                    }
                @endphp
                @if ($cartCount > 0)
                    <span class="bg-cyan-400 text-gray-900 text-xs font-bold px-2 py-0.5 rounded-full ml-1">{{ $cartCount }}</span>
                @endif
            </a></li>
        </ul>
    </nav>
    @endif
    <div class="flex gap-5 items-center">
        @auth
            @if (auth()->user()->is_admin)
                <a href="{{ route('admin.dashboard') }}" class="text-cyan-300 hover:text-cyan-400 transition">
                    <i class="fa-solid fa-gear"></i> Admin
                </a>
            @endif
            <a href="{{ route('dashboard.index') }}" class="hover:text-cyan-300 transition">
                <i class="fa-solid fa-user"></i> {{ auth()->user()->name }}
            </a>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="hover:text-red-400 transition cursor-pointer">
                    <i class="fa-solid fa-right-from-bracket"></i> Déconnexion
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="hover:text-cyan-300 transition">Connexion</a>
            <a href="{{ route('register') }}" class="hover:text-cyan-300 transition">Inscription</a>
        @endauth
    </div>
</header>
