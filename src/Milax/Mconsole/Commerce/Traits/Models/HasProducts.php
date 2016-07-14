<?php

namespace Milax\Mconsole\Commerce\Traits\Models;

trait HasProducts
{
    /**
     * Dynamic hasMany relationship on Product model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\morphToMany
     */
    public function products()
    {
        return $this->morphToMany('Milax\Mconsole\Commerce\Models\Product', 'productable', 'commerce_productables');
    }
    
    /**
     * Cascade Delete Products
     * 
     * @return void
     */
    protected function cascadeDeleteProducts()
    {
        $this->products()->detach();
    }
}
