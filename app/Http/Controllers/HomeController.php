<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredArticles = Article::inRandomOrder()->take(8)->get();
        $categories = Article::select('categorie')->distinct()->pluck('categorie');
        $promoArticles = Article::orderBy('prix', 'asc')->take(4)->get();

        return view('home', compact('featuredArticles', 'categories', 'promoArticles'));
    }
}
