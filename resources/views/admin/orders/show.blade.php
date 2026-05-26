@extends('layouts.admin')

@section('title', 'Commande #' . $order->id)
@section('page-title', 'Commande #' . $order->id)

@section('content')
    <a href="{{ route('admin.orders.index') }}" class="text-sm text-gray-500 hover:text-cyan-600 transition mb-6 inline-block">
        <i class="fa-solid fa-arrow-left"></i> Retour aux commandes
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Items --}}
        <div class="lg:col-span-2 space-y-4">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Articles commandés</h2>
            @foreach ($order->items as $item)
                <div class="flex gap-4 bg-white rounded-2xl p-5 shadow-sm ring-1 ring-gray-200">
                    <div class="w-20 h-20 rounded-xl overflow-hidden bg-gray-100 shrink-0">
                        <img src="{{ $item->article->image }}" alt="{{ $item->article->titre }}" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-gray-900">{{ $item->article->titre }}</h3>
                        <p class="text-sm text-gray-500">Quantité : {{ $item->quantity }} × {{ number_format($item->price, 2, ',', ' ') }} €</p>
                    </div>
                    <div class="text-right">
                        <p class="font-black text-gray-900 text-lg">{{ number_format($item->subtotal, 2, ',', ' ') }} €</p>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Order Info + Status Update --}}
        <div class="space-y-6">
            <div class="bg-white rounded-2xl p-6 shadow-sm ring-1 ring-gray-200">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Informations</h2>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Client</span>
                        <span class="font-medium text-gray-900">{{ $order->user->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Email</span>
                        <span class="font-medium text-gray-900">{{ $order->user->email }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Date</span>
                        <span class="font-medium text-gray-900">{{ $order->created_at->format('d/m/Y H:i') }}</span>
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
                        <span class="font-bold text-gray-900">Total</span>
                        <span class="font-black text-gray-900 text-xl">{{ number_format($order->total, 2, ',', ' ') }} €</span>
                    </div>
                </div>
            </div>

            {{-- Status Update --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm ring-1 ring-gray-200">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Changer le statut</h2>
                <div class="mb-3">
                    <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $order->status_color }}">
                        Actuel : {{ $order->status_label }}
                    </span>
                </div>
                <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="space-y-3">
                    @csrf
                    @method('PATCH')
                    <select name="status"
                            class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100 transition">
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>En attente</option>
                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>En cours</option>
                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Terminée</option>
                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Annulée</option>
                    </select>
                    <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-cyan-600 px-5 py-3 text-sm font-bold text-white hover:bg-cyan-500 transition cursor-pointer">
                        <i class="fa-solid fa-arrows-rotate"></i> Mettre à jour
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
