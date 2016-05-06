<?php

namespace Milax\Mconsole\Commerce\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    public $table = 'commerce_discounts';
    protected $fillable = ['key', 'accumulative', 'name', 'description', 'discounts'];
    protected $casts = [
        'discounts' => 'array',
    ];
}
