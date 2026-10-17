<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        return view('front.home.index', [
            'latest_post' => Article::with(['User', 'Category'])->latest()->whereStatus(1)->first(),
            'articles' => Article::with(['User', 'Category'])->whereStatus(1)->latest()->paginate(6),
            'categories' => Category::latest()->get(),
            'category_navbar' => Category::latest()->get()
        ]);
    }
}
