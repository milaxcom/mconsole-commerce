<?php

namespace Milax\Mconsole\Commerce\Repositories;

use Milax\Mconsole\Repositories\EloquentRepository;
use Milax\Mconsole\Commerce\Contracts\Repositories\OrdersRepository as Repository;

class OrdersRepository extends EloquentRepository implements Repository
{
    public $model = \Milax\Mconsole\Commerce\Models\Order::class;
    
    public function place($delivery, $products, $info)
    {
        $order = new $this->model([
            'delivery_type_id' => $delivery,
            'products' => $products,
            'info' => $info,
        ]);
        
        $order->save();
        
        return $order;
    }
}
