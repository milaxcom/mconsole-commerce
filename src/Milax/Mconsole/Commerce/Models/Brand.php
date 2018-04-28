<?php

namespace Milax\Mconsole\Commerce\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use \CascadeDelete, \HasUploads, \HasState;
    
    protected $table = 'commerce_brands';
    protected $fillable = ['slug', 'name', 'description', 'enabled'];
    
    public function products()
    {
        return $this->hasMany('Milax\Mconsole\Commerce\Models\Product', 'brand_id');
    }
}
