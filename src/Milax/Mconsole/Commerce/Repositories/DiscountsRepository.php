<?php

namespace Milax\Mconsole\Commerce\Repositories;

use Milax\Mconsole\Repositories\EloquentRepository;
use Milax\Mconsole\Commerce\Contracts\Repositories\DiscountsRepository as Repository;

class DiscountsRepository extends EloquentRepository implements Repository
{
    public $model = \Milax\Mconsole\Commerce\Models\Discount::class;
}
