<?php

namespace Milax\Mconsole\Commerce\Contracts;

interface OrderProcessor
{
    /**
     * Get order by payment provider request
     * 
     * @param  array $payload
     * @return Order
     */
    public function getOrder($payload);
    
    /**
     * Get link for pay
     * 
     * @param  object $order
     * @return string
     */
    public function getUrl($order);
    
    /**
     * Get response from PaymentProvider and change order status
     * 
     * @param  array $payload
     * @param  function $callback
     * @return void
     */
    public function pay($payload, $callback);
}