<?php

namespace Database\Seeders;


use App\Modules\Auth\database\seeds\CreateUser;
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
        ]);
    }
}
