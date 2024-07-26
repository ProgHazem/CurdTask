<?php

namespace App\Modules\Services\database\seeds;

use Illuminate\Database\Seeder;
use App\Modules\Services\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $service = Service::updateOrCreate(
            [
                'name' => 'Test Service',
            ],
            [
                'name' => 'Test Service',
                'customer_id' => 1,
            ]
        );
    }
}
