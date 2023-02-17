<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Intefaces\ProductRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Repositories\Intefaces\VariationRepositoryInterface;
use App\Repositories\VariationRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(VariationRepositoryInterface::class, VariationRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
