@extends('layouts.app')

@section('title', 'Commande #' . $order->id)

@section('content')
    <main class="max-w-5xl mx-auto px-6 py-12">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-black text-gray-900">Commande #{{ $order->id }}</h1>
                <p class="text-gray-500 mt-1">Passée le {{ $order->created_at->format('d/m/Y à H:i') }}</p>
            </div>
            <a href="{{ route('dashboard.orders') }}" class="text-sm text-gray-500 hover:text-cyan-600 transition">
                <i class="fa-solid fa-arrow-left"></i> Retour aux commandes
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Items --}}
            <div class="lg:col-span-2 space-y-4">
                @foreach ($order->items as $item)
                    <div class="flex gap-4 bg-white rounded-2xl p-5 shadow-sm ring-1 ring-gray-200">
                        <div class="w-20 h-20 rounded-xl overflow-hidden bg-gray-100 shrink-0">
                            <img src="{{ $item->article->image }}" alt="{{ $item->article->titre }}" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-gray-900">{{ $item->article->titre }}</h3>
                            <p class="text-sm text-gray-500">Quantité : {{ $item->quantity }}</p>
                            <p class="text-sm text-gray-500">Prix unitaire : {{ number_format($item->price, 2, ',', ' ') }} €</p>
                        </div>
                        <div class="text-right">
                            <p class="font-black text-gray-900 text-lg">{{ number_format($item->subtotal, 2, ',', ' ') }} €</p>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Order Summary --}}
            <div>
                <div class="bg-white rounded-2xl p-6 shadow-sm ring-1 ring-gray-200 sticky top-8">
                    <h2 class="text-lg font-bold text-gray-900 mb-5">Détails</h2>

                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Statut</span>
                            <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $order->status_color }}">
                                {{ $order->status_label }}
                            </span>
                        </div>

                        @if ($order->coupon)
                            <div class="flex justify-between">
                                <span class="text-gray-500">Coupon</span>
                                <span class="font-medium text-gray-900">{{ $order->coupon->code }}</span>
                            </div>
                            <div class="flex justify-between text-green-600">
                                <span>Réduction</span>
                                <span class="font-bold">-{{ number_format($order->discount_amount, 2, ',', ' ') }} €</span>
                            </div>
                        @endif

                        <div class="border-t border-gray-200 pt-3 flex justify-between text-base">
                            <span class="font-bold text-gray-900">Total payé</span>
                            <span class="font-black text-gray-900 text-xl">{{ number_format($order->total, 2, ',', ' ') }} €</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
