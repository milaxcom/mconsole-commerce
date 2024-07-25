<?php

namespace Milax\Mconsole\Commerce\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $table = 'commerce_orders';
    protected $fillable = ['identifier', 'status', 'comment', 'slug', 'user_id', 'info', 'cart', 'delivery_type', 'payment_method', 'promocode'];
    protected $casts = [
        'info' => 'object',
        'cart' => 'object',
        'delivery_type' => 'object',
        'payment_method' => 'object',
        'promocode' => 'object',
    ];
    
    public function user()
    {
        return $this->belongsTo('\App\Models\User', 'user_id');
    }
    
    /**
     * Get order total sum
     * 
     * @return int
     */
    public function getTotal()
    {
        $total = 0;
        
        foreach ($this->cart->cart as $product) {
            $total += $product->price * $product->quantity;
        }
        
        /**
         * Apply promocode if exists
         */
        if ($this->promocode) {
            switch ($this->promocode->type) {
                case 'perc':
                    $total -= $total / 100 * $this->promocode->amount;
                    break;
                case 'amount':
                    $total -= $this->promocode->amount;
                    break;
            }
        }
        
        /**
         * Apple delivery type
         */
        if ($this->delivery_type) {
            $total += $this->delivery_type->cost;
        }
        
        return $total;
    }
    
}
