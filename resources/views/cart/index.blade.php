@extends('layouts.app')

@section('title', 'Mon panier')

@section('content')
    <main class="max-w-7xl mx-auto px-6 py-12">
        <h1 class="text-3xl font-black text-gray-900 mb-8">
            <i class="fa-solid fa-basket-shopping text-cyan-600"></i> Mon panier
        </h1>

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

        @if ($cart->items->isEmpty())
            <div class="text-center py-20">
                <i class="fa-solid fa-cart-shopping text-6xl text-gray-300 mb-6"></i>
                <h2 class="text-2xl font-bold text-gray-600 mb-2">Ton panier est vide</h2>
                <p class="text-gray-400 mb-8">Ajoute des produits pour commencer tes achats.</p>
                <a href="{{ route('products') }}" class="inline-flex items-center gap-2 rounded-2xl bg-gray-900 px-7 py-3.5 text-sm font-bold text-white hover:bg-cyan-600 transition">
                    <i class="fa-solid fa-box"></i> Voir les produits
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Cart Items --}}
                <div class="lg:col-span-2 space-y-4">
                    @foreach ($cart->items as $item)
                        <div class="flex gap-5 bg-white rounded-2xl p-5 shadow-sm ring-1 ring-gray-200">
                            <div class="w-28 h-28 rounded-xl overflow-hidden bg-gray-100 shrink-0">
                                <img src="{{ $item->article->image }}" alt="{{ $item->article->titre }}"
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1 flex flex-col justify-between">
                                <div>
                                    <a href="{{ route('products.show', $item->article) }}" class="font-bold text-gray-900 hover:text-cyan-600 transition">
                                        {{ $item->article->titre }}
                                    </a>
                                    <p class="text-sm text-gray-500 mt-0.5">{{ $item->article->categorie }}</p>
                                </div>
                                <div class="flex items-center justify-between mt-3">
                                    <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="99"
                                               class="w-20 rounded-lg border border-gray-200 px-3 py-2 text-center text-sm font-bold outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100">
                                        <button type="submit" class="text-cyan-600 hover:text-cyan-700 text-sm font-medium cursor-pointer">
                                            <i class="fa-solid fa-arrows-rotate"></i>
                                        </button>
                                    </form>
                                    <span class="font-black text-gray-900 text-lg">{{ number_format($item->subtotal, 2, ',', ' ') }} €</span>
                                    <form action="{{ route('cart.remove', $item) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-600 transition cursor-pointer">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Order Summary --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl p-6 shadow-sm ring-1 ring-gray-200 sticky top-8">
                        <h2 class="text-lg font-bold text-gray-900 mb-5">Récapitulatif</h2>

                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Sous-total</span>
                                <span class="font-bold text-gray-900">{{ number_format($cart->total, 2, ',', ' ') }} €</span>
                            </div>

                            @if ($coupon)
                                <div class="flex justify-between text-green-600">
                                    <span>Coupon ({{ $coupon['code'] }})</span>
                                    <span class="font-bold">-{{ number_format($coupon['discount'], 2, ',', ' ') }} €</span>
                                </div>
                                <form action="{{ route('cart.coupon.remove') }}" method="POST" class="text-right">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs text-red-400 hover:text-red-600 cursor-pointer">Retirer le coupon</button>
                                </form>
                            @endif

                            <div class="border-t border-gray-200 pt-3 flex justify-between text-base">
                                <span class="font-bold text-gray-900">Total</span>
                                <span class="font-black text-gray-900 text-xl">
                                    {{ number_format(max(0, $cart->total - ($coupon['discount'] ?? 0)), 2, ',', ' ') }} €
                                </span>
                            </div>
                        </div>

                        {{-- Coupon Input --}}
                        @if (!$coupon)
                            <form action="{{ route('cart.coupon') }}" method="POST" class="mt-5">
                                @csrf
                                <div class="flex gap-2">
                                    <input type="text" name="coupon_code" placeholder="Code promo"
                                           class="flex-1 rounded-xl border border-gray-200 px-4 py-2.5 text-sm outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100">
                                    <button type="submit"
                                            class="rounded-xl bg-gray-100 px-4 py-2.5 text-sm font-bold text-gray-700 hover:bg-gray-200 transition cursor-pointer">
                                        Appliquer
                                    </button>
                                </div>
                            </form>
                        @endif

                        {{-- Checkout Button --}}
                        @auth
                            <a href="{{ route('checkout.index') }}"
                               class="mt-5 w-full inline-flex items-center justify-center gap-3 rounded-2xl bg-gray-900 px-5 py-3.5 text-sm font-bold text-white transition hover:-translate-y-0.5 hover:bg-cyan-600 hover:shadow-lg">
                                <i class="fa-solid fa-lock"></i> Valider la commande
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                               class="mt-5 w-full inline-flex items-center justify-center gap-3 rounded-2xl bg-gray-900 px-5 py-3.5 text-sm font-bold text-white transition hover:-translate-y-0.5 hover:bg-cyan-600 hover:shadow-lg">
                                <i class="fa-solid fa-right-to-bracket"></i> Se connecter pour commander
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        @endif
    </main>
@endsection
