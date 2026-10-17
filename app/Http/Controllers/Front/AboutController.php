<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\AboutContent;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function about()
    {
        $category_navbar = Category::all(); // Ambil semua kategori
        $aboutContents = AboutContent::all(); // Data "about" yang sudah Anda buat
        return view('front.about.index', compact('category_navbar', 'aboutContents'));
    }
}
