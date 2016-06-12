<?php

namespace Milax\Mconsole\Commerce\Repositories;

use Milax\Mconsole\Repositories\EloquentRepository;
use Milax\Mconsole\Commerce\Contracts\Repositories\CategoriesRepository as Repository;

class CategoriesRepository extends EloquentRepository implements Repository
{
    public $model = \Milax\Mconsole\Commerce\Models\Category::class;
    
    public function index()
    {
        return $this->query()->orderBy('level', 'asc');
    }
    
    public function withParent()
    {
        return $this->query->withParent($this->query);
    }
    
    public function withChildren()
    {
        return $this->query->withChildren($this->query);
    }
    
    public function create($data)
    {
        $instance = parent::fill($data);
        
        if ($instance->category_id != 0) {
            $instance->level = $this->find($instance->category_id)->level + 1;
        }
        
        $instance->save();
        
        return $instance;
    }
    
    public function update($id, $data)
    {
        $model = $this->model;
        
        $instance = $model::findOrFail((int) $id);
        $data = $this->fixDates($instance, $data);
        
        if ($data['category_id'] != 0) {
            $data['level'] = $this->find($data['category_id'])->level + 1;
        } else {
            $data['level'] = 0;
        }
        
        $instance->update($data);
        
        if ($instance->children) {
            foreach ($instance->children as $child) {
                $this->update($child->id, [
                    'category_id' => $instance->id,
                    'level' => $data['level'],
                ]);
            }
        }
        
        return $instance;
    }
}
