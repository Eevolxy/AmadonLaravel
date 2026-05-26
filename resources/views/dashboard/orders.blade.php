@extends('layouts.app')

@section('title', 'Mes commandes')

@section('content')
    <main class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-black text-gray-900">
                <i class="fa-solid fa-receipt text-cyan-600"></i> Mes commandes
            </h1>
            <a href="{{ route('dashboard.index') }}" class="text-sm text-gray-500 hover:text-cyan-600 transition">
                <i class="fa-solid fa-arrow-left"></i> Retour au dashboard
            </a>
        </div>

        @if ($orders->isEmpty())
            <div class="text-center py-20 bg-white rounded-2xl shadow-sm ring-1 ring-gray-200">
                <i class="fa-solid fa-box-open text-6xl text-gray-300 mb-6"></i>
                <h2 class="text-2xl font-bold text-gray-600 mb-2">Aucune commande</h2>
                <p class="text-gray-400 mb-8">Tu n'as pas encore passé de commande.</p>
                <a href="{{ route('products') }}" class="inline-flex items-center gap-2 rounded-2xl bg-gray-900 px-7 py-3.5 text-sm font-bold text-white hover:bg-cyan-600 transition">
                    <i class="fa-solid fa-box"></i> Voir les produits
                </a>
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-sm ring-1 ring-gray-200 overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-left text-gray-500 uppercase tracking-wider text-xs">
                        <tr>
                            <th class="px-6 py-3">N°</th>
                            <th class="px-6 py-3">Date</th>
                            <th class="px-6 py-3">Articles</th>
                            <th class="px-6 py-3">Total</th>
                            <th class="px-6 py-3">Statut</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($orders as $order)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-bold text-gray-900">#{{ $order->id }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $order->items->count() }} article(s)</td>
                                <td class="px-6 py-4 font-bold text-gray-900">{{ number_format($order->total, 2, ',', ' ') }} €</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $order->status_color }}">
                                        {{ $order->status_label }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('dashboard.orders.show', $order) }}" class="text-cyan-600 hover:text-cyan-500 font-medium">
                                        Détails <i class="fa-solid fa-arrow-right ml-1"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $orders->links() }}
            </div>
        @endif
    </main>
@endsection
