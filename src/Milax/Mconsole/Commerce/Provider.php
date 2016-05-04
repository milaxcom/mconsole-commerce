<?php

namespace Milax\Mconsole\Commerce;

use Illuminate\Support\ServiceProvider;

class Provider extends ServiceProvider
{
    public function boot()
    {
        //
    }
    
    public function register()
    {
        $this->app->when('\Milax\Mconsole\Commerce\Http\Controllers\DeliveryTypesController')
            ->needs('\Milax\Mconsole\Contracts\Repository')
            ->give(function () {
                return new \Milax\Mconsole\Commerce\Repositories\DeliveryTypesRepository(\Milax\Mconsole\Commerce\Models\DeliveryType::class);
            });
    }
}
