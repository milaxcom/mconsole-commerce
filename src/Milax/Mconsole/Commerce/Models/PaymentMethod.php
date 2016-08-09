<?php

namespace Milax\Mconsole\Commerce\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = 'commerce_payment_methods';
    protected $fillable = ['type', 'name', 'commission', 'commission_type', 'description', 'settings'];
    protected $casts = [
        'settings' => 'object'
    ];
}
