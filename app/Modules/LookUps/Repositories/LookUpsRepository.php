<?php

namespace App\Modules\LookUps\Repositories;

use App\Modules\Customers\Models\Customer;
use Illuminate\Database\Eloquent\Collection;
use App\Modules\LookUps\Repositories\Interfaces\LookUpsInterface;

class LookUpsRepository implements LookUpsInterface
{
    CONST GENERIC_COLUMNS = ['id', 'first_name', 'last_name'];

    public function getCustomers(): Collection
    {
        return Customer::get(self::GENERIC_COLUMNS);
    }
}
