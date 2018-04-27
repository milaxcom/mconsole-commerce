<?php 

namespace Milax\Mconsole\Commerce\Repositories;

use Milax\Mconsole\Repositories\EloquentRepository;
use Milax\Mconsole\Commerce\Contracts\Repositories\ProductsRepository as Repository;

class ProductsRepository extends EloquentRepository implements Repository
{
    public $model = \Milax\Mconsole\Commerce\Models\Product::class;
    
    public function create($data)
    {
        if (!empty($data['lists'])) {
            $data['lists'] = $this->serializeLists($data['lists']);
        }
        
        $instance = $this->fill($data);
        if (!empty($data['categories'])) {
            $instance->categories()->sync($data['categories']);
        }
        
        $instance->save();
        
        return $instance;
    }
    
    public function update($id, $data)
    {
        if (!empty($data['lists'])) {
            $data['lists'] = $this->serializeLists($data['lists']);
        }
        
        $model = $this->model;
        
        $instance = $model::findOrFail((int) $id);
        $data = $this->fixDates($instance, $data);
        
        if (!empty($data['categories'])) {
            $instance->categories()->sync($data['categories']);
        } else {
            $instance->categories()->detach();
        }
        
        $model::findOrFail((int) $id)->update($data);
        
        return $instance;
    }
    
    public function findBySlug($slug)
    {
        $model = $this->model;
        $product = $model::where('slug', $slug)->firstOrFail();
        return $product;
    }
    
    /**
     * Serialize lists field to array
     * 
     * @return array
     */
    protected function serializeLists($lists)
    {
        foreach ($lists as $key => $list) {
            $lists[$key] = explode("\r\n", $list);
        }
        
        return $lists;
    }
    
}