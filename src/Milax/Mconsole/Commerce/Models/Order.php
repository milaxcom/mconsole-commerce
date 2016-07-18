<?php

namespace Milax\Mconsole\Commerce\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $table = 'commerce_orders';
    protected $fillable = ['number', 'delivery_type_id', 'user_id', 'info', 'products'];
    protected $casts = [
        'info' => 'array',
        'products' => 'array',
    ];
    
    /**
     * Get order total sum
     * 
     * @return int
     */
    public function getTotal()
    {
        //..
    }
    
}
