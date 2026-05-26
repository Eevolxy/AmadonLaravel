@extends('layouts.admin')

@section('title', 'Coupons')
@section('page-title', 'Gestion des coupons')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-gray-500">{{ $coupons->total() }} coupon(s) au total</p>
        <a href="{{ route('admin.coupons.create') }}"
           class="inline-flex items-center gap-2 rounded-xl bg-cyan-600 px-5 py-2.5 text-sm font-bold text-white hover:bg-cyan-500 transition">
            <i class="fa-solid fa-plus"></i> Ajouter un coupon
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm ring-1 ring-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-left text-gray-500 uppercase tracking-wider text-xs">
                <tr>
                    <th class="px-6 py-3">Code</th>
                    <th class="px-6 py-3">Type</th>
                    <th class="px-6 py-3">Valeur</th>
                    <th class="px-6 py-3">Utilisation</th>
                    <th class="px-6 py-3">Expiration</th>
                    <th class="px-6 py-3">Statut</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($coupons as $coupon)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-bold font-mono text-gray-900">{{ $coupon->code }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $coupon->type === 'percentage' ? 'Pourcentage' : 'Fixe' }}</td>
                        <td class="px-6 py-4 font-bold text-gray-900">
                            {{ $coupon->type === 'percentage' ? $coupon->value . '%' : number_format($coupon->value, 2, ',', ' ') . ' €' }}
                        </td>
                        <td class="px-6 py-4 text-gray-600">
                            {{ $coupon->used_count }}{{ $coupon->usage_limit ? ' / ' . $coupon->usage_limit : '' }}
                        </td>
                        <td class="px-6 py-4 text-gray-600">
                            {{ $coupon->expires_at ? $coupon->expires_at->format('d/m/Y') : 'Illimité' }}
                        </td>
                        <td class="px-6 py-4">
                            @if ($coupon->is_active)
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold bg-green-100 text-green-800">Actif</span>
                            @else
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold bg-gray-100 text-gray-600">Inactif</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('admin.coupons.edit', $coupon) }}" class="text-cyan-600 hover:text-cyan-500 transition">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="POST"
                                      onsubmit="return confirm('Supprimer ce coupon ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 transition cursor-pointer">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center text-gray-400">Aucun coupon.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $coupons->links() }}</div>
@endsection
