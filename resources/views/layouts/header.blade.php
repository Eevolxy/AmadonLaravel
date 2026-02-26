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
        <li><a href="#">
            <i class="fa-solid fa-envelope"></i>
            Nous contacter
        </a></li>
        <li><a href="#">
                <i class="fa-solid fa-basket-shopping"></i>
                Panier
            </a></li>
        </ul>
    </nav>
    @endif
    <div class="flex gap-5">
        <a href="{{ route('login') }}">Connexion</a>
        <a href="#">Inscription</a>
    </div>
</header>
