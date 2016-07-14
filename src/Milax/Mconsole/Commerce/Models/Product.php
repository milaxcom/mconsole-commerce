<?php

namespace Milax\Mconsole\Commerce\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use \CascadeDelete, \HasUploads, \HasState;
    
    protected $table = 'commerce_products';
    protected $fillable = ['article', 'name', 'slug', 'description', 'lists', 'tables', 'price', 'discount_price', 'increase_price', 'decrease_price', 'quantity', 'enabled', 'in_stock', 'of_stock', 'on_request'];
    protected $casts = [
        'tables' => 'object',
        'lists' => 'object',
    ];
    
    public function parent()
    {
        return $this->belongsTo('\Milax\Mconsole\Commerce\Models\Product', 'product_id');
    }
    
    public function children()
    {
        return $this->hasMany('\Milax\Mconsole\Commerce\Models\Product', 'product_id');
    }
    
    public function categories()
    {
        return $this->belongsToMany('\Milax\Mconsole\Commerce\Models\Category', 'commerce_categories_products');
    }
    
    /**
     * Automatically delete related data
     * 
     * @return void
     */
    public static function boot()
    {
        parent::boot();
        static::deleting(function ($product) {
            $product->children()->each(function ($child) {
                $child->delete();
            });
        });
    }
}
