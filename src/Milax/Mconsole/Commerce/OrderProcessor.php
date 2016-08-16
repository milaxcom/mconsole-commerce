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
    
    public function pay($payload, $callback)
    {
        $order = $this->getOrder($payload);
        
        switch ($order->payment_method->type) {
            case 'robokassa':
                App::bind('Milax\Mconsole\Commerce\Contracts\PaymentProvider', 'Milax\Mconsole\Commerce\PaymentProviders\RobokassaPaymentProvider');
                break;
            // @todo add YandexMoneyPaymentProvider
        }
        
        $paymentMethod = $this->paymentMethods->find($order->payment_method->id);
        
        $paymentProvider = app('Milax\Mconsole\Commerce\Contracts\PaymentProvider')->setSettings($paymentMethod->settings);
        
        $paid = $paymentProvider->pay($order, $payload);
        
        $callback($order, $paid);
        // пример вызова: processor->pay([], function($order, $paid) { //logic })
    }
}