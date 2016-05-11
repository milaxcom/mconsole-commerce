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
        app('API')->repositories->register('categories', new \Milax\Mconsole\Commerce\Repositories\CategoriesRepository(\Milax\Mconsole\Commerce\Models\Category::class), 'commerce');
        app('API')->repositories->register('products', new \Milax\Mconsole\Commerce\Repositories\ProductsRepository(\Milax\Mconsole\Commerce\Models\Product::class), 'commerce');
        app('API')->repositories->register('deliveries', new \Milax\Mconsole\Commerce\Repositories\DeliveryTypesRepository(\Milax\Mconsole\Commerce\Models\DeliveryType::class), 'commerce');
        app('API')->repositories->register('discounts', new \Milax\Mconsole\Commerce\Repositories\DiscountsRepository(\Milax\Mconsole\Commerce\Models\Discount::class), 'commerce');

        $this->app->when('\Milax\Mconsole\Commerce\Http\Controllers\CategoriesController')
            ->needs('\Milax\Mconsole\Contracts\Repository')
            ->give(function () {
                return app('API')->repositories->commerce->categories;
            });
            
        $this->app->when('\Milax\Mconsole\Commerce\Http\Controllers\ProductsController')
            ->needs('\Milax\Mconsole\Contracts\Repository')
            ->give(function () {
                return app('API')->repositories->commerce->products;
            });
        
        $this->app->when('\Milax\Mconsole\Commerce\Http\Controllers\DeliveryTypesController')
            ->needs('\Milax\Mconsole\Contracts\Repository')
            ->give(function () {
                return app('API')->repositories->commerce->deliveries;
            });
        
        $this->app->when('\Milax\Mconsole\Commerce\Http\Controllers\DiscountsController')
            ->needs('\Milax\Mconsole\Contracts\Repository')
            ->give(function () {
                return app('API')->repositories->commerce->discounts;
            });
    }
}
