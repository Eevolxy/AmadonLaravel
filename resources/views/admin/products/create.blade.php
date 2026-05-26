@extends('layouts.admin')

@section('title', 'Ajouter un produit')
@section('page-title', 'Ajouter un produit')

@section('content')
    <div class="max-w-2xl">
        <a href="{{ route('admin.products.index') }}" class="text-sm text-gray-500 hover:text-cyan-600 transition mb-6 inline-block">
            <i class="fa-solid fa-arrow-left"></i> Retour aux produits
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

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"
              class="bg-white rounded-2xl p-8 shadow-sm ring-1 ring-gray-200 space-y-6">
            @csrf

            <div class="space-y-2">
                <label for="titre" class="block text-sm font-semibold text-gray-700">Titre</label>
                <input type="text" id="titre" name="titre" value="{{ old('titre') }}"
                       class="w-full rounded-xl border border-gray-200 px-4 py-3 outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100 transition">
            </div>

            <div class="space-y-2">
                <label for="description" class="block text-sm font-semibold text-gray-700">Description</label>
                <textarea id="description" name="description" rows="4"
                          class="w-full rounded-xl border border-gray-200 px-4 py-3 outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100 transition resize-none">{{ old('description') }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="prix" class="block text-sm font-semibold text-gray-700">Prix (€)</label>
                    <input type="number" id="prix" name="prix" value="{{ old('prix') }}" step="0.01" min="0"
                           class="w-full rounded-xl border border-gray-200 px-4 py-3 outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100 transition">
                </div>
                <div class="space-y-2">
                    <label for="note" class="block text-sm font-semibold text-gray-700">Note (1-5)</label>
                    <input type="number" id="note" name="note" value="{{ old('note') }}" min="1" max="5"
                           class="w-full rounded-xl border border-gray-200 px-4 py-3 outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100 transition">
                </div>
            </div>

            <div class="space-y-2">
                <label for="categorie" class="block text-sm font-semibold text-gray-700">Catégorie</label>
                <input type="text" id="categorie" name="categorie" value="{{ old('categorie') }}" list="categories-list"
                       class="w-full rounded-xl border border-gray-200 px-4 py-3 outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100 transition">
                <datalist id="categories-list">
                    @foreach ($categories as $cat)
                        <option value="{{ $cat }}">
                    @endforeach
                </datalist>
            </div>

            <div class="space-y-2">
                <label for="image" class="block text-sm font-semibold text-gray-700">Image</label>
                <input type="file" id="image" name="image" accept="image/*"
                       class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm text-gray-500 file:mr-4 file:rounded-lg file:border-0 file:bg-cyan-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-cyan-700 hover:file:bg-cyan-100 cursor-pointer">
            </div>

            <button type="submit"
                    class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-cyan-600 px-5 py-3 text-sm font-bold text-white hover:bg-cyan-500 transition cursor-pointer">
                <i class="fa-solid fa-plus"></i> Créer le produit
            </button>
        </form>
    </div>
@endsection
