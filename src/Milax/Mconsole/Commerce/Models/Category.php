<?php

namespace Milax\Mconsole\Commerce\Models;

use Illuminate\Database\Eloquent\Model;
use Milax\Mconsole\Commerce\Traits\Models\HasProducts;

class Category extends Model
{
    use \CascadeDelete, \HasUploads, \HasState, HasProducts;
    
    protected $table = 'commerce_categories';
    protected $fillable = ['category_id', 'level', 'slug', 'name', 'description', 'enabled'];
    
    public function parent()
    {
        return $this->belongsTo('Milax\Mconsole\Commerce\Models\Category', 'category_id');
    }
    
    public function children()
    {
        return $this->hasMany('Milax\Mconsole\Commerce\Models\Category', 'category_id');
    }
    
    public static function getMaxLevel()
    {
        return self::max('level');
    }
    
    public function scopeWithParent($query)
    {
        return $query->with('parent');
    }
    
    public function scopeWithChildren($query)
    {
        $max = \Milax\Mconsole\Commerce\Models\Category::getMaxLevel();
        
        for ($i = 1; $i <= $max; $i++) {
            $with = implode('.', array_pad(['children'], $i, 'children'));
            $query->with($with);
            $with = implode('.', array_pad(['parent'], $i, 'parent'));
            $query->with($with);
        }
        
        return $query;
    }
}
