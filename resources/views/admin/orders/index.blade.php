@extends('layouts.admin')

@section('title', 'Commandes')
@section('page-title', 'Gestion des commandes')

@section('content')
    {{-- Status Filters --}}
    <div class="flex items-center gap-3 mb-6 flex-wrap">
        <a href="{{ route('admin.orders.index') }}"
           class="px-4 py-2 rounded-xl text-sm font-medium transition {{ !request('status') ? 'bg-cyan-600 text-white' : 'bg-white text-gray-600 ring-1 ring-gray-200 hover:bg-gray-50' }}">
            Toutes
        </a>
        @foreach (['pending' => 'En attente', 'processing' => 'En cours', 'completed' => 'Terminées', 'cancelled' => 'Annulées'] as $status => $label)
            <a href="{{ route('admin.orders.index', ['status' => $status]) }}"
               class="px-4 py-2 rounded-xl text-sm font-medium transition {{ request('status') === $status ? 'bg-cyan-600 text-white' : 'bg-white text-gray-600 ring-1 ring-gray-200 hover:bg-gray-50' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    <div class="bg-white rounded-2xl shadow-sm ring-1 ring-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-left text-gray-500 uppercase tracking-wider text-xs">
                <tr>
                    <th class="px-6 py-3">N°</th>
                    <th class="px-6 py-3">Client</th>
                    <th class="px-6 py-3">Total</th>
                    <th class="px-6 py-3">Statut</th>
                    <th class="px-6 py-3">Date</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($orders as $order)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-bold text-gray-900">#{{ $order->id }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $order->user->name }}</td>
                        <td class="px-6 py-4 font-bold text-gray-900">{{ number_format($order->total, 2, ',', ' ') }} €</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $order->status_color }}">
                                {{ $order->status_label }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-500">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.orders.show', $order) }}" class="text-cyan-600 hover:text-cyan-500 font-medium">
                                Voir <i class="fa-solid fa-arrow-right ml-1"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-400">Aucune commande.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $orders->links() }}</div>
@endsection
