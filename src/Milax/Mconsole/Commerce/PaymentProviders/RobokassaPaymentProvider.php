<?php

namespace Milax\Mconsole\Commerce\PaymentProviders;

use Milax\Mconsole\Commerce\Contracts\PaymentProvider;

class RobokassaPaymentProvider implements PaymentProvider
{
    protected $settings;
    
    public function __construct($settings)
    {
        $this->settings = $settings;
    }
    
    public function processOrder()
    {
        
    }
    
    public function getUrl($order, $debug = false)
    {
        #$r = Milax\Mconsole\Commerce\Models\PaymentMethod::first()->settings
        #$p = new Milax\Mconsole\Commerce\PaymentProviders\RobokassaPaymentProvider($r)
        #$p->getUrl((object)['identifier'=>4,'description'=>'Test product x 1'], true);
        
        $total = $order->getTotal();
        $hash = $this->calculateHash($total, $order->identifier);
        
        $query = http_build_query([
            'MrchLogin' => $this->settings->login,
            'OutSum' => $total,
            'InvId' => $order->identifier,
            'Desc' => isset($order->description) ? $order->description : null,
            'SignatureValue' => $hash,
            'IsTest' => $debug,
        ]);
        
        return sprintf('https://auth.robokassa.ru/Merchant/Index.aspx?%s', $query);
    }
    
    /**
     * Get crc sum for order
     * 
     * @param  float $total
     * @param  integer $id
     * @return string
     */
    protected function calculateHash($total, $identifier)
    {
        return md5(sprintf('%s:%s:%s:%s', $this->settings->login, $total, $identifier, $this->settings->password));
    }
}