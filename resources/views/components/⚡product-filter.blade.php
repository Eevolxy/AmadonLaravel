<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Article;

new class extends Component
{
    public string $categorie = '';
    public string $prix_min  = '';
    public string $prix_max  = '';
    public int    $note_min  = 0;

    #[Computed]
    public function articles()
    {
        return Article::query()
            ->when($this->categorie, fn($q) => $q->where('categorie', $this->categorie))
            ->when($this->prix_min,  fn($q) => $q->where('prix', '>=', $this->prix_min))
            ->when($this->prix_max,  fn($q) => $q->where('prix', '<=', $this->prix_max))
            ->when($this->note_min,  fn($q) => $q->where('note', '>=', $this->note_min))
            ->get();
    }

    #[Computed]
    public function categories()
    {
        return Article::select('categorie')->distinct()->pluck('categorie');
    }
};
?>

<div class="p-6 grid grid-cols-1 lg:grid-cols-[260px_1fr] gap-8 max-w-7xl w-full mx-auto">

    {{-- Sidebar Filters --}}
    <aside class="space-y-6">
        <div class="bg-white rounded-2xl p-6 shadow-sm ring-1 ring-gray-200">
            <h3 class="font-bold text-lg mb-4 text-gray-900">
                <i class="fa-solid fa-filter text-cyan-600 mr-2"></i>Filtres
            </h3>

            <div class="space-y-5">
                {{-- Category --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Catégorie</label>
                    <select wire:model.live="categorie"
                            class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100 transition">
                        <option value="">Toutes</option>
                        @foreach ($this->categories as $cat)
                            <option value="{{ $cat }}">{{ ucfirst($cat) }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Price Range --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Prix (€)</label>
                    <div class="flex gap-2">
                        <input type="number" wire:model.live.debounce.300ms="prix_min" placeholder="Min"
                               class="w-1/2 rounded-xl border border-gray-200 px-3 py-2.5 text-sm outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100 transition">
                        <input type="number" wire:model.live.debounce.300ms="prix_max" placeholder="Max"
                               class="w-1/2 rounded-xl border border-gray-200 px-3 py-2.5 text-sm outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100 transition">
                    </div>
                </div>

                {{-- Rating --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Note minimum</label>
                    <div class="flex flex-wrap gap-2">
                        <label class="cursor-pointer">
                            <input type="radio" wire:model.live="note_min" value="0" class="sr-only peer">
                            <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-medium ring-1 ring-gray-200 peer-checked:bg-cyan-600 peer-checked:text-white peer-checked:ring-cyan-600 transition">
                                Tous
                            </span>
                        </label>
                        @for ($i = 1; $i <= 5; $i++)
                            <label class="cursor-pointer">
                                <input type="radio" wire:model.live="note_min" value="{{ $i }}" class="sr-only peer">
                                <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-medium ring-1 ring-gray-200 peer-checked:bg-cyan-600 peer-checked:text-white peer-checked:ring-cyan-600 transition">
                                    {{ $i }}★
                                </span>
                            </label>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </aside>

    {{-- Products Grid --}}
    <div>
        <div class="flex items-center justify-between mb-6">
            <p class="text-sm text-gray-500">{{ $this->articles->count() }} produit(s) trouvé(s)</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
            @forelse ($this->articles as $article)
                <a href="{{ route('products.show', $article) }}"
                   class="group bg-white rounded-2xl shadow-sm ring-1 ring-gray-200 overflow-hidden transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="aspect-square bg-gray-100 overflow-hidden">
                        <img src="{{ $article->image }}" alt="{{ $article->titre }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    </div>
                    <div class="p-5">
                        <p class="text-xs font-semibold text-cyan-600 uppercase tracking-wider">{{ $article->categorie }}</p>
                        <h3 class="mt-1 font-bold text-gray-900 truncate group-hover:text-cyan-600 transition">{{ $article->titre }}</h3>
                        <p class="text-sm text-gray-500 mt-1 line-clamp-2">{{ $article->description }}</p>
                        <div class="mt-3 flex items-center justify-between">
                            <span class="text-lg font-black text-gray-900">{{ number_format($article->prix, 2, ',', ' ') }} €</span>
                            <span class="text-yellow-500 text-sm">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fa-{{ $i <= $article->note ? 'solid' : 'regular' }} fa-star"></i>
                                @endfor
                            </span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-16">
                    <i class="fa-solid fa-search text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500 font-medium">Aucun produit trouvé.</p>
                    <p class="text-sm text-gray-400 mt-1">Essaie de modifier tes filtres.</p>
                </div>
            @endforelse
        </div>
    </div>

</div>