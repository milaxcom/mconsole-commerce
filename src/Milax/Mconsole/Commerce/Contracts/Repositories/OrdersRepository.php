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
     * @param array $cart [Shopping cart contents]
     * @param DeliveryType $delivery [DeliveryType object]
     * @param PaymentMethod $payment [PaymentMethod object]
     * @param array $info [Contact and delivery info]
     * @return Order
     */
    public function place($cart, $delivery, $payment, $info);
    
    /**
     * Change order status
     *
     * @param int $id [Order id]
     * @param mixed $status [Active status]
     * @return Order
     */
    // public function changeStatus($id, $status);
}
