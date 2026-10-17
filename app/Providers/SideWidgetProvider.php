<?php

namespace App\Providers;

use App\Models\Article;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class SideWidgetProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('front.layout.side-widget', function ($view){
            $posts = Article::orderBy('views', 'desc')->take(3)->get();

            $view->with('popular_posts', $posts);
        });
    }
}
