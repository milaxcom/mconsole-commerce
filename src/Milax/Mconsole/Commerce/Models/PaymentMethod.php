<?php

namespace Milax\Mconsole\Commerce;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = 'commerce_payment_methods';
    protected $fillable = ['type', 'client_id', 'client_secret'];
}
