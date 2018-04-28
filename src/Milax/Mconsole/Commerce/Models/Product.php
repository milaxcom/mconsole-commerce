<?php

namespace Milax\Mconsole\Commerce\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use \CascadeDelete, \HasUploads, \HasState;
    
    protected $table = 'commerce_products';
    protected $fillable = ['brand_id', 'article', 'name', 'slug', 'description', 'lists', 'tables', 'price', 'discount_price', 'increase_price', 'decrease_price', 'quantity', 'enabled', 'in_stock', 'of_stock', 'on_request'];
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

    public function brand()
    {
        return $this->belongsTo('\Milax\Mconsole\Commerce\Models\Brand', 'brand_id');
    }
    
    /**
     * Get product formated price
     * 
     * @return string
     */
    public function getFormatPriceAttribute()
    {
        return currency_format($this->price);
    }
    
    /**
     * Get product formated discount price
     * 
     * @return string
     */
    public function getFormatDiscountPriceAttribute()
    {
        return currency_format($this->discount_price);
    }
    
    public function getRealPriceAttribute()
    {
        $price = $this->discount_price ? $this->discount_price : $this->price;
        
        if ($this->decrease_price > 0) {
            $price = $price - ($price / 100) * $this->decrease_price;
        }
        
        if ($this->increase_price > 0) {
            $price = $price + ($price / 100) * $this->increase_price;
        }
        
        return $price;
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
