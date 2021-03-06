<?php

namespace Milax\Mconsole\Commerce\Repositories;

use Milax\Mconsole\Repositories\EloquentRepository;
use Milax\Mconsole\Commerce\Contracts\Repositories\DeliveryTypesRepository as Repository;

class DeliveryTypesRepository extends EloquentRepository implements Repository
{
    public $model = \Milax\Mconsole\Commerce\Models\DeliveryType::class;
}
