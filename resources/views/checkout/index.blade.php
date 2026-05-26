@extends('layouts.app')

@section('title', 'Validation de commande')

@section('content')
    <main class="max-w-4xl mx-auto px-6 py-12">
        <h1 class="text-3xl font-black text-gray-900 mb-8">
            <i class="fa-solid fa-lock text-cyan-600"></i> Validation de la commande
        </h1>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
            {{-- Order Items --}}
            <div class="lg:col-span-3 space-y-4">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Résumé de ta commande</h2>
                @foreach ($cart->items as $item)
                    <div class="flex gap-4 bg-white rounded-2xl p-4 shadow-sm ring-1 ring-gray-200">
                        <div class="w-20 h-20 rounded-xl overflow-hidden bg-gray-100 shrink-0">
                            <img src="{{ $item->article->image }}" alt="{{ $item->article->titre }}" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-gray-900">{{ $item->article->titre }}</h3>
                            <p class="text-sm text-gray-500">Quantité : {{ $item->quantity }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-black text-gray-900">{{ number_format($item->subtotal, 2, ',', ' ') }} €</p>
                            <p class="text-xs text-gray-400">{{ number_format($item->article->prix, 2, ',', ' ') }} € / unité</p>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Payment Summary --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl p-6 shadow-sm ring-1 ring-gray-200 sticky top-8">
                    <h2 class="text-lg font-bold text-gray-900 mb-5">Total à payer</h2>

                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Sous-total</span>
                            <span class="font-bold">{{ number_format($subtotal, 2, ',', ' ') }} €</span>
                        </div>
                        @if ($coupon)
                            <div class="flex justify-between text-green-600">
                                <span>Réduction ({{ $coupon['code'] }})</span>
                                <span class="font-bold">-{{ number_format($discount, 2, ',', ' ') }} €</span>
                            </div>
                        @endif
                        <div class="border-t border-gray-200 pt-3 flex justify-between text-base">
                            <span class="font-bold text-gray-900">Total</span>
                            <span class="font-black text-gray-900 text-2xl">{{ number_format($total, 2, ',', ' ') }} €</span>
                        </div>
                    </div>

                    <form action="{{ route('checkout.store') }}" method="POST" class="mt-6">
                        @csrf
                        <button type="submit"
                                class="w-full inline-flex items-center justify-center gap-3 rounded-2xl bg-green-600 px-5 py-4 text-sm font-bold text-white transition hover:-translate-y-0.5 hover:bg-green-500 hover:shadow-lg hover:shadow-green-500/25 cursor-pointer">
                            <i class="fa-solid fa-check"></i> Confirmer la commande
                        </button>
                    </form>

                    <a href="{{ route('cart.index') }}" class="mt-3 w-full inline-flex items-center justify-center gap-2 text-sm text-gray-500 hover:text-gray-700 transition">
                        <i class="fa-solid fa-arrow-left"></i> Retour au panier
                    </a>
                </div>
            </div>
        </div>
    </main>
@endsection
