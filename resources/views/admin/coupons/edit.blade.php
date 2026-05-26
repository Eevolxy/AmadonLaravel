@extends('layouts.admin')

@section('title', 'Modifier le coupon')
@section('page-title', 'Modifier : ' . $coupon->code)

@section('content')
    <div class="max-w-2xl">
        <a href="{{ route('admin.coupons.index') }}" class="text-sm text-gray-500 hover:text-cyan-600 transition mb-6 inline-block">
            <i class="fa-solid fa-arrow-left"></i> Retour aux coupons
        </a>

        @if ($errors->any())
            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                <ul class="space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.coupons.update', $coupon) }}" method="POST"
              class="bg-white rounded-2xl p-8 shadow-sm ring-1 ring-gray-200 space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label for="code" class="block text-sm font-semibold text-gray-700">Code</label>
                <input type="text" id="code" name="code" value="{{ old('code', $coupon->code) }}"
                       class="w-full rounded-xl border border-gray-200 px-4 py-3 font-mono uppercase outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100 transition">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="type" class="block text-sm font-semibold text-gray-700">Type de réduction</label>
                    <select id="type" name="type"
                            class="w-full rounded-xl border border-gray-200 px-4 py-3 outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100 transition">
                        <option value="percentage" {{ old('type', $coupon->type) === 'percentage' ? 'selected' : '' }}>Pourcentage (%)</option>
                        <option value="fixed" {{ old('type', $coupon->type) === 'fixed' ? 'selected' : '' }}>Montant fixe (€)</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label for="value" class="block text-sm font-semibold text-gray-700">Valeur</label>
                    <input type="number" id="value" name="value" value="{{ old('value', $coupon->value) }}" step="0.01" min="0"
                           class="w-full rounded-xl border border-gray-200 px-4 py-3 outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100 transition">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="min_order_amount" class="block text-sm font-semibold text-gray-700">Montant minimum (€)</label>
                    <input type="number" id="min_order_amount" name="min_order_amount" value="{{ old('min_order_amount', $coupon->min_order_amount) }}" step="0.01" min="0"
                           class="w-full rounded-xl border border-gray-200 px-4 py-3 outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100 transition">
                </div>
                <div class="space-y-2">
                    <label for="usage_limit" class="block text-sm font-semibold text-gray-700">Limite d'utilisation</label>
                    <input type="number" id="usage_limit" name="usage_limit" value="{{ old('usage_limit', $coupon->usage_limit) }}" min="1" placeholder="Illimité"
                           class="w-full rounded-xl border border-gray-200 px-4 py-3 outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100 transition">
                </div>
            </div>

            <div class="space-y-2">
                <label for="expires_at" class="block text-sm font-semibold text-gray-700">Date d'expiration</label>
                <input type="datetime-local" id="expires_at" name="expires_at"
                       value="{{ old('expires_at', $coupon->expires_at ? $coupon->expires_at->format('Y-m-d\TH:i') : '') }}"
                       class="w-full rounded-xl border border-gray-200 px-4 py-3 outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100 transition">
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $coupon->is_active) ? 'checked' : '' }}
                       class="w-5 h-5 rounded border-gray-300 text-cyan-600 focus:ring-cyan-500">
                <label for="is_active" class="text-sm font-semibold text-gray-700">Coupon actif</label>
            </div>

            <div class="flex items-center gap-3 text-sm text-gray-500 bg-gray-50 rounded-xl p-4">
                <i class="fa-solid fa-chart-bar text-gray-400"></i>
                Utilisé {{ $coupon->used_count }} fois
            </div>

            <button type="submit"
                    class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-cyan-600 px-5 py-3 text-sm font-bold text-white hover:bg-cyan-500 transition cursor-pointer">
                <i class="fa-solid fa-save"></i> Enregistrer les modifications
            </button>
        </form>
    </div>
@endsection
