<?php

namespace Milax\Mconsole\Commerce;

use App;
use Milax\Mconsole\Commerce\Contracts\Repositories\PaymentMethodsRepository;
use Milax\Mconsole\Commerce\Contracts\Repositories\OrdersRepository;
use Milax\Mconsole\Commerce\Contracts\OrderProcessor as Processor;

class OrderProcessor implements Processor
{
    public function __construct(PaymentMethodsRepository $paymentMethods, OrdersRepository $orders)
    {
        $this->paymentMethods = $paymentMethods;
        $this->orders = $orders;
    }
    
    public function getOrder($payload)
    {
        if (isset($payload['InvId'])) {
            return $this->orders->find($payload['InvId']);
        }
        // @todo get order by request from Yandex.Money
    }
    
    public function getUrl($order)
    {
        return $this->getPaymentProvider($order->payment_method)->getUrl($order);
    }
    
    public function pay($payload, $callback)
    {
        $order = $this->getOrder($payload);
        
        $paid = $this->getPaymentProvider($order->payment_method)->pay($order, $payload);
        
        return $callback($order, $paid);
    }
    
    /**
     * Get PaymentProvider
     * 
     * @param  array $paymentMethod
     * @return PaymentProvider
     */
    protected function getPaymentProvider($paymentMethod)
    {
        switch ($paymentMethod->type) {
            case 'robokassa':
                App::bind('Milax\Mconsole\Commerce\Contracts\PaymentProvider', 'Milax\Mconsole\Commerce\PaymentProviders\RobokassaPaymentProvider');
                break;
            // @todo add YandexMoneyPaymentProvider
        }
        
        $settings = $this->paymentMethods->find($paymentMethod->id)->settings;
        
        return app('Milax\Mconsole\Commerce\Contracts\PaymentProvider')->setSettings($settings);
    }
}