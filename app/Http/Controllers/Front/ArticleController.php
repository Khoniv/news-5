<?php

namespace App\Http\Controllers\Front;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function index()
    {
        $keyword = request()->keyword;

        if ($keyword) {
            $articles = Article::with('Category')->whereStatus(1)->where('title', 'like', '%' .$keyword. '%')->latest()->paginate(6);
        } else {
            $articles = Article::with('Category')->whereStatus(1)->latest()->paginate(6);
        }

        return view('front.article.index', [
            'articles' => $articles,
            'keyword' => $keyword,
            'category_navbar' => Category::latest()->get()
        ]);
    }
/******  b79ec38d-a0ed-402c-865d-f87015ba6ffc  *******/
    public function show($slug)
    {
        $article = Article::whereSlug($slug)->firstOrFail();
        try {
            $article->increment('views');
        } catch (\Throwable $e) {
            // read-only filesystem on serverless (Vercel) — skip view counter
        }
        return view('front.article.show', [
            'article' => $article,
            'categories' => Category::latest()->get(),
            'category_navbar' => Category::latest()->get()
        ]);
    }
}


