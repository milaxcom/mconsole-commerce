<?php

namespace Milax\Mconsole\Commerce\Models;

use Illuminate\Database\Eloquent\Model;

class Productable extends Model
{
    protected $table = 'commerce_productables';
    protected $fillable = ['product_id', 'productable_id', 'productable_type'];
}
