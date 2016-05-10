<?php 

namespace Milax\Mconsole\Commerce\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use \CascadeDelete, \HasUploads, \HasState;
    
    protected $table = 'commerce_products';
    protected $fillable = ['article', 'name', 'slug', 'description', 'lists', 'tables', 'price', 'discount_price', 'increase_price', 'decrease_price', 'quntity', 'enabled'];
    
    public function product()
    {
        return $this->belongsTo('\Milax\Mconsole\Commerce\Models\Product', 'product_id');
    }
    
    public function products()
    {
        return $this->hasMany('\Milax\Mconsole\Commerce\Models\Product', 'product_id');
    }
    
    public function categories()
    {
        return $this->belongsToMany('\Milax\Mconsole\Commerce\Models\Category', 'commerce_categories_products', 'product_id', 'category_id');
    }
}