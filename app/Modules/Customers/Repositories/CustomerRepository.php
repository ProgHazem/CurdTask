<?php

namespace App\Modules\Customers\Repositories;

use App\Repositories\BaseRepository;
use App\Modules\Customers\Models\Customer;
use App\Modules\Customers\Repositories\Interfaces\CustomerInterface;

class CustomerRepository extends BaseRepository implements CustomerInterface
{
    public function __construct(private Customer $customer)
    {
        parent::__construct($customer);
    }

}
