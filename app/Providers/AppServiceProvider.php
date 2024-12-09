<?php

namespace App\Providers;

use App\Repositories\CategoryRepository;
use App\Repositories\IngredientRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryRepository::class, function ($app) {
            return new CategoryRepository();
        });
        $this->app->bind(IngredientRepository::class, function ($app) {
            return new IngredientRepository();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
