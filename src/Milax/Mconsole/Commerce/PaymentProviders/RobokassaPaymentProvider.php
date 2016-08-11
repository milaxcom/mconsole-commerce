<?php

namespace Milax\Mconsole\Commerce\PaymentProviders;

use Milax\Mconsole\Commerce\Contracts\PaymentProvider;
use Milax\Mconsole\Commerce\Contracts\Repositories\OrdersRepository;

class RobokassaPaymentProvider implements PaymentProvider
{
    protected $settings;
    
    public function __construct(OrdersRepository $repository, $settings)
    {
        $this->repository = $repository;
        $this->settings = $settings;
    }
    
    public function pay($payload)
    {
        $order = $this->repository->find($payload['InvId']);
        
        $signature = $this->verifySignature($order->getTotal(), $order->id);
        
        dump($payload['SignatureValue'], $signature);
        
        if ($payload['OutSum'] == $order->getTotal() / config('commerce.currency.basic') && $payload['SignatureValue'] == $signature) {
            return true;
        } else {
            return false;
        }
        /*
        ['InvId' => 3, 'OutSum' => 1401.54, 'SignatureValue' => 'ee67f6dce4c1782c429d054cc1963f6c', 'Culture' => 'ru', 'IsTest' => 1]
        */
        
        
    }
    
    public function getUrl($order, $debug = false)
    {
        $total = $order->getTotal() / config('commerce.currency.basic');
        $hash = $this->calculateSignature($total, $order->id);
        
        $query = http_build_query([
            'MrchLogin' => $this->settings->login,
            'OutSum' => $total,
            'InvId' => $order->id,
            'Desc' => isset($order->description) ? $order->description : null,
            'SignatureValue' => $hash,
            'IsTest' => $debug,
        ]);
        
        return sprintf('https://auth.robokassa.ru/Merchant/Index.aspx?%s', $query);
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
        return md5(sprintf('%s:%s:%s:%s', $this->settings->login, $total, $id, $this->settings->password1));
    }
    
    /**
     * Verify signature for order
     * 
     * @param  float $total
     * @param  int $id [description]
     * @return string
     */
    protected function verifySignature($total, $id)
    {
        dump(sprintf('%s:%s:%s', $total / config('commerce.currency.basic'), $id, $this->settings->password2));
        return md5(sprintf('%s:%s:%s', $total / config('commerce.currency.basic'), $id, $this->settings->password2));
    }
}