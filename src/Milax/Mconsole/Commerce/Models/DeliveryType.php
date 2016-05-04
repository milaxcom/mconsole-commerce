<?php

namespace Milax\Mconsole\Commerce\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryType extends Model
{
    protected $table = 'commerce_delivery_types';
    protected $fillable = ['name', 'description', 'cost'];
}
