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

<div class="p-5 grid grid-cols-[20%_70%] gap-6 max-w-7xl w-full mx-auto">

    <aside class="flex flex-col gap-5 mt-10">

        <div>
            <h3 class="font-bold text-lg mb-2">Catégorie</h3>
            <select wire:model.live="categorie" class="w-full border rounded-lg px-3 py-2">
                <option value="">Toutes</option>
                @foreach ($this->categories as $cat)
                    <option value="{{ $cat }}">{{ ucfirst($cat) }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <h3 class="font-bold text-lg mb-2">Prix (€)</h3>
            <div class="flex gap-2">
                <input type="number" wire:model.live="prix_min" placeholder="Min"
                       class="w-1/2 border rounded-lg px-3 py-2">
                <input type="number" wire:model.live="prix_max" placeholder="Max"
                       class="w-1/2 border rounded-lg px-3 py-2">
            </div>
        </div>

        <div>
            <h3 class="font-bold text-lg mb-2">Note minimum</h3>
            <div class="flex gap-2">
                @for ($i = 1; $i <= 5; $i++)
                    <label class="flex flex-col items-center cursor-pointer">
                        <input type="radio" wire:model.live="note_min" value="{{ $i }}">
                        {{ $i }}★
                    </label>
                @endfor
                <label class="flex flex-col items-center cursor-pointer text-gray-400 text-sm">
                    <input type="radio" wire:model.live="note_min" value="0">
                    Tous
                </label>
            </div>
        </div>

    </aside>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse ($this->articles as $article)
            <div class="border border-gray-200 rounded-lg p-4">
                <h2 class="text-xl font-bold">{{ $article->titre }}</h2>
                <p class="text-gray-600 text-sm">{{ $article->description }}</p>
                <p class="text-yellow-500 font-semibold">{{ $article->note }} / 5 ★</p>
                <p class="text-gray-800 font-bold">{{ $article->prix }} €</p>
                <img src="{{ $article->image }}" alt="{{ $article->titre }}" class="mt-2 rounded">
            </div>
        @empty
            <p class="col-span-3 text-center text-gray-500">Aucun produit trouvé.</p>
        @endforelse
    </div>

</div>