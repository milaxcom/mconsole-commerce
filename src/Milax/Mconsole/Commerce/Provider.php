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
        view()->composer('mconsole::commerce.categories.form', '\Milax\Mconsole\Commerce\Composers\CategoriesComposer');
        
        view()->composer('mconsole::commerce.products.form', '\Milax\Mconsole\Commerce\Composers\ProductsCategories');
    }
    
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Milax\Mconsole\Commerce\Contracts\Repositories\CategoriesRepository', 'Milax\Mconsole\Commerce\Repositories\CategoriesRepository');
        $this->app->bind('Milax\Mconsole\Commerce\Contracts\Repositories\DeliveryTypesRepository', 'Milax\Mconsole\Commerce\Repositories\DeliveryTypesRepository');
        $this->app->bind('Milax\Mconsole\Commerce\Contracts\Repositories\DiscountsRepository', 'Milax\Mconsole\Commerce\Repositories\DiscountsRepository');
        $this->app->bind('Milax\Mconsole\Commerce\Contracts\Repositories\ProductsRepository', 'Milax\Mconsole\Commerce\Repositories\ProductsRepository');
    }
}
