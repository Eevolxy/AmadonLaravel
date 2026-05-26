@extends('layouts.app')

@section('title', $article->titre)

@section('content')
    <main class="max-w-7xl mx-auto px-6 py-12">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-8">
            <a href="{{ route('home') }}" class="hover:text-cyan-600 transition">Accueil</a>
            <i class="fa-solid fa-chevron-right text-xs"></i>
            <a href="{{ route('products') }}" class="hover:text-cyan-600 transition">Produits</a>
            <i class="fa-solid fa-chevron-right text-xs"></i>
            <span class="text-gray-900 font-medium">{{ $article->titre }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            {{-- Product Image --}}
            <div class="rounded-3xl overflow-hidden bg-gray-100 shadow-lg ring-1 ring-gray-200">
                <img src="{{ $article->image }}" alt="{{ $article->titre }}"
                     class="w-full h-full object-cover aspect-square">
            </div>

            {{-- Product Info --}}
            <div class="flex flex-col justify-center">
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-cyan-600">{{ $article->categorie }}</p>
                <h1 class="mt-3 text-4xl font-black text-gray-900 leading-tight">{{ $article->titre }}</h1>

                {{-- Rating --}}
                <div class="mt-4 flex items-center gap-3">
                    <div class="text-yellow-500 text-lg">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fa-{{ $i <= $article->note ? 'solid' : 'regular' }} fa-star"></i>
                        @endfor
                    </div>
                    <span class="text-sm text-gray-500 font-medium">{{ $article->note }} / 5</span>
                </div>

                {{-- Price --}}
                <p class="mt-6 text-4xl font-black text-gray-900">
                    {{ number_format($article->prix, 2, ',', ' ') }} <span class="text-2xl">€</span>
                </p>

                {{-- Description --}}
                <div class="mt-6 text-gray-600 leading-7">
                    {{ $article->description }}
                </div>

                {{-- Add to Cart --}}
                <form action="{{ route('cart.add') }}" method="POST" class="mt-8 flex items-end gap-4">
                    @csrf
                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                    <div class="space-y-2">
                        <label for="quantity" class="block text-sm font-semibold text-gray-700">Quantité</label>
                        <input type="number" name="quantity" id="quantity" value="1" min="1" max="99"
                               class="w-24 rounded-xl border border-gray-200 px-4 py-3 text-center text-gray-900 font-bold outline-none focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100 transition">
                    </div>
                    <button type="submit"
                            class="flex-1 inline-flex items-center justify-center gap-3 rounded-2xl bg-gray-900 px-7 py-3.5 text-sm font-bold text-white transition hover:-translate-y-0.5 hover:bg-cyan-600 hover:shadow-lg hover:shadow-cyan-500/25 cursor-pointer">
                        <i class="fa-solid fa-cart-plus"></i> Ajouter au panier
                    </button>
                </form>

                {{-- Meta Info --}}
                <div class="mt-8 grid grid-cols-2 gap-4">
                    <div class="flex items-center gap-3 rounded-xl bg-gray-50 p-4 ring-1 ring-gray-200">
                        <i class="fa-solid fa-truck text-cyan-600"></i>
                        <span class="text-sm text-gray-600">Livraison rapide</span>
                    </div>
                    <div class="flex items-center gap-3 rounded-xl bg-gray-50 p-4 ring-1 ring-gray-200">
                        <i class="fa-solid fa-shield-halved text-cyan-600"></i>
                        <span class="text-sm text-gray-600">Paiement sécurisé</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Related Products --}}
        @if ($relatedArticles->isNotEmpty())
            <section class="mt-20">
                <h2 class="text-2xl font-black text-gray-900 mb-8">Produits similaires</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($relatedArticles as $related)
                        <a href="{{ route('products.show', $related) }}"
                           class="group bg-white rounded-2xl shadow-sm ring-1 ring-gray-200 overflow-hidden transition hover:-translate-y-1 hover:shadow-lg">
                            <div class="aspect-square bg-gray-100 overflow-hidden">
                                <img src="{{ $related->image }}" alt="{{ $related->titre }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            </div>
                            <div class="p-5">
                                <p class="text-xs font-semibold text-cyan-600 uppercase tracking-wider">{{ $related->categorie }}</p>
                                <h3 class="mt-1 font-bold text-gray-900 truncate">{{ $related->titre }}</h3>
                                <span class="text-lg font-black text-gray-900">{{ number_format($related->prix, 2, ',', ' ') }} €</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </main>
@endsection
