<?php

namespace Milax\Mconsole\Commerce\Composers;

use Illuminate\View\View;
use Request;
use Milax\Mconsole\Commerce\Contracts\Repositories\CategoriesRepository;

class CategoriesViewComposer
{
    protected $tree;
    
    public function __construct(CategoriesRepository $repository)
    {
        $this->repository = $repository;
        $this->tree = collect();
    }
    
    public function compose(View $view)
    {
        $query = $this->repository->query()->withChildren()->withParent()->orderBy('level', 'asc')->where('category_id', 0);
        
        foreach ($query->get() as $category) {
            $this->appendToTree($category);
        }
        
        $view->with('categories', $this->tree->pluck('name', 'id')->prepend(trans('mconsole::forms.options.notselected'), 0)->toArray());
    }
    
    protected function appendToTree($category, $parent = null)
    {
        if (Request::route()->parameter('categories') != $category->id && ($category->level + 1 < config('commerce.categories.depth') || config('commerce.categories.depth') == 0)) {
            if ($category->level > 0) {
                $name = collect($category->name);
                while ($parent) {
                    $name->prepend($parent->name);
                    $parent = $parent->parent;
                }
                $category->name = $name->implode(' / ');
            }
            
            $this->tree->push($category);
            if ($category->children) {
                foreach ($category->children as $child) {
                    $this->appendToTree($child, $category);
                }
            }
        }
    }
}
