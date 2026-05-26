@extends('layouts.admin')

@section('title', 'Produits')
@section('page-title', 'Gestion des produits')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-gray-500">{{ $articles->total() }} produit(s) au total</p>
        <a href="{{ route('admin.products.create') }}"
           class="inline-flex items-center gap-2 rounded-xl bg-cyan-600 px-5 py-2.5 text-sm font-bold text-white hover:bg-cyan-500 transition">
            <i class="fa-solid fa-plus"></i> Ajouter un produit
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm ring-1 ring-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-left text-gray-500 uppercase tracking-wider text-xs">
                <tr>
                    <th class="px-6 py-3">Image</th>
                    <th class="px-6 py-3">Titre</th>
                    <th class="px-6 py-3">Catégorie</th>
                    <th class="px-6 py-3">Prix</th>
                    <th class="px-6 py-3">Note</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($articles as $article)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-3">
                            <div class="w-14 h-14 rounded-lg overflow-hidden bg-gray-100">
                                <img src="{{ $article->image }}" alt="{{ $article->titre }}" class="w-full h-full object-cover">
                            </div>
                        </td>
                        <td class="px-6 py-3 font-bold text-gray-900">{{ $article->titre }}</td>
                        <td class="px-6 py-3 text-gray-600 capitalize">{{ $article->categorie }}</td>
                        <td class="px-6 py-3 font-bold text-gray-900">{{ number_format($article->prix, 2, ',', ' ') }} €</td>
                        <td class="px-6 py-3 text-yellow-500">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fa-{{ $i <= $article->note ? 'solid' : 'regular' }} fa-star text-xs"></i>
                            @endfor
                        </td>
                        <td class="px-6 py-3 text-right">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('admin.products.edit', $article) }}" class="text-cyan-600 hover:text-cyan-500 transition">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $article) }}" method="POST"
                                      onsubmit="return confirm('Supprimer ce produit ?')">
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
                        <td colspan="6" class="px-6 py-10 text-center text-gray-400">Aucun produit.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $articles->links() }}</div>
@endsection
