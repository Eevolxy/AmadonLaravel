<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::query()
            ->when($request->categorie, fn($q) => $q->where('categorie', $request->categorie))
            ->when($request->prix_min,  fn($q) => $q->where('prix', '>=', $request->prix_min))
            ->when($request->prix_max,  fn($q) => $q->where('prix', '<=', $request->prix_max))
            ->when($request->note_min,  fn($q) => $q->where('note', '>=', $request->note_min))
            ->get();

        $categories = Article::select('categorie')->distinct()->pluck('categorie');

        return view('articles.articles', compact('articles', 'categories'));
    }
}
