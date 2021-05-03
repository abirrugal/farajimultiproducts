<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator as PaginationPaginator;
use Illuminate\Support\Facades\Schema;
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
        if (Schema::hasTable('categories')) {
            $categories = Category::select('id','name', 'slug' ,'category_id')->with('child_category')->where('category_id', null)->whereNull('subcategory_id')->latest()->get();
            view()->share('categories', $categories);
            PaginationPaginator::useBootstrap();
        };
      
       
    }
}
