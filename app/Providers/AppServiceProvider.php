<?php

namespace App\Providers;

use App\Repositories\Implementations\CategoriesRepository;
use App\Repositories\Interfaces\CategoriesRepositoryInterface;
use Illuminate\Support\ServiceProvider;

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
        app()->bind(CategoriesRepositoryInterface::class, CategoriesRepository::class);
    }
}
