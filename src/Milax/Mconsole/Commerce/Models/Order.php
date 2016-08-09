<?php

namespace Milax\Mconsole\Commerce\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $table = 'commerce_orders';
    protected $fillable = ['identifier', 'status', 'slug', 'user_id', 'info', 'cart', 'delivery_type', 'payment_method'];
    protected $casts = [
        'info' => 'object',
        'cart' => 'object',
        'delivery_type' => 'object',
        'payment_method' => 'object',
    ];
    
    public function user()
    {
        return $this->belongsTo('\App\User', 'user_id');
    }
    
    /**
     * Get order total sum
     * 
     * @return int
     */
    public function getTotal()
    {
        $total = 0;
        
        foreach ($this->cart as $product) {
            $total += $product->price * $product->quantity;
        }
        
        $total += $this->delivery_type->cost;
        
        return $total;
    }
    
}
