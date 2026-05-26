<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Article $article)
    {
        $relatedArticles = Article::where('categorie', $article->categorie)
            ->where('id', '!=', $article->id)
            ->take(4)
            ->get();

        return view('products.show', compact('article', 'relatedArticles'));
    }
}
