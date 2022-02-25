<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
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
        // Paginator::useBootstrap();

        // Check Table Exist
        if (\Illuminate\Support\Facades\Schema::hasTable('posts')) {
            // $data['randomPost'] = \App\Models\Post::published()->inRandomOrder()->first();
            $data['popularPostsAll'] = \App\Models\Post::published()->orderBy('reads', 'desc')->limit(6)->get();
            $data['recommendedPosts'] = \App\Models\Post::published()->withCount('comments')->orderBy('comments_count', 'desc')->limit(3)->get();
            $data['adsbanner1'] = \App\Models\Banner::where('status', 1)->inRandomOrder()->first();
            $data['adsbanner2'] = \App\Models\Banner::where('status', 1)->inRandomOrder()->first();
            view()->share($data);
        }

        view()->composer('site.layouts.sidebar', function ($view) {
            $view->with([
                'popularPosts' => \App\Models\Post::published()->orderBy('reads', 'desc')->limit(3)->get(),
                'categories' => \App\Models\Category::all(),
                'tags' => \App\Models\Tag::take(15)->get(),
            ]);
        });

        view()->composer('site.layouts.menu', function ($view) {
            $view->with([
                'menus' => \App\Models\Menu::where('parent_id', 0)->orderBy('order')->get(),
            ]);
        });
    }
}
