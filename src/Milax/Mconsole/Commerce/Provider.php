<?php

namespace Milax\Mconsole\Commerce;

use Illuminate\Support\ServiceProvider;

class Provider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when('\Milax\Mconsole\Commerce\Http\Controllers\CategoriesController')
            ->needs('\Milax\Mconsole\Contracts\Repository')
            ->give(function () {
                return new \Milax\Mconsole\Commerce\Repositories\CategoriesRepository(\Milax\Mconsole\Commerce\Models\Category::class);
            });
        
        $this->app->when('\Milax\Mconsole\Commerce\Http\Controllers\DeliveryTypesController')
            ->needs('\Milax\Mconsole\Contracts\Repository')
            ->give(function () {
                return new \Milax\Mconsole\Commerce\Repositories\DeliveryTypesRepository(\Milax\Mconsole\Commerce\Models\DeliveryType::class);
            });
        
        $this->app->when('\Milax\Mconsole\Commerce\Http\Controllers\DiscountsController')
            ->needs('\Milax\Mconsole\Contracts\Repository')
            ->give(function () {
                return new \Milax\Mconsole\Commerce\Repositories\DiscountsRepository(\Milax\Mconsole\Commerce\Models\Discount::class);
            });
    }
}
