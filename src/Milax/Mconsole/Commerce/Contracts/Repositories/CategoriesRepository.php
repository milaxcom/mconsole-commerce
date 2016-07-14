<?php

namespace Milax\Mconsole\Commerce\Contracts\Repositories;

interface CategoriesRepository
{
    /**
     * Get 'with parent' query
     *
     * @return mixed
     */
    public function withParent();
    
    /**
     * Get 'with children' query
     * 
     * @return mixed
     */
    public function withChildren();
}
