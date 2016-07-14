<?php 

namespace Milax\Mconsole\Commerce\Repositories;

use Milax\Mconsole\Repositories\EloquentRepository;
use Milax\Mconsole\Commerce\Contracts\Repositories\ProductsRepository as Repository;

class ProductsRepository extends EloquentRepository implements Repository
{
    public $model = \Milax\Mconsole\Commerce\Models\Product::class;
    
    public function create($data)
    {
        $instance = $this->fill($data);
        if (!empty($data['categories'])) {
            $instance->categories()->sync($data['categories']);
        }
        
        $instance->save();
        
        return $instance;
    }
    
    public function update($id, $data)
    {
        $model = $this->model;
        
        $instance = $model::findOrFail((int) $id);
        $data = $this->fixDates($instance, $data);
        
        if (!empty($data['categories'])) {
            $instance->categories()->sync($data['categories']);
        } else {
            $instance->categories()->detach();
        }
        
        $instance = $model::findOrFail((int) $id)->update($data);
        
        return $instance;
    }
    
}