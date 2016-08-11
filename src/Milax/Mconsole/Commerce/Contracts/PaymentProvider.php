<?php 

namespace Milax\Mconsole\Commerce\Contracts;

interface PaymentProvider
{
    /**
     * Get url for payment
     * 
     * @param  Order $order
     * @return string
     */
    public function getUrl($order);
    
    /**
     * Attempt to pay order
     * 
     * @param  array $payload
     * @return bool
     */
    public function pay($payload);
}