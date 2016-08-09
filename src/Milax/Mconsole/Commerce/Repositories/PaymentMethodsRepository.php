<?php

namespace Milax\Mconsole\Commerce\Repositories;

use Milax\Mconsole\Repositories\EloquentRepository;
use Milax\Mconsole\Commerce\Contracts\Repositories\PaymentMethodsRepository as Repository;

class PaymentMethodsRepository extends EloquentRepository implements Repository
{
    public $model = \Milax\Mconsole\Commerce\Models\PaymentMethod::class;
}
