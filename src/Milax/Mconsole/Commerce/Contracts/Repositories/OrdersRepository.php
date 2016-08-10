<?php

namespace Milax\Mconsole\Commerce\Contracts\Repositories;

interface OrdersRepository
{
    /**
     * Get order by slug
     *
     * @param  string $slug
     * @return Order
     */
    public function getBySlug($slug);
    
    /**
     * Place order
     *
     * @param int $delivery [Delivery type id]
     * @param array $products [Product objects array]
     * @param array $info [Contact and delivery info]
     * @return Order
     */
    public function place($delivery, $products, $info);
    
    /**
     * Change order status
     *
     * @param int $id [Order id]
     * @param mixed $status [Active status]
     * @return Order
     */
    // public function changeStatus($id, $status);
}
