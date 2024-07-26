<?php

namespace Database\Seeders;


use App\Modules\Auth\database\seeds\CreateUser;
use App\Modules\Customers\database\seeds\CustomerSeeder;
use App\Modules\Services\database\seeds\ServiceSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CreateUser::class,
            CustomerSeeder::class,
            ServiceSeeder::class,
        ]);
    }
}
