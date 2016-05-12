<?php

namespace Milax\Mconsole\Commerce\Models;

use Illuminate\Database\Eloquent\Model;
use Milax\Mconsole\Commerce\Traits\Models\HasProducts;

class Category extends Model
{
    use \CascadeDelete, \HasUploads, \HasState, HasProducts;
    
    protected $table = 'commerce_categories';
    protected $fillable = ['category_id', 'level', 'slug', 'name', 'description', 'enabled'];
    
    public function category()
    {
        return $this->belongsTo('Milax\Mconsole\Commerce\Models\Category', 'category_id');
    }
    
    public function categories()
    {
        return $this->hasMany('Milax\Mconsole\Commerce\Models\Category', 'category_id');
    }
    
    public static function getMaxLevel()
    {
        return self::max('level');
    }
}
