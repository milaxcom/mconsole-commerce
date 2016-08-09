<?php 

namespace Milax\Mconsole\Commerce\Contracts;

interface PaymentProvider
{
    /**
     * Get url for payment
     * 
     * @param  array $payload
     * @return string
     */
    public function getUrl($payload);
}