<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Implementations\CategoriesService;
use App\Services\Interfaces\CategoriesServiceInterface;
use App\Repositories\Implementations\CategoriesRepository;
use App\Repositories\Interfaces\CategoriesRepositoryInterface;

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
        app()->bind(CategoriesServiceInterface::class, CategoriesService::class);
    }
}
