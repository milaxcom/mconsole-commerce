<?php

namespace Milax\Mconsole\Commerce;

use Milax\Mconsole\Commerce\Models\Order;
use Milax\Mconsole\Commerce\Events\OrderCreated;
use Milax\Mconsole\Commerce\Events\OrderStatusUpdated;
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
        view()->composer('mconsole::commerce.categories.form', '\Milax\Mconsole\Commerce\Composers\CategoriesViewComposer');
        view()->composer('mconsole::commerce.products.form', '\Milax\Mconsole\Commerce\Composers\ProductsCategoriesViewComposer');
        
        $this->ordersEvents();
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
        $this->app->bind('Milax\Mconsole\Commerce\Contracts\Repositories\OrdersRepository', 'Milax\Mconsole\Commerce\Repositories\OrdersRepository');
        $this->app->bind('Milax\Mconsole\Commerce\Contracts\Repositories\PaymentMethodsRepository', 'Milax\Mconsole\Commerce\Repositories\PaymentMethodsRepository');
        $this->app->bind('Milax\Mconsole\Commerce\Contracts\OrderProcessor', 'Milax\Mconsole\Commerce\OrderProcessor');
    }
    
    /**
     * Reigster orders events
     * 
     * @return void
     */
    protected function ordersEvents()
    {
        Order::created(function ($order) {
            event(new OrderCreated($order));
        });
        
        Order::updating(function ($order) {
            $old = Order::find($order->id);
            if ($old->status != $order->status) {
                event(new OrderStatusUpdated($order, $order->status));
            }
            
            return true;
        });
    }
}
