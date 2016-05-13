<?php

namespace Milax\Mconsole\Commerce\Composers;

use Illuminate\View\View;

class CategoriesComposer
{
    protected $tree;
    
    public function __construct()
    {
        $this->repository = app('API')->repositories->commerce->categories;
        $this->tree = collect();
    }
    
    public function compose(View $view)
    {
        $max = \Milax\Mconsole\Commerce\Models\Category::getMaxLevel();
        
        $query = $this->repository->query()->where('level', 0);
        
        for ($i = 1; $i <= $max; $i++) {
            $with = implode('.', array_pad(['children'], $i + 1, 'children'));
            $query->with($with);
        }
        
        foreach ($query->get() as $category) {
            $this->appendToTree($category);
        }
        
        $view->with('categories', $this->tree->lists('name', 'id')->prepend(trans('mconsole::forms.options.notselected')));
    }
    
    protected function appendToTree($category)
    {
        if ($category->level > 0) {
        }
        $this->tree->push($category);
        if ($category->children) {
            foreach ($category->children as $child) {
                $this->appendToTree($child);
            }
        }
    }
}
