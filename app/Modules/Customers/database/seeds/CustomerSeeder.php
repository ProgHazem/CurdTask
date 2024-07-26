<?php

namespace App\Modules\Customers\database\seeds;

use Illuminate\Database\Seeder;
use App\Modules\Customers\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Customer::updateOrCreate(
            [
                'email' => 'customer@demo.com',
            ],
            [
                'email' => 'customer@demo.com',
                'first_name' => 'customer',
                'last_name' => 'customer'
            ]
        );
    }
}
