<?php

namespace Milax\Mconsole\Commerce\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $table = 'commerce_orders';
    protected $fillable = ['identifier', 'status', 'slug', 'user_id', 'info', 'cart', 'delivery_type', 'payment_method'];
    protected $casts = [
        'info' => 'object',
        'cart' => 'array',
        'delivery_type' => 'object',
        'payment_method' => 'object',
    ];
    
    public function user()
    {
        return $this->belongsTo('\App\User', 'user_id');
    }
    
    public function deliveryType()
    {
        return $this->belongsTo('\Milax\Mconsole\Commerce\Models\DeliveryType', 'delivery_type_id');
    }
    
    public function paymentMethod()
    {
        return $this->belongsTo('\Milax\Mconsole\Commerce\Models\PaymentMethod', 'payment_method_id');
    }
    
    /**
     * Get order total sum
     * 
     * @return int
     */
    public function getTotal()
    {
        foreach ($this->cart as $product) {
            
        }
        // Стоимость товара + наценка - скидки x количество
        // Добавляем стоимость доставки
        // Добавляем комиссию
        // return $total;
    }
    
}
