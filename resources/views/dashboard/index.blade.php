@extends('layouts.app')

@section('title', 'Mon compte')

@section('content')
    <main class="max-w-7xl mx-auto px-6 py-12">
        <div class="mb-10">
            <h1 class="text-3xl font-black text-gray-900">
                <i class="fa-solid fa-user text-cyan-600"></i> Bonjour, {{ $user->name }} !
            </h1>
            <p class="text-gray-500 mt-2">Voici un résumé de ton activité sur Amadon.</p>
        </div>

        @if (session('success'))
            <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-3 text-sm text-green-700 font-medium">
                <i class="fa-solid fa-check-circle mr-1"></i> {{ session('success') }}
            </div>
        @endif

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-12">
            <div class="bg-white rounded-2xl p-6 shadow-sm ring-1 ring-gray-200">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-cyan-50 flex items-center justify-center text-cyan-600">
                        <i class="fa-solid fa-receipt text-xl"></i>
                    </div>
                    <div>
                        <p class="text-2xl font-black text-gray-900">{{ $totalOrders }}</p>
                        <p class="text-sm text-gray-500">Commandes</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-sm ring-1 ring-gray-200">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center text-green-600">
                        <i class="fa-solid fa-coins text-xl"></i>
                    </div>
                    <div>
                        <p class="text-2xl font-black text-gray-900">{{ number_format($totalSpent, 2, ',', ' ') }} €</p>
                        <p class="text-sm text-gray-500">Total dépensé</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-sm ring-1 ring-gray-200">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center text-purple-600">
                        <i class="fa-solid fa-envelope text-xl"></i>
                    </div>
                    <div>
                        <p class="text-2xl font-black text-gray-900">{{ $user->email }}</p>
                        <p class="text-sm text-gray-500">Adresse email</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Recent Orders --}}
        <div class="bg-white rounded-2xl shadow-sm ring-1 ring-gray-200 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200 flex items-center justify-between">
                <h2 class="text-lg font-bold text-gray-900">Dernières commandes</h2>
                <a href="{{ route('dashboard.orders') }}" class="text-sm text-cyan-600 font-semibold hover:text-cyan-500 transition">
                    Voir tout <i class="fa-solid fa-arrow-right ml-1"></i>
                </a>
            </div>
            @if ($recentOrders->isEmpty())
                <div class="px-6 py-10 text-center text-gray-400">
                    <i class="fa-solid fa-box-open text-3xl mb-3"></i>
                    <p>Aucune commande pour l'instant.</p>
                </div>
            @else
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-left text-gray-500 uppercase tracking-wider text-xs">
                        <tr>
                            <th class="px-6 py-3">N°</th>
                            <th class="px-6 py-3">Date</th>
                            <th class="px-6 py-3">Total</th>
                            <th class="px-6 py-3">Statut</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($recentOrders as $order)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-bold text-gray-900">#{{ $order->id }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $order->created_at->format('d/m/Y H:i') }}</td>
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
            @endif
        </div>
    </main>
@endsection
