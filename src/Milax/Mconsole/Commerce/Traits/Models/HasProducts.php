<?php

namespace Milax\Mconsole\Commerce\Traits\Models;

use Illuminate\Database\Eloquent\Relations\HasManyThrough;

trait HasProducts
{
    /**
     * Dynamic hasMany relationship on Product model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function relatedProducts()
    {
        return $this->morphToMany('Milax\Mconsole\Commerce\Models\Product', 'productable', 'commerce_productables');
    }
    
    /**
     * Cascade Delete products
     * 
     * @return void
     */
    protected function cascadeDeleteRelatedProducts()
    {
        //
    }
}
