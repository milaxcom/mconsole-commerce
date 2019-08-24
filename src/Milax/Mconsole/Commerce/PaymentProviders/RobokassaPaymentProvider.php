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
        if ($this->checkHash($order, $payload, $signature)) {
            if ($this->settings->robochecks == 1) {
                $receipt = $this->getReceipt($order);
                \Log::debug(json_encode($receipt));
            }
            
            return true;
        } else {
            return false;
        }
    }
    
    public function check($order, $payload)
    {
        $signature = $this->verifySignature($order->getTotal(), $order->id, $this->settings->password1);
        return $this->checkHash($order, $payload, $signature);
    }
    
    public function getUrl($order, $debug = false)
    {
        $total = $order->getTotal();
        $receipt = [];
        
        if ($this->settings->robochecks == 1) {
            $receipt = [
                'sno' => $this->settings->sno,
                'items' => [],
            ];
            
            foreach ($order->cart->cart as $cartItem) {
                $receipt['items'][] = [
                    'name' => $cartItem->name,
                    'sum' => $cartItem->price * $cartItem->quantity,
                    'quantity' => $cartItem->quantity,
                    'payment_method' => 'full_prepayment',
                    'payment_object' => 'commodity',
                    'tax' => 'none',
                ];
                
                if ($order->delivery_type->cost > 0) {
                    $receipt['items'][] = [
                        'name' => sprintf('Доставка: %s', $order->delivery_type->name),
                        'sum' => floatVal($order->delivery_type->cost),
                        'quantity' => 1,
                        'payment_method' => 'full_prepayment',
                        'payment_object' => 'service',
                        'tax' => 'none',
                    ];
                }
            }
        }
        
        $hash = $this->calculateSignature($total, $order->id, $receipt);
        
        $queryData = [
            'MrchLogin' => $this->settings->login,
            'OutSum' => $total  / config('commerce.currency.basic'),
            'InvId' => $order->id,
            'Desc' => isset($order->description) ? $order->description : null,
            'SignatureValue' => $hash,
            'IsTest' => $debug ? '1' : '0',
        ];
        
        if (count($receipt) > 0) {
            $queryData['Receipt'] = urlencode(json_encode($receipt));
        }
        
        $query = http_build_query($queryData);
        
        return sprintf('https://auth.robokassa.ru/Merchant/Index.aspx?%s', $query);
    }
    
    protected function checkHash($order, $payload, $signature)
    {
        if ($payload['OutSum'] == $order->getTotal() / config('commerce.currency.basic') && strtolower($payload['SignatureValue']) == strtolower($signature)) {
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
     * @param  string $receipt
     * @return string
     */
    protected function calculateSignature($total, $id, $receipt = [])
    {
        if (count($receipt) > 0) {
            return md5(sprintf('%s:%s:%s:%s:%s', $this->settings->login, $total / config('commerce.currency.basic'), $id, urlencode(json_encode($receipt)), $this->settings->password1)); 
        }
        
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
    
    /**
     * Send second receipt
     * https://docs.robokassa.ru/#7696
     *
     * @param object $order
     * @return void
     */
    protected function getReceipt($order)
    {
        $receipt = [
            'merchantId' => $this->settings->login,
            'id' => $order->id * 100,
            'originId' => $order->id,
            'operation' => 'sell',
            'sno' => $this->settings->sno,
            'url' => config('app.url'),
            'total' => $order->getTotal(),
            'items' => [],
            'payments' => [
                [
                    'type' => 2,
                    'sum' => $order->getTotal(),
                ],
            ],
            'vats' => [
                [
                    'type' => 'none',
                    'sum' => 0,
                ],
            ],
        ];
        
        foreach ($order->cart->cart as $cartItem) {
            $receipt['items'][] = [
                'name' => $cartItem->name,
                'sum' => $cartItem->price * $cartItem->quantity,
                'quantity' => $cartItem->quantity,
                'payment_method' => 'full_prepayment',
                'payment_object' => 'commodity',
                'tax' => 'none',
            ];
            
            if ($order->delivery_type->cost > 0) {
                $receipt['items'][] = [
                    'name' => sprintf('Доставка: %s', $order->delivery_type->name),
                    'sum' => floatVal($order->delivery_type->cost),
                    'quantity' => 1,
                    'payment_method' => 'full_prepayment',
                    'payment_object' => 'service',
                    'tax' => 'none',
                ];
            }
        }
        
        return $receipt;
    }
}