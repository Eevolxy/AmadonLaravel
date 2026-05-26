@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
    {{-- Hero Section --}}
    <section class="relative bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-0 right-0 w-96 h-96 bg-cyan-500 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-80 h-80 bg-purple-500 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-6 py-24 lg:py-32 flex flex-col items-center text-center">
            <span class="inline-flex items-center gap-2 rounded-full bg-cyan-400/10 px-5 py-1.5 text-sm font-semibold text-cyan-300 ring-1 ring-cyan-300/20 mb-6">
                <i class="fa-solid fa-rainbow"></i> Bienvenue sur Amadon
            </span>
            <h1 class="text-4xl md:text-6xl font-black leading-tight max-w-3xl">
                Découvre les meilleurs produits au <span class="text-cyan-400">meilleur prix</span>.
            </h1>
            <p class="mt-6 text-lg text-gray-300 max-w-2xl leading-relaxed">
                Parcours notre catalogue, ajoute tes articles favoris au panier et profite d'offres exclusives avec nos codes promo.
            </p>
            <div class="mt-10 flex flex-wrap gap-4 justify-center">
                <a href="{{ route('products') }}"
                   class="inline-flex items-center gap-3 rounded-2xl bg-cyan-500 px-7 py-3.5 text-sm font-bold text-white transition hover:-translate-y-0.5 hover:bg-cyan-400 hover:shadow-lg hover:shadow-cyan-500/25">
                    <i class="fa-solid fa-box"></i> Voir les produits
                </a>
                <a href="{{ route('contact.index') }}"
                   class="inline-flex items-center gap-3 rounded-2xl bg-white/10 px-7 py-3.5 text-sm font-bold text-white ring-1 ring-white/20 transition hover:-translate-y-0.5 hover:bg-white/20">
                    <i class="fa-solid fa-envelope"></i> Nous contacter
                </a>
            </div>
        </div>
    </section>

    {{-- Categories Section --}}
    @if ($categories->isNotEmpty())
    <section class="max-w-7xl mx-auto px-6 py-16">
        <div class="text-center mb-10">
            <p class="text-sm font-semibold uppercase tracking-[0.28em] text-cyan-700">Explore</p>
            <h2 class="text-3xl font-black text-gray-900 mt-2">Nos catégories</h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($categories as $cat)
                <a href="{{ route('products', ['categorie' => $cat]) }}"
                   class="group flex flex-col items-center justify-center gap-3 rounded-2xl bg-white p-8 shadow-sm ring-1 ring-gray-200 transition hover:-translate-y-1 hover:shadow-lg hover:ring-cyan-300">
                    <div class="flex items-center justify-center w-14 h-14 rounded-full bg-cyan-50 text-cyan-600 group-hover:bg-cyan-100 transition">
                        <i class="fa-solid fa-tag text-xl"></i>
                    </div>
                    <span class="font-bold text-gray-800 capitalize">{{ $cat }}</span>
                </a>
            @endforeach
        </div>
    </section>
    @endif

    {{-- Promo / Featured Products --}}
    @if ($promoArticles->isNotEmpty())
    <section class="bg-gray-100 py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-10">
                <p class="text-sm font-semibold uppercase tracking-[0.28em] text-cyan-700">Offres spéciales</p>
                <h2 class="text-3xl font-black text-gray-900 mt-2">Nos meilleurs prix</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($promoArticles as $article)
                    <a href="{{ route('products.show', $article) }}"
                       class="group bg-white rounded-2xl shadow-sm ring-1 ring-gray-200 overflow-hidden transition hover:-translate-y-1 hover:shadow-lg">
                        <div class="aspect-square bg-gray-100 overflow-hidden">
                            <img src="{{ $article->image }}" alt="{{ $article->titre }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </div>
                        <div class="p-5">
                            <p class="text-xs font-semibold text-cyan-600 uppercase tracking-wider">{{ $article->categorie }}</p>
                            <h3 class="mt-1 font-bold text-gray-900 truncate">{{ $article->titre }}</h3>
                            <div class="mt-2 flex items-center justify-between">
                                <span class="text-lg font-black text-gray-900">{{ number_format($article->prix, 2, ',', ' ') }} €</span>
                                <span class="text-yellow-500 text-sm font-semibold">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fa-{{ $i <= $article->note ? 'solid' : 'regular' }} fa-star"></i>
                                    @endfor
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Featured Products Grid --}}
    @if ($featuredArticles->isNotEmpty())
    <section class="max-w-7xl mx-auto px-6 py-16">
        <div class="text-center mb-10">
            <p class="text-sm font-semibold uppercase tracking-[0.28em] text-cyan-700">Catalogue</p>
            <h2 class="text-3xl font-black text-gray-900 mt-2">Produits à découvrir</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($featuredArticles as $article)
                <a href="{{ route('products.show', $article) }}"
                   class="group bg-white rounded-2xl shadow-sm ring-1 ring-gray-200 overflow-hidden transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="aspect-square bg-gray-100 overflow-hidden">
                        <img src="{{ $article->image }}" alt="{{ $article->titre }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    </div>
                    <div class="p-5">
                        <p class="text-xs font-semibold text-cyan-600 uppercase tracking-wider">{{ $article->categorie }}</p>
                        <h3 class="mt-1 font-bold text-gray-900 truncate">{{ $article->titre }}</h3>
                        <div class="mt-2 flex items-center justify-between">
                            <span class="text-lg font-black text-gray-900">{{ number_format($article->prix, 2, ',', ' ') }} €</span>
                            <span class="text-yellow-500 text-sm font-semibold">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fa-{{ $i <= $article->note ? 'solid' : 'regular' }} fa-star"></i>
                                @endfor
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('products') }}" class="inline-flex items-center gap-2 text-cyan-700 font-semibold hover:text-cyan-500 transition">
                Voir tous les produits <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </section>
    @endif
@endsection