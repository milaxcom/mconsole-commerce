<?php 

namespace Milax\Mconsole\Commerce\Contracts;

interface PaymentProvider
{
    /**
     * Set payment provider settings
     * 
     * @param object $settings
     */
    public function setSettings($settings);
    
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
     * @param  object $order
     * @param  array $payload
     * @return bool
     */
    public function pay($order, $payload);
    
    /**
     * Payment post processing
     * 
     * @param object $order
     */
    public function postPay($order);
}