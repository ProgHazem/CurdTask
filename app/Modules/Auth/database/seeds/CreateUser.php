<?php

namespace App\Modules\Auth\database\seeds;

use Illuminate\Database\Seeder;
use App\Modules\Auth\Models\User;

class CreateUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'admin@admin.com',
            ],
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => 'P$ssw0rd',
            ]);
    }
}
