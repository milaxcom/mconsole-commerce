<?php


namespace Milax\Mconsole\Commerce\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use \CascadeDelete, \HasUploads, \HasState;
    
    protected $table = 'commerce_products';
    protected $fillable = ['article', 'name', 'slug', 'description', 'lists', 'tables', 'price', 'discount_price', 'increase_price', 'decrease_price', 'quantity', 'enabled', 'in_stock', 'of_stock', 'on_request'];
    
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
        $max = \Milax\Mconsole\Commerce\Models\Category::getMaxLevel();
        
        $query = $this->morphedByMany(
            '\Milax\Mconsole\Commerce\Models\Category',
            'productable',
            'commerce_productables',
            'product_id',
            'productable_id'
        );
        
        for ($i = 1; $i <= $max; $i++) {
            $with = implode('.', array_pad(['category'], $i + 1, 'category'));
            $query->with($with);
        }
        
        return $query;
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
