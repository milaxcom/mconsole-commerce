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

    public function index()
    {
        return $this->query()->orderBy('id', 'desc');
    }
    
    public function place($cart, $delivery, $payment, $info, $promocode = null, $userId = 0)
    {
        $order = new $this->model([
            'slug' => $this->makeSlug(),
            'cart' => $cart,
            'user_id' => $userId,
            'delivery_type' => $delivery,
            'payment_method' => $payment,
            'promocode' => $promocode,
            'info' => $info,
        ]);
        
        $order->save();
        $order->identifier = $this->makeIdentifier($order->id);
        $order->save();
        
        return $order;
    }
    
    public function changeStatus($id, $status)
    {
        return $this->query()->findOrFail($id)->update([
            'status' => $status,
        ]);
    }
    
    /**
     * Generate unique slug
     * 
     * @return string
     */
    protected function makeSlug()
    {
        $slug = strtolower(str_random(6));
        while ($this->query()->where('slug', $slug)->count() > 0) {
            $slug = strtolower(str_random(6));
        }
        
        return $slug;
    }
    
    /**
     * Generate unique identifier
     *
     * @param int $id
     * 
     * @return string
     */
    protected function makeIdentifier($id)
    {
        return sprintf('%s%s', config('commerce.orders.prefix'), str_pad($id, config('commerce.orders.length'), 0, STR_PAD_LEFT));
    }
    
}
