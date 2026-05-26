<footer class="bg-gray-900 text-gray-300 mt-auto">
    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <div>
                <a href="{{ route('home') }}" class="text-2xl font-bold text-white">
                    <i class="fa-solid fa-angles-up text-cyan-400"></i> Amadon
                </a>
                <p class="mt-4 text-sm leading-6 text-gray-400">
                    Ta marketplace e-commerce moderne. Découvre des produits de qualité et profite d'une expérience d'achat fluide.
                </p>
            </div>
            <div>
                <h4 class="text-sm font-semibold uppercase tracking-wider text-white mb-4">Navigation</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-cyan-400 transition">Accueil</a></li>
                    <li><a href="{{ route('products') }}" class="hover:text-cyan-400 transition">Produits</a></li>
                    <li><a href="{{ route('contact.index') }}" class="hover:text-cyan-400 transition">Contact</a></li>
                    <li><a href="{{ route('cart.index') }}" class="hover:text-cyan-400 transition">Panier</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-sm font-semibold uppercase tracking-wider text-white mb-4">Mon Compte</h4>
                <ul class="space-y-2 text-sm">
                    @auth
                        <li><a href="{{ route('dashboard.index') }}" class="hover:text-cyan-400 transition">Tableau de bord</a></li>
                        <li><a href="{{ route('dashboard.orders') }}" class="hover:text-cyan-400 transition">Mes commandes</a></li>
                    @else
                        <li><a href="{{ route('login') }}" class="hover:text-cyan-400 transition">Connexion</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-cyan-400 transition">Inscription</a></li>
                    @endauth
                </ul>
            </div>
        </div>
        <div class="mt-10 border-t border-gray-800 pt-6 text-center text-xs text-gray-500">
            &copy; {{ date('Y') }} Amadon. Tous droits réservés.
        </div>
    </div>
</footer>
