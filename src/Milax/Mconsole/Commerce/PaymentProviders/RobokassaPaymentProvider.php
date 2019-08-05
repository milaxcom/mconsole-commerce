<?php

namespace Milax\Mconsole\Commerce\PaymentProviders;

use Milax\Mconsole\Commerce\Contracts\PaymentProvider;

class RobokassaPaymentProvider implements PaymentProvider
{
    protected $settings;
    
    public function setSettings($settings)
    {
        $this->settings = $settings;
        return $this;
    }
    
    public function pay($order, $payload)
    {
        $signature = $this->verifySignature($order->getTotal(), $order->id, $this->settings->password2);
        return $this->checkHash($order, $payload, $signature);
        /*
        ['InvId' => 1, 'OutSum' => 1401.54, 'SignatureValue' => '14351073458b4f60843acb523b273bb1', 'Culture' => 'ru', 'IsTest' => 1]
        
        verify: 14351073458b4f60843acb523b273bb1
        */
    }
    
    public function check($order, $payload)
    {
        $signature = $this->verifySignature($order->getTotal(), $order->id, $this->settings->password1);
        return $this->checkHash($order, $payload, $signature);
    }
    
    public function getUrl($order, $debug = false)
    {
        $total = $order->getTotal();
        $hash = $this->calculateSignature($total, $order->id);
        
        $query = http_build_query([
            'MrchLogin' => $this->settings->login,
            'OutSum' => $total  / config('commerce.currency.basic'),
            'InvId' => $order->id,
            'Desc' => isset($order->description) ? $order->description : null,
            'SignatureValue' => $hash,
            'IsTest' => $debug ? '1' : '0',
        ]);
        
        return sprintf('https://auth.robokassa.ru/Merchant/Index.aspx?%s', $query);
    }
    
    protected function checkHash($order, $payload, $signature)
    {
        if ($payload['OutSum'] == $order->getTotal() / config('commerce.currency.basic') && $payload['SignatureValue'] == $signature) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Get signature for order
     * 
     * @param  float $total
     * @param  int $id
     * @return string
     */
    protected function calculateSignature($total, $id)
    {
        return md5(sprintf('%s:%s:%s:%s', $this->settings->login, $total / config('commerce.currency.basic'), $id, $this->settings->password1));
    }
    
    /**
     * Verify signature for order
     * 
     * @param  float $total
     * @param  int $id [description]
     * @return string
     */
    protected function verifySignature($total, $id, $password)
    {
        return md5(sprintf('%s:%s:%s', $total / config('commerce.currency.basic'), $id, $password));
    }
}