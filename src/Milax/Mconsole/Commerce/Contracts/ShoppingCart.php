<?php

namespace Milax\Mconsole\Commerce\Contracts;

interface ShoppingCart
{
    /**
     * Get all cart contents
     * 
     * @return array
     */
    public function get();
    
    /**
     * Replace cart contents
     *
     * @param array $products [Product objects]
     * @return array
     */
    public function replace($products);
    
    /**
     * Push item to the cart
     * 
     * @param Product $product [Product object]
     * @param int $num     [Quantity]
     */
    public function add($product, $num);
    
    /**
     * Remove product from cart
     *
     * @param Product $product [Product object]
     * @return void
     */
    public function remove($product);
    
    /**
     * Change product quantity
     * 
     * @param  Product $product [Product object]
     * @param  int $num     [Quantity]
     * @return void
     */
    public function quantity($product, $num);
    
    /**
     * Calculate total sum
     * 
     * @return int
     */
    public function total();
}
