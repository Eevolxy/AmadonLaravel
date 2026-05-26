@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Tableau de bord')

@section('content')
    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        <div class="bg-white rounded-2xl p-6 shadow-sm ring-1 ring-gray-200">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-cyan-50 flex items-center justify-center text-cyan-600">
                    <i class="fa-solid fa-box text-xl"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-gray-900">{{ $stats['totalProducts'] }}</p>
                    <p class="text-sm text-gray-500">Produits</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-sm ring-1 ring-gray-200">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-yellow-50 flex items-center justify-center text-yellow-600">
                    <i class="fa-solid fa-receipt text-xl"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-gray-900">{{ $stats['totalOrders'] }}</p>
                    <p class="text-sm text-gray-500">Commandes ({{ $stats['pendingOrders'] }} en attente)</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-sm ring-1 ring-gray-200">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center text-green-600">
                    <i class="fa-solid fa-coins text-xl"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-gray-900">{{ number_format($stats['totalRevenue'], 2, ',', ' ') }} €</p>
                    <p class="text-sm text-gray-500">Revenus totaux</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-sm ring-1 ring-gray-200">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center text-purple-600">
                    <i class="fa-solid fa-users text-xl"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-gray-900">{{ $stats['totalUsers'] }}</p>
                    <p class="text-sm text-gray-500">Utilisateurs</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-sm ring-1 ring-gray-200">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-pink-50 flex items-center justify-center text-pink-600">
                    <i class="fa-solid fa-ticket text-xl"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-gray-900">{{ $stats['activeCoupons'] }}</p>
                    <p class="text-sm text-gray-500">Coupons actifs</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Orders --}}
    <div class="bg-white rounded-2xl shadow-sm ring-1 ring-gray-200 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-900">Dernières commandes</h2>
            <a href="{{ route('admin.orders.index') }}" class="text-sm text-cyan-600 font-semibold hover:text-cyan-500 transition">
                Voir tout <i class="fa-solid fa-arrow-right ml-1"></i>
            </a>
        </div>
        @if ($recentOrders->isEmpty())
            <div class="px-6 py-10 text-center text-gray-400">Aucune commande.</div>
        @else
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-left text-gray-500 uppercase tracking-wider text-xs">
                    <tr>
                        <th class="px-6 py-3">N°</th>
                        <th class="px-6 py-3">Client</th>
                        <th class="px-6 py-3">Total</th>
                        <th class="px-6 py-3">Statut</th>
                        <th class="px-6 py-3">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($recentOrders as $order)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-bold text-gray-900">
                                <a href="{{ route('admin.orders.show', $order) }}" class="hover:text-cyan-600">#{{ $order->id }}</a>
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $order->user->name }}</td>
                            <td class="px-6 py-4 font-bold text-gray-900">{{ number_format($order->total, 2, ',', ' ') }} €</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $order->status_color }}">
                                    {{ $order->status_label }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-500">{{ $order->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
