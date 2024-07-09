<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\Content;
use App\Models\Banner;
use App\Models\Contact;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->share('categories',
        Category::where('published', true)->orderBy('id', 'asc')->get());

        view()->share('structure',
        Content::where('category_id', 2)->orderBy('id', 'asc')->get());

        view()->share('banners',
        Banner::orderBy('ordering', 'asc')->get());

        view()->share('contacts',
        Contact::find(1));
    }
}
