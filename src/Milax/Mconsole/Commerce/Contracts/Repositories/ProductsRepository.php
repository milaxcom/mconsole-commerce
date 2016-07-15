<?php

namespace Milax\Mconsole\Commerce\Contracts\Repositories;

interface ProductsRepository
{
    /**
     * Find product by slug
     * 
     * @param  string $slug [Product slug]
     * @return Product
     */
    public function findBySlug($slug);
}
