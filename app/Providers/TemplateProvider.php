<?php

namespace App\Providers;

use App\Models\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class TemplateProvider extends ServiceProvider
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
        View::composer('front.layout.template', function($view){
            $configKeys = ['logo', 'blogname', 'title', 'caption', 'ads_header', 'ads_footer', 'footer'];

            $config = Config::whereIn('name', $configKeys)->pluck('value', 'name');

            $view->with('config', $config);
        });
        View::composer('front.layout.side-widget', function($view){
            $configKeys = ['ads_widget'];

            $config = Config::where('name', 'ads_widget')->pluck('value', 'name');

            $view->with('config', $config);
        });
    }
}
