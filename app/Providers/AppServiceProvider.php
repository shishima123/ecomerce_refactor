<?php

namespace App\Providers;

use App\Category;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /* Share multi-menu variable view to all frontend template */
        view()->composer(['templates.frontend.header', 'frontend.index', 'frontend.store', 'frontend.checkout', 'frontend.product'], function ($view) {
            $categories = Category::withCount('products')->get(['id', 'name', 'parent_id', 'keyword']);
            $view->with('categories', $categories);
        });
    }
}
