<?php

namespace Milax\Mconsole\Commerce\Repositories;

use Milax\Mconsole\Repositories\EloquentRepository;
use Milax\Mconsole\Commerce\Contracts\Repositories\OrdersRepository as Repository;

class OrdersRepository extends EloquentRepository implements Repository
{
    public $model = \Milax\Mconsole\Commerce\Models\Order::class;
    
    public function findBySlug($slug)
    {
        return $this->query()->where('slug', $slug)->firstOrFail();
    }
    
    public function place($cart, $delivery, $payment, $info)
    {
        $order = new $this->model([
            'cart' => $cart,
            'delivery_type' => $delivery,
            'payment_method' => $payment,
            'info' => $info,
        ]);
        
        $order->save();
        
        return $order;
    }
}
